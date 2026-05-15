# Plan de Développement E-commerce PHP Natif - B3S Store

Plan structuré pour finaliser le développement d'un site e-commerce from scratch en PHP 8.x natif avec architecture MVC personnalisée.

---

## 📊 ANALYSE DE L'ARCHITECTURE ACTUELLE

### ✅ Points Forts Identifiés

**Structure MVC Bien Organisée**
- Architecture modulaire avec séparation claire : `Controllers/`, `Model/`, `Views/`
- Autoloading PSR-4 configuré via Composer
- Router personnalisé basé sur AltoRouter avec support PSR-7
- Système de middleware (Auth, CSRF)
- Query Builder abstrait avec méthodes CRUD de base
- Pattern Factory pour la connexion DB
- Support multi-langue via `Lang/`
- Gestion d'environnement avec `phpdotenv`

**Base de Données**
- MySQL/MariaDB
- Tables existantes : `t_b3s_product`, `t_b3s_user`, `t_b3s_settings`, `t_b3s_options`
- Nomenclature cohérente avec préfixe `t_b3s_`

### ⚠️ Points à Améliorer

1. **Sécurité** : Middleware CSRF incomplet, pas de validation des inputs, pas de hash password visible
2. **Base de données** : Schéma incomplet (manque commandes, catégories, panier, coupons, etc.)
3. **Query Builder** : Méthodes `update()` et `delete()` utilisent `id` en dur au lieu de clés primaires dynamiques
4. **Session** : Erreur dans `index.php` ligne 4 (`if(session_id()) session_start()` devrait être `if(!session_id())`)
5. **Validation** : Aucun système de validation des données
6. **Tests** : Aucun test unitaire ou fonctionnel

---

## � PACKAGES RECOMMANDÉS POUR SIMPLIFIER LE DÉVELOPPEMENT

### 📌 Analyse des Composants Complexes Actuels

Après analyse approfondie du code existant, plusieurs composants sont trop complexes ou incomplets et peuvent être grandement simplifiés avec des packages éprouvés.

### 🔴 **1. ROUTING - Simplification Majeure Recommandée**

**Problèmes identifiés dans le Router actuel :**
- Gestion manuelle PSR-7 (Request/Response) trop verbeuse (231 lignes de code)
- Obligation de retourner des `ResponseInterface` dans chaque controller
- Middleware stack complexe avec `array_reduce` difficile à débugger
- Pas de cache des routes pour la production
- Performance moyenne avec AltoRouter

**✅ Solution : FastRoute (10x plus rapide)**

```bash
composer require nikic/fast-route
```

**Avantages :**
- **Performance** : 10x plus rapide qu'AltoRouter (benchmarks officiels)
- **Simplicité** : Syntaxe ultra-claire, pas de PSR-7 obligatoire
- **Cache** : Support natif du cache de routes pour production
- **Maintenance** : Utilisé par Slim Framework, très stable

**Migration simplifiée :**

```php
// Router/route.php - VERSION SIMPLIFIÉE (30 lignes au lieu de 231)
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    // Routes simples - pas besoin de PSR-7 !
    $r->addRoute('GET', '/', 'Controller\HomeController@index');
    $r->addRoute('GET', '/products/{id:\d+}', 'Controller\ProductController@show');
    
    // Groupes avec préfixe automatique
    $r->addGroup('/admin', function (RouteCollector $r) {
        $r->addRoute('GET', '/dashboard', 'Admin\AdminController@index');
        $r->addRoute('GET', '/products', 'Admin\ProductController@index');
        $r->addRoute('POST', '/products', 'Admin\ProductController@store');
        $r->addRoute('GET', '/products/{id:\d+}/edit', 'Admin\ProductController@edit');
        $r->addRoute('POST', '/products/{id:\d+}', 'Admin\ProductController@update');
        $r->addRoute('POST', '/products/{id:\d+}/delete', 'Admin\ProductController@destroy');
    });
    
    // Routes API
    $r->addGroup('/api/v1', function (RouteCollector $r) {
        $r->addRoute('GET', '/products', 'Controller\Api\ProductController@index');
        $r->addRoute('POST', '/cart/add', 'Controller\Api\CartController@add');
    });
});

// Dispatch simple
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = explode('@', $routeInfo[1]);
        $params = $routeInfo[2];
        
        // Instancier et appeler le controller
        $controllerInstance = new $controller();
        call_user_func_array([$controllerInstance, $method], $params);
        break;
        
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        require VIEWS . '/errors/404.php';
        break;
        
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 Method Not Allowed';
        break;
}
```

**Gain de temps estimé : 90% (2-3 jours → 2-3 heures)**

---

### 🔴 **2. QUERY BUILDER - Remplacer par Eloquent**

**Problèmes identifiés dans Query.php actuel :**
- Pas de support pour les relations (JOIN, hasMany, belongsTo)
- Pas de pagination intégrée
- Pas de query builder fluent (WHERE complexes, OR, IN, LIKE)
- Hardcodé `id` au lieu de clés primaires dynamiques (bug avec vos PK_*)
- Pas de support pour les transactions
- Pas de eager loading (problème N+1 queries)

**✅ Solution : Illuminate Database (Eloquent standalone)**

```bash
composer require illuminate/database
```

**Avantages :**
- **ORM complet** : Relations automatiques, eager loading, lazy loading
- **Query Builder fluent** : Syntaxe élégante et puissante
- **Pagination** : Automatique avec `paginate()`
- **Migrations** : Gestion de schéma intégrée
- **Pas Laravel** : Package standalone, pas besoin du framework complet
- **Performance** : Optimisations automatiques des requêtes

**Configuration (une seule fois) :**

```php
// Config/database.php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_DATABASE'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
```

**Migration des Models (exemple Product) :**

```php
// Model/Product.php - VERSION SIMPLIFIÉE
<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 't_b3s_product';
    protected $primaryKey = 'PK_PRODUCT';
    public $timestamps = true;
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';
    
    protected $fillable = [
        'FK_CATEGORY', 'SLUG', 'TITLE', 'SHORT_DESCRIPTION', 
        'T_DESCRIPTION', 'PRICE', 'DISCOUNT', 'IN_STOCK', 
        'I_STOCK_QUANTITY', 'SHOW_IN_STORE', 'S_SKU'
    ];
    
    protected $casts = [
        'PRICE' => 'decimal:2',
        'DISCOUNT' => 'integer',
        'IN_STOCK' => 'boolean',
        'SHOW_IN_STORE' => 'boolean',
    ];
    
    // Relations automatiques
    public function category() {
        return $this->belongsTo(Category::class, 'FK_CATEGORY', 'PK_CATEGORY');
    }
    
    public function images() {
        return $this->hasMany(ProductImage::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }
    
    public function variants() {
        return $this->hasMany(ProductVariant::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }
    
    public function reviews() {
        return $this->hasMany(Review::class, 'FK_PRODUCT', 'PK_PRODUCT')
                    ->where('B_APPROVED', 1);
    }
    
    // Scopes utiles
    public function scopeInStock($query) {
        return $query->where('IN_STOCK', 1)->where('I_STOCK_QUANTITY', '>', 0);
    }
    
    public function scopeVisible($query) {
        return $query->where('SHOW_IN_STORE', 1);
    }
    
    // Accesseurs
    public function getPriceWithDiscountAttribute() {
        if ($this->DISCOUNT > 0) {
            return $this->PRICE - ($this->PRICE * $this->DISCOUNT / 100);
        }
        return $this->PRICE;
    }
}
```

**Utilisation ultra-simplifiée dans les Controllers :**

```php
// Au lieu de 20 lignes de SQL manuel :
$products = Product::where('IN_STOCK', 1)
    ->where('PRICE', '>', 50)
    ->where('PRICE', '<', 200)
    ->with(['category', 'images', 'reviews'])  // Eager loading (évite N+1)
    ->orderBy('CREATED_AT', 'desc')
    ->paginate(15);  // Pagination automatique

// Recherche
$products = Product::where('TITLE', 'LIKE', "%{$search}%")
    ->orWhere('SHORT_DESCRIPTION', 'LIKE', "%{$search}%")
    ->visible()
    ->inStock()
    ->get();

// Créer un produit
$product = Product::create([
    'FK_CATEGORY' => 1,
    'TITLE' => 'Nouveau produit',
    'SLUG' => 'nouveau-produit',
    'PRICE' => 99.99,
    'IN_STOCK' => true
]);

// Mettre à jour
$product = Product::find(1);
$product->update(['PRICE' => 89.99]);

// Avec relations
$product = Product::with(['category', 'images'])->find(1);
echo $product->category->S_NAME;  // Accès direct
foreach ($product->images as $image) {
    echo $image->S_IMAGE_PATH;
}

// Transactions
DB::transaction(function () {
    $order = Order::create([...]);
    foreach ($cartItems as $item) {
        OrderItem::create([...]);
        $product = Product::find($item['product_id']);
        $product->decrement('I_STOCK_QUANTITY', $item['quantity']);
    }
});
```

**Gain de temps estimé : 85% (5-7 jours → 1 jour)**

---

### 🔴 **3. TEMPLATING - Sécuriser avec Twig**

**Problèmes identifiés dans Controller.php actuel :**
- `extract($_POST)` est dangereux (pollution de variables)
- Pas d'échappement automatique XSS
- Pas d'héritage de templates
- Pas de composants réutilisables
- Mélange de logique et présentation

**✅ Solution : Twig**

```bash
composer require twig/twig
```

**Avantages :**
- **Sécurité** : Auto-escape XSS par défaut
- **Héritage** : Layouts et blocks
- **Composants** : Include, macros réutilisables
- **Performance** : Cache compilé
- **Syntaxe claire** : Séparation logique/présentation

**Configuration :**

```php
// Controllers/Controller.php - VERSION SIMPLIFIÉE
<?php
namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Controller\Middleware\AuthMiddleware;

class Controller extends AuthMiddleware {
    protected Environment $twig;
    
    public function __construct() {
        $loader = new FilesystemLoader(VIEWS);
        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../storage/cache/views',
            'auto_reload' => true,  // false en production
            'debug' => $_ENV['APP_DEBUG'] ?? false
        ]);
        
        // Variables globales disponibles partout
        $this->twig->addGlobal('app_name', $_ENV['APP_NAME']);
        $this->twig->addGlobal('user', $_SESSION['user'] ?? null);
    }
    
    protected function view(string $template, array $data = []): void {
        echo $this->twig->render($template . '.twig', $data);
    }
    
    protected function json(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
```

**Templates Twig (exemple) :**

```twig
{# Views/layout.twig - Layout principal #}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}{{ app_name }}{% endblock %}</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    {% include 'partials/header.twig' %}
    
    <main>
        {% block content %}{% endblock %}
    </main>
    
    {% include 'partials/footer.twig' %}
    
    {% block scripts %}{% endblock %}
</body>
</html>

{# Views/product/show.twig - Fiche produit #}
{% extends "layout.twig" %}

{% block title %}{{ product.TITLE }} - {{ parent() }}{% endblock %}

{% block content %}
<div class="product-detail">
    <h1>{{ product.TITLE }}</h1>
    
    {# Auto-escape XSS automatique #}
    <div class="description">
        {{ product.T_DESCRIPTION|raw }}
    </div>
    
    <div class="price">
        {% if product.DISCOUNT > 0 %}
            <span class="old-price">{{ product.PRICE|number_format(2) }} €</span>
            <span class="new-price">{{ product.price_with_discount|number_format(2) }} €</span>
            <span class="discount">-{{ product.DISCOUNT }}%</span>
        {% else %}
            <span class="price">{{ product.PRICE|number_format(2) }} €</span>
        {% endif %}
    </div>
    
    {# Boucle sur les images #}
    <div class="gallery">
        {% for image in product.images %}
            <img src="{{ image.S_IMAGE_PATH }}" alt="{{ product.TITLE }}">
        {% endfor %}
    </div>
    
    {# Variants #}
    {% if product.variants|length > 0 %}
    <div class="variants">
        <h3>Options disponibles</h3>
        {% for variant in product.variants %}
            <button class="variant-btn" data-variant-id="{{ variant.PK_VARIANT }}">
                {{ variant.S_NAME }}: {{ variant.S_VALUE }}
                {% if variant.D_PRICE_MODIFIER != 0 %}
                    (+{{ variant.D_PRICE_MODIFIER|number_format(2) }} €)
                {% endif %}
            </button>
        {% endfor %}
    </div>
    {% endif %}
    
    {# Avis clients #}
    <div class="reviews">
        <h3>Avis clients ({{ product.reviews|length }})</h3>
        {% for review in product.reviews %}
            {% include 'partials/review-item.twig' with {'review': review} %}
        {% else %}
            <p>Aucun avis pour le moment.</p>
        {% endfor %}
    </div>
</div>
{% endblock %}
```

**Gain de temps estimé : 75% (3-4 jours → 1 jour)**

---

### 🔴 **4. VALIDATION - Implémenter Respect/Validation**

**Problème actuel :** Aucun système de validation

**✅ Solution : Respect/Validation**

```bash
composer require respect/validation
```

**Utilisation :**

```php
// Utilities/Validator.php
<?php
namespace Utilities;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;

class Validator {
    private array $errors = [];
    
    public function validate(array $data, array $rules): bool {
        $this->errors = [];
        
        foreach ($rules as $field => $rule) {
            try {
                $rule->assert($data[$field] ?? null);
            } catch (ValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }
        
        return empty($this->errors);
    }
    
    public function getErrors(): array {
        return $this->errors;
    }
    
    public function getFirstError(string $field): ?string {
        return $this->errors[$field][0] ?? null;
    }
}

// Utilisation dans un Controller
$validator = new Validator();
$rules = [
    'email' => v::email()->notEmpty(),
    'password' => v::stringType()->length(8, null)->notEmpty(),
    'price' => v::floatVal()->positive(),
    'slug' => v::slug()->notEmpty()
];

if (!$validator->validate($_POST, $rules)) {
    $errors = $validator->getErrors();
    return $this->view('product/create', ['errors' => $errors]);
}
```

**Gain de temps estimé : 85% (2-3 jours → 4 heures)**

---

### 🔴 **5. CSRF - Compléter avec Symfony Security**

**Problème actuel :** CSRFMiddleware vide (retourne juste `true`)

**✅ Solution : Symfony Security CSRF**

```bash
composer require symfony/security-csrf
```

**Implémentation :**

```php
// Controllers/Middleware/CSRFMiddleware.php - VERSION COMPLÈTE
<?php
namespace Controller\Middleware;

use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

class CSRFMiddleware {
    private CsrfTokenManager $csrfManager;
    
    public function __construct() {
        $this->csrfManager = new CsrfTokenManager(
            new UriSafeTokenGenerator(),
            new SessionTokenStorage()
        );
    }
    
    public function generateToken(string $tokenId = 'form'): string {
        return $this->csrfManager->getToken($tokenId)->getValue();
    }
    
    public function verifyCSRF(string $tokenId = 'form'): bool {
        $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        
        if (!$token) {
            return false;
        }
        
        return $this->csrfManager->isTokenValid(
            new CsrfToken($tokenId, $token)
        );
    }
}

// Dans les formulaires Twig
<form method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- ... -->
</form>

// Dans le Controller
if (!$this->verifyCSRF()) {
    http_response_code(403);
    die('Invalid CSRF token');
}
```

**Gain de temps estimé : 90% (1-2 jours → 2 heures)**

---

### 🔴 **6. GESTION DES IMAGES**

**✅ Solution : Intervention/Image**

```bash
composer require intervention/image
```

**Utilisation :**

```php
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploader {
    public function upload($file, string $productId): array {
        $path = PUBLIC_PATH . "/assets/images/products/{$productId}/";
        if (!is_dir($path)) mkdir($path, 0755, true);
        
        $filename = uniqid() . '.jpg';
        $img = Image::make($file['tmp_name']);
        
        // Redimensionner et optimiser
        $img->fit(800, 800)->save($path . $filename, 85);
        $img->fit(300, 300)->save($path . 'medium_' . $filename, 80);
        $img->fit(150, 150)->save($path . 'thumb_' . $filename, 75);
        
        return [
            'original' => $filename,
            'medium' => 'medium_' . $filename,
            'thumb' => 'thumb_' . $filename
        ];
    }
}
```

---

### 🔴 **7. ENVOI D'EMAILS**

**✅ Solution : Symfony Mailer**

```bash
composer require symfony/mailer
```

**Configuration :**

```php
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn($_ENV['MAILER_DSN']);
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('shop@example.com')
    ->to($customer->email)
    ->subject('Confirmation de commande #' . $order->number)
    ->html($this->twig->render('emails/order-confirmation.twig', [
        'order' => $order
    ]));

$mailer->send($email);
```

---

### 🔴 **8. GÉNÉRATION PDF (Factures)**

**✅ Solution : DomPDF**

```bash
composer require dompdf/dompdf
```

---

### 🔴 **9. PAIEMENTS**

**✅ Solution : Stripe PHP SDK**

```bash
composer require stripe/stripe-php
```

---

### 🔴 **10. LOGGING**

**✅ Solution : Monolog**

```bash
composer require monolog/monolog
```

---

## 📋 COMMANDE COMPLÈTE D'INSTALLATION

```bash
# Routing simplifié
composer require nikic/fast-route

# Database ORM puissant
composer require illuminate/database

# Templating sécurisé
composer require twig/twig

# Validation
composer require respect/validation

# CSRF & Sécurité
composer require symfony/security-csrf

# Images
composer require intervention/image

# Emails
composer require symfony/mailer

# PDF
composer require dompdf/dompdf

# Paiements
composer require stripe/stripe-php

# Logging
composer require monolog/monolog

# Tests
composer require --dev phpunit/phpunit
composer require --dev fakerphp/faker
```

---

## 🎯 GAIN DE TEMPS ESTIMÉ AVEC CES PACKAGES

| Composant | Temps développement manuel | Avec packages | Gain |
|-----------|---------------------------|---------------|------|
| **Routing** | 2-3 jours | 2-3 heures | **90%** |
| **Query Builder/ORM** | 5-7 jours | 1 jour | **85%** |
| **Templating** | 3-4 jours | 1 jour | **75%** |
| **Validation** | 2-3 jours | 4 heures | **85%** |
| **CSRF** | 1-2 jours | 2 heures | **90%** |
| **Upload Images** | 1-2 jours | 3 heures | **85%** |
| **Emails** | 2 jours | 3 heures | **85%** |
| **PDF** | 2-3 jours | 4 heures | **85%** |
| **Paiements** | 3-4 jours | 1 jour | **75%** |
| **TOTAL** | **21-30 jours** | **4-6 jours** | **80-85%** |

**Économie totale : 15-24 jours de développement**

---

## ✅ PRIORITÉ D'IMPLÉMENTATION

1. **FastRoute** (2h) - Simplifier immédiatement le routing
2. **Eloquent** (1 jour) - Remplacer Query.php
3. **Respect/Validation** (4h) - Sécuriser les inputs
4. **Symfony CSRF** (2h) - Compléter la sécurité
5. **Twig** (1 jour) - Sécuriser les vues
6. **Autres packages** - Au fur et à mesure des besoins

---

## �🗄️ SCHÉMA DE BASE DE DONNÉES COMPLET

### Tables à Créer/Modifier

```sql
-- ============================================
-- CATÉGORIES
-- ============================================
CREATE TABLE t_b3s_category (
  PK_CATEGORY INT AUTO_INCREMENT PRIMARY KEY,
  FK_PARENT_CATEGORY INT NULL,
  S_NAME VARCHAR(100) NOT NULL,
  S_SLUG VARCHAR(120) NOT NULL UNIQUE,
  S_DESCRIPTION TEXT,
  I_ORDER INT DEFAULT 0,
  B_ACTIVE TINYINT(1) DEFAULT 1,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_PARENT_CATEGORY) REFERENCES t_b3s_category(PK_CATEGORY) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- PRODUITS (Modifier la table existante)
-- ============================================
ALTER TABLE t_b3s_product 
  DROP COLUMN FK_REVIEW,
  DROP COLUMN FK_PROMO_CODE,
  ADD COLUMN S_SKU VARCHAR(50) UNIQUE AFTER PK_PRODUCT,
  ADD COLUMN T_DESCRIPTION TEXT AFTER SHORT_DESCRIPTION,
  ADD COLUMN S_IMAGE_MAIN VARCHAR(255) AFTER T_DESCRIPTION,
  ADD COLUMN I_STOCK_QUANTITY INT DEFAULT 0 AFTER IN_STOCK,
  ADD COLUMN I_VIEWS INT DEFAULT 0,
  ADD COLUMN S_META_TITLE VARCHAR(255),
  ADD COLUMN S_META_DESCRIPTION TEXT,
  ADD COLUMN S_META_KEYWORDS VARCHAR(255),
  MODIFY COLUMN FK_CATEGORY INT NOT NULL,
  ADD FOREIGN KEY (FK_CATEGORY) REFERENCES t_b3s_category(PK_CATEGORY) ON DELETE RESTRICT;

-- ============================================
-- IMAGES PRODUITS
-- ============================================
CREATE TABLE t_b3s_product_image (
  PK_PRODUCT_IMAGE INT AUTO_INCREMENT PRIMARY KEY,
  FK_PRODUCT INT NOT NULL,
  S_IMAGE_PATH VARCHAR(255) NOT NULL,
  I_ORDER INT DEFAULT 0,
  B_IS_MAIN TINYINT(1) DEFAULT 0,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_PRODUCT) REFERENCES t_b3s_product(PK_PRODUCT) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- VARIANTS PRODUITS (Taille, Couleur, etc.)
-- ============================================
CREATE TABLE t_b3s_product_variant (
  PK_VARIANT INT AUTO_INCREMENT PRIMARY KEY,
  FK_PRODUCT INT NOT NULL,
  S_NAME VARCHAR(50) NOT NULL, -- Ex: "Taille", "Couleur"
  S_VALUE VARCHAR(100) NOT NULL, -- Ex: "XL", "Rouge"
  D_PRICE_MODIFIER DECIMAL(10,2) DEFAULT 0.00,
  I_STOCK_QUANTITY INT DEFAULT 0,
  S_SKU VARCHAR(50) UNIQUE,
  FOREIGN KEY (FK_PRODUCT) REFERENCES t_b3s_product(PK_PRODUCT) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- UTILISATEURS (Modifier la table existante)
-- ============================================
ALTER TABLE t_b3s_user
  ADD COLUMN S_PASSWORD VARCHAR(255) NOT NULL AFTER S_EMAIL,
  ADD COLUMN S_PHONE VARCHAR(20),
  ADD COLUMN E_ROLE ENUM('customer', 'admin', 'manager') DEFAULT 'customer',
  ADD COLUMN B_ACTIVE TINYINT(1) DEFAULT 1,
  ADD COLUMN S_RESET_TOKEN VARCHAR(100),
  ADD COLUMN DT_RESET_EXPIRES DATETIME,
  ADD COLUMN CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ADD COLUMN UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  ADD UNIQUE KEY (S_EMAIL);

-- ============================================
-- ADRESSES CLIENTS
-- ============================================
CREATE TABLE t_b3s_address (
  PK_ADDRESS INT AUTO_INCREMENT PRIMARY KEY,
  FK_USER INT NOT NULL,
  S_LABEL VARCHAR(50), -- "Domicile", "Travail"
  S_FIRSTNAME VARCHAR(50) NOT NULL,
  S_LASTNAME VARCHAR(50) NOT NULL,
  S_ADDRESS_LINE1 VARCHAR(255) NOT NULL,
  S_ADDRESS_LINE2 VARCHAR(255),
  S_CITY VARCHAR(100) NOT NULL,
  S_POSTAL_CODE VARCHAR(20) NOT NULL,
  S_COUNTRY VARCHAR(100) NOT NULL,
  S_PHONE VARCHAR(20),
  B_IS_DEFAULT TINYINT(1) DEFAULT 0,
  E_TYPE ENUM('billing', 'shipping', 'both') DEFAULT 'both',
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_USER) REFERENCES t_b3s_user(PK_USER) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- COMMANDES
-- ============================================
CREATE TABLE t_b3s_order (
  PK_ORDER INT AUTO_INCREMENT PRIMARY KEY,
  S_ORDER_NUMBER VARCHAR(50) UNIQUE NOT NULL,
  FK_USER INT NOT NULL,
  FK_BILLING_ADDRESS INT NOT NULL,
  FK_SHIPPING_ADDRESS INT NOT NULL,
  E_STATUS ENUM('pending', 'processing', 'paid', 'shipped', 'delivered', 'cancelled', 'refunded') DEFAULT 'pending',
  D_SUBTOTAL DECIMAL(10,2) NOT NULL,
  D_TAX DECIMAL(10,2) DEFAULT 0.00,
  D_SHIPPING DECIMAL(10,2) DEFAULT 0.00,
  D_DISCOUNT DECIMAL(10,2) DEFAULT 0.00,
  D_TOTAL DECIMAL(10,2) NOT NULL,
  S_COUPON_CODE VARCHAR(50),
  S_PAYMENT_METHOD VARCHAR(50), -- "stripe", "paypal", "cod"
  S_PAYMENT_TRANSACTION_ID VARCHAR(255),
  E_PAYMENT_STATUS ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
  S_TRACKING_NUMBER VARCHAR(100),
  T_NOTES TEXT,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_USER) REFERENCES t_b3s_user(PK_USER) ON DELETE RESTRICT,
  FOREIGN KEY (FK_BILLING_ADDRESS) REFERENCES t_b3s_address(PK_ADDRESS),
  FOREIGN KEY (FK_SHIPPING_ADDRESS) REFERENCES t_b3s_address(PK_ADDRESS)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- ITEMS DE COMMANDE
-- ============================================
CREATE TABLE t_b3s_order_item (
  PK_ORDER_ITEM INT AUTO_INCREMENT PRIMARY KEY,
  FK_ORDER INT NOT NULL,
  FK_PRODUCT INT NOT NULL,
  FK_VARIANT INT NULL,
  S_PRODUCT_NAME VARCHAR(255) NOT NULL, -- Snapshot
  D_PRICE DECIMAL(10,2) NOT NULL, -- Prix au moment de l'achat
  I_QUANTITY INT NOT NULL,
  D_SUBTOTAL DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (FK_ORDER) REFERENCES t_b3s_order(PK_ORDER) ON DELETE CASCADE,
  FOREIGN KEY (FK_PRODUCT) REFERENCES t_b3s_product(PK_PRODUCT) ON DELETE RESTRICT,
  FOREIGN KEY (FK_VARIANT) REFERENCES t_b3s_product_variant(PK_VARIANT) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- PANIER
-- ============================================
CREATE TABLE t_b3s_cart (
  PK_CART INT AUTO_INCREMENT PRIMARY KEY,
  FK_USER INT NULL, -- NULL pour invités
  S_SESSION_ID VARCHAR(255), -- Pour invités
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_USER) REFERENCES t_b3s_user(PK_USER) ON DELETE CASCADE,
  INDEX idx_session (S_SESSION_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- ITEMS DU PANIER
-- ============================================
CREATE TABLE t_b3s_cart_item (
  PK_CART_ITEM INT AUTO_INCREMENT PRIMARY KEY,
  FK_CART INT NOT NULL,
  FK_PRODUCT INT NOT NULL,
  FK_VARIANT INT NULL,
  I_QUANTITY INT NOT NULL DEFAULT 1,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_CART) REFERENCES t_b3s_cart(PK_CART) ON DELETE CASCADE,
  FOREIGN KEY (FK_PRODUCT) REFERENCES t_b3s_product(PK_PRODUCT) ON DELETE CASCADE,
  FOREIGN KEY (FK_VARIANT) REFERENCES t_b3s_product_variant(PK_VARIANT) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- COUPONS DE RÉDUCTION
-- ============================================
CREATE TABLE t_b3s_coupon (
  PK_COUPON INT AUTO_INCREMENT PRIMARY KEY,
  S_CODE VARCHAR(50) UNIQUE NOT NULL,
  S_DESCRIPTION VARCHAR(255),
  E_TYPE ENUM('percentage', 'fixed') NOT NULL,
  D_VALUE DECIMAL(10,2) NOT NULL,
  D_MIN_ORDER_AMOUNT DECIMAL(10,2) DEFAULT 0.00,
  I_MAX_USES INT DEFAULT NULL, -- NULL = illimité
  I_CURRENT_USES INT DEFAULT 0,
  I_MAX_USES_PER_USER INT DEFAULT 1,
  DT_START_DATE DATETIME NOT NULL,
  DT_END_DATE DATETIME NOT NULL,
  B_ACTIVE TINYINT(1) DEFAULT 1,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- UTILISATION DES COUPONS
-- ============================================
CREATE TABLE t_b3s_coupon_usage (
  PK_COUPON_USAGE INT AUTO_INCREMENT PRIMARY KEY,
  FK_COUPON INT NOT NULL,
  FK_USER INT NOT NULL,
  FK_ORDER INT NOT NULL,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_COUPON) REFERENCES t_b3s_coupon(PK_COUPON) ON DELETE CASCADE,
  FOREIGN KEY (FK_USER) REFERENCES t_b3s_user(PK_USER) ON DELETE CASCADE,
  FOREIGN KEY (FK_ORDER) REFERENCES t_b3s_order(PK_ORDER) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- WISHLIST
-- ============================================
CREATE TABLE t_b3s_wishlist (
  PK_WISHLIST INT AUTO_INCREMENT PRIMARY KEY,
  FK_USER INT NOT NULL,
  FK_PRODUCT INT NOT NULL,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_USER) REFERENCES t_b3s_user(PK_USER) ON DELETE CASCADE,
  FOREIGN KEY (FK_PRODUCT) REFERENCES t_b3s_product(PK_PRODUCT) ON DELETE CASCADE,
  UNIQUE KEY unique_user_product (FK_USER, FK_PRODUCT)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- AVIS PRODUITS
-- ============================================
CREATE TABLE t_b3s_review (
  PK_REVIEW INT AUTO_INCREMENT PRIMARY KEY,
  FK_PRODUCT INT NOT NULL,
  FK_USER INT NOT NULL,
  FK_ORDER INT NULL, -- Vérifier achat vérifié
  I_RATING INT NOT NULL CHECK (I_RATING BETWEEN 1 AND 5),
  S_TITLE VARCHAR(255),
  T_COMMENT TEXT,
  B_VERIFIED_PURCHASE TINYINT(1) DEFAULT 0,
  B_APPROVED TINYINT(1) DEFAULT 0,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_PRODUCT) REFERENCES t_b3s_product(PK_PRODUCT) ON DELETE CASCADE,
  FOREIGN KEY (FK_USER) REFERENCES t_b3s_user(PK_USER) ON DELETE CASCADE,
  FOREIGN KEY (FK_ORDER) REFERENCES t_b3s_order(PK_ORDER) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- MÉTHODES DE LIVRAISON
-- ============================================
CREATE TABLE t_b3s_shipping_method (
  PK_SHIPPING_METHOD INT AUTO_INCREMENT PRIMARY KEY,
  S_NAME VARCHAR(100) NOT NULL,
  S_DESCRIPTION TEXT,
  D_PRICE DECIMAL(10,2) NOT NULL,
  D_FREE_SHIPPING_THRESHOLD DECIMAL(10,2) DEFAULT NULL,
  I_ESTIMATED_DAYS_MIN INT,
  I_ESTIMATED_DAYS_MAX INT,
  B_ACTIVE TINYINT(1) DEFAULT 1,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- HISTORIQUE DES STATUTS DE COMMANDE
-- ============================================
CREATE TABLE t_b3s_order_status_history (
  PK_STATUS_HISTORY INT AUTO_INCREMENT PRIMARY KEY,
  FK_ORDER INT NOT NULL,
  E_OLD_STATUS ENUM('pending', 'processing', 'paid', 'shipped', 'delivered', 'cancelled', 'refunded'),
  E_NEW_STATUS ENUM('pending', 'processing', 'paid', 'shipped', 'delivered', 'cancelled', 'refunded') NOT NULL,
  T_COMMENT TEXT,
  FK_UPDATED_BY INT, -- Admin qui a fait le changement
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (FK_ORDER) REFERENCES t_b3s_order(PK_ORDER) ON DELETE CASCADE,
  FOREIGN KEY (FK_UPDATED_BY) REFERENCES t_b3s_user(PK_USER) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- PARAMÈTRES (Modifier la table existante)
-- ============================================
ALTER TABLE t_b3s_settings
  ADD COLUMN S_FACEBOOK_PIXEL VARCHAR(50),
  ADD COLUMN S_GOOGLE_ANALYTICS VARCHAR(50),
  ADD COLUMN S_GOOGLE_ADS_CONVERSION VARCHAR(50),
  ADD COLUMN S_STRIPE_PUBLIC_KEY VARCHAR(255),
  ADD COLUMN S_STRIPE_SECRET_KEY VARCHAR(255),
  ADD COLUMN S_PAYPAL_CLIENT_ID VARCHAR(255),
  ADD COLUMN S_PAYPAL_SECRET VARCHAR(255),
  ADD COLUMN B_MAINTENANCE_MODE TINYINT(1) DEFAULT 0,
  ADD COLUMN I_PRODUCTS_PER_PAGE INT DEFAULT 12,
  ADD COLUMN B_ALLOW_GUEST_CHECKOUT TINYINT(1) DEFAULT 1,
  ADD COLUMN CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ADD COLUMN UPDATED_AT TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP;
```

---

## 📦 PACKAGES PHP RECOMMANDÉS

### Installation via Composer

```bash
# Déjà installés
composer require altorouter/altorouter      # ✅ Routing
composer require vlucas/phpdotenv           # ✅ Configuration

# À installer
composer require respect/validation         # Validation des données
composer require stripe/stripe-php          # Paiement Stripe
composer require paypal/rest-api-sdk-php    # Paiement PayPal
composer require phpmailer/phpmailer        # Envoi d'emails
composer require dompdf/dompdf              # Génération PDF (factures)
composer require intervention/image         # Manipulation d'images
composer require league/flysystem           # Gestion fichiers/uploads
composer require monolog/monolog            # Logging
composer require firebase/php-jwt           # JWT pour API REST (optionnel)

# Tests
composer require --dev phpunit/phpunit      # Tests unitaires
composer require --dev fakerphp/faker       # Données de test
```

---

## 🚀 ROADMAP DE DÉVELOPPEMENT

### **PHASE 1 : FONDATIONS & SÉCURITÉ** (Priorité : CRITIQUE)

#### 1.1 Corrections Critiques

**Tâches**
- Corriger le bug session dans `Public/index.php` (ligne 4)
- Implémenter le hashing des mots de passe (PASSWORD_BCRYPT)
- Compléter le middleware CSRF avec génération et validation de tokens
- Créer un système de validation centralisé avec Respect/Validation

**Packages**
- `respect/validation`

**Bonnes Pratiques**
- Utiliser `password_hash()` et `password_verify()` pour les mots de passe
- Générer un token CSRF unique par session : `bin2hex(random_bytes(32))`
- Valider TOUS les inputs utilisateur (never trust user input)
- Utiliser des requêtes préparées (déjà fait dans Query.php)

**Fichiers à créer**
```
Utilities/Validator.php          # Classe de validation
Controllers/Middleware/CSRFMiddleware.php  # Compléter
Utilities/Security.php           # Helpers sécurité
```

**Exemple : Validator.php**
```php
<?php
namespace Utilities;

use Respect\Validation\Validator as v;

class Validator {
    private array $errors = [];
    
    public function validate(array $data, array $rules): bool {
        foreach ($rules as $field => $rule) {
            try {
                $rule->assert($data[$field] ?? null);
            } catch (\Exception $e) {
                $this->errors[$field] = $e->getMessage();
            }
        }
        return empty($this->errors);
    }
    
    public function getErrors(): array {
        return $this->errors;
    }
}

// Utilisation
$validator = new Validator();
$rules = [
    'email' => v::email()->notEmpty(),
    'password' => v::stringType()->length(8, null)
];
if (!$validator->validate($_POST, $rules)) {
    $errors = $validator->getErrors();
}
```

---

#### 1.2 Mise à Jour du Schéma de Base de Données

**Tâches**
- Exécuter le script SQL complet (voir section Schéma)
- Créer les migrations manuelles (fichiers SQL versionnés)
- Créer tous les Models correspondants

**Fichiers à créer**
```
Database/migrations/
  001_create_categories.sql
  002_alter_products.sql
  003_create_orders.sql
  ...
  
Model/
  Category.php
  ProductImage.php
  ProductVariant.php
  Address.php
  Order.php
  OrderItem.php
  Cart.php
  CartItem.php
  Coupon.php
  Review.php
  ShippingMethod.php
```

**Bonnes Pratiques**
- Versionner les migrations avec timestamps
- Utiliser des transactions pour les migrations complexes
- Créer un script `migrate.php` pour automatiser

---

#### 1.3 Amélioration du Query Builder

**Tâches**
- Rendre les méthodes `update()` et `delete()` dynamiques (utiliser la PK de la table)
- Ajouter pagination, tri, recherche
- Ajouter support des relations (hasMany, belongsTo)

**Fichiers à modifier**
```
Database/Query.php
```

**Exemple : Pagination**
```php
public function paginate(int $page = 1, int $perPage = 15): array {
    $offset = ($page - 1) * $perPage;
    $sql = "SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    return [
        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
        'total' => $this->count(),
        'page' => $page,
        'perPage' => $perPage
    ];
}

public function count(): int {
    $sql = "SELECT COUNT(*) FROM {$this->table}";
    return (int) $this->db->query($sql)->fetchColumn();
}
```

---

### **PHASE 2 : DASHBOARD ADMIN** (Priorité : HAUTE)

#### 2.1 Authentification Admin

**Tâches**
- Créer système de login/logout
- Implémenter remember me (tokens persistants)
- Créer reset password avec tokens temporaires
- Middleware de vérification des rôles (admin, manager)

**Fichiers à créer**
```
Controllers/Auth/LoginController.php
Controllers/Auth/RegisterController.php
Controllers/Auth/ForgotPasswordController.php
Controllers/Auth/ResetPasswordController.php
Controllers/Middleware/RoleMiddleware.php
Views/auth/login.php
Views/auth/register.php
Views/auth/forgot-password.php
Views/auth/reset-password.php
```

**Routes**
```php
Router::get('/login', '\Controller\Auth\LoginController:showLoginForm');
Router::post('/login', '\Controller\Auth\LoginController:login');
Router::get('/logout', '\Controller\Auth\LoginController:logout');
Router::post('/register', '\Controller\Auth\RegisterController:register');
```

**Bonnes Pratiques**
- Limiter les tentatives de connexion (rate limiting)
- Logger les tentatives de connexion échouées
- Utiliser des tokens sécurisés pour reset password (expiration 1h)
- Implémenter 2FA (optionnel mais recommandé)

---

#### 2.2 Gestion des Produits

**Tâches**
- CRUD produits complet (Create, Read, Update, Delete)
- Upload multiple d'images avec redimensionnement
- Gestion des variants (taille, couleur)
- Gestion du stock
- SEO (meta title, description, keywords)
- Import/Export CSV

**Packages**
- `intervention/image` (redimensionnement)
- `league/flysystem` (gestion uploads)

**Fichiers à créer**
```
Controllers/Admin/ProductController.php
Controllers/Admin/CategoryController.php
Views/admin/product/index.php        # Liste
Views/admin/product/create.php       # Création
Views/admin/product/edit.php         # Édition
Views/admin/product/show.php         # Détails
Utilities/ImageUploader.php
```

**Routes**
```php
Router::group('/admin', function() {
    Router::get('/products', '\Admin\ProductController:index');
    Router::get('/products/create', '\Admin\ProductController:create');
    Router::post('/products', '\Admin\ProductController:store');
    Router::get('/products/{id}/edit', '\Admin\ProductController:edit');
    Router::post('/products/{id}', '\Admin\ProductController:update');
    Router::post('/products/{id}/delete', '\Admin\ProductController:destroy');
});
```

**Bonnes Pratiques**
- Valider les types de fichiers (MIME type checking)
- Limiter la taille des uploads (max 5MB par image)
- Générer des thumbnails automatiquement (150x150, 300x300, 800x800)
- Stocker les images dans `Public/assets/images/products/{product_id}/`
- Utiliser des slugs SEO-friendly (ex: `chaussure-nike-air-max-90`)

**Exemple : Upload Image**
```php
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploader {
    public function upload($file, string $productId): array {
        $path = PUBLIC_PATH . "/assets/images/products/{$productId}/";
        if (!is_dir($path)) mkdir($path, 0755, true);
        
        $filename = uniqid() . '.jpg';
        $img = Image::make($file['tmp_name']);
        
        // Original
        $img->save($path . $filename, 90);
        
        // Thumbnails
        $img->fit(150, 150)->save($path . 'thumb_' . $filename);
        $img->fit(300, 300)->save($path . 'medium_' . $filename);
        
        return [
            'original' => $filename,
            'thumb' => 'thumb_' . $filename,
            'medium' => 'medium_' . $filename
        ];
    }
}
```

---

#### 2.3 Gestion des Catégories

**Tâches**
- CRUD catégories
- Support catégories parentes (hiérarchie)
- Réorganisation par drag & drop (ordre)

**Fichiers à créer**
```
Controllers/Admin/CategoryController.php
Views/admin/category/index.php
Views/admin/category/create.php
Views/admin/category/edit.php
```

---

#### 2.4 Gestion des Commandes

**Tâches**
- Liste des commandes avec filtres (statut, date, client)
- Détails de commande
- Changement de statut (pending → processing → shipped → delivered)
- Génération de factures PDF
- Ajout de numéro de tracking
- Système de remboursement

**Packages**
- `dompdf/dompdf` (PDF)

**Fichiers à créer**
```
Controllers/Admin/OrderController.php
Views/admin/order/index.php
Views/admin/order/show.php
Utilities/InvoiceGenerator.php
Views/pdf/invoice.php
```

**Bonnes Pratiques**
- Envoyer un email à chaque changement de statut
- Logger tous les changements dans `t_b3s_order_status_history`
- Générer des numéros de commande uniques : `ORD-{YEAR}{MONTH}-{RANDOM}`

**Exemple : Génération PDF**
```php
use Dompdf\Dompdf;

class InvoiceGenerator {
    public function generate(int $orderId): string {
        $order = (new Order())->findOne($orderId);
        
        ob_start();
        include VIEWS . '/pdf/invoice.php';
        $html = ob_get_clean();
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = "invoice_{$order['S_ORDER_NUMBER']}.pdf";
        file_put_contents(PUBLIC_PATH . "/invoices/{$filename}", $dompdf->output());
        
        return $filename;
    }
}
```

---

#### 2.5 Gestion des Clients

**Tâches**
- Liste des clients avec recherche
- Détails client (infos, commandes, adresses)
- Segmentation (VIP, nouveaux, inactifs)
- Export CSV

**Fichiers à créer**
```
Controllers/Admin/CustomerController.php
Views/admin/customer/index.php
Views/admin/customer/show.php
```

---

#### 2.6 Gestion des Coupons

**Tâches**
- CRUD coupons
- Validation des règles (montant min, dates, usage)
- Statistiques d'utilisation

**Fichiers à créer**
```
Controllers/Admin/CouponController.php
Views/admin/coupon/index.php
Views/admin/coupon/create.php
Views/admin/coupon/edit.php
Model/Coupon.php
Utilities/CouponValidator.php
```

**Bonnes Pratiques**
- Codes en majuscules (ex: SUMMER2024)
- Vérifier expiration et usage max
- Empêcher cumul de coupons (sauf si autorisé)

---

#### 2.7 Analytics & Marketing

**Tâches**
- Dashboard avec KPIs (CA, commandes, clients, taux conversion)
- Graphiques (Chart.js ou ApexCharts)
- Intégration Facebook Pixel
- Intégration Google Analytics 4
- Intégration Google Ads Conversion Tracking

**Fichiers à créer**
```
Controllers/Admin/DashboardController.php
Controllers/Admin/AnalyticsController.php
Views/admin/dashboard.php
Views/admin/analytics.php
Public/assets/js/charts.js
```

**Bonnes Pratiques**
- Stocker les scripts de tracking dans `t_b3s_settings`
- Injecter les scripts dans le layout front-end
- Utiliser Google Tag Manager pour centraliser

**Exemple : Facebook Pixel**
```php
<!-- Dans Views/layout.php -->
<?php if (!empty($settings['S_FACEBOOK_PIXEL'])): ?>
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?= $settings['S_FACEBOOK_PIXEL'] ?>');
  fbq('track', 'PageView');
</script>
<?php endif; ?>
```

---

#### 2.8 Paramètres

**Tâches**
- Configuration boutique (nom, logo, description)
- Paramètres de paiement (Stripe, PayPal)
- Paramètres de livraison
- Taxes et devises
- Mode maintenance

**Fichiers à créer**
```
Controllers/Admin/SettingsController.php
Views/admin/settings/general.php
Views/admin/settings/payment.php
Views/admin/settings/shipping.php
Views/admin/settings/tax.php
```

---

### **PHASE 3 : STORE FRONT (Boutique Client)** (Priorité : HAUTE)

#### 3.1 Catalogue Produits

**Tâches**
- Page d'accueil avec produits mis en avant
- Listing produits avec filtres (catégorie, prix, note)
- Recherche avec suggestions (AJAX)
- Pagination
- Tri (prix croissant/décroissant, popularité, nouveautés)

**Fichiers à créer**
```
Controllers/ShopController.php
Controllers/SearchController.php
Views/shop/index.php
Views/shop/category.php
Views/partials/product-card.php
Views/partials/filters.php
Public/assets/js/shop.js
```

**Routes**
```php
Router::get('/shop', '\Controller\ShopController:index');
Router::get('/shop/category/{slug}', '\Controller\ShopController:category');
Router::get('/search', '\Controller\SearchController:search');
```

**Bonnes Pratiques**
- Utiliser AJAX pour les filtres (pas de rechargement)
- Implémenter lazy loading pour les images
- Ajouter breadcrumbs pour SEO
- Utiliser des URLs SEO-friendly : `/shop/category/chaussures-homme`

---

#### 3.2 Fiche Produit

**Tâches**
- Affichage détaillé (images, description, prix, stock)
- Galerie d'images avec zoom
- Sélection de variants
- Bouton "Ajouter au panier"
- Produits similaires
- Avis clients
- SEO (meta tags, schema.org)

**Fichiers à créer**
```
Controllers/ProductController.php
Views/product/show.php
Public/assets/js/product.js
```

**Bonnes Pratiques**
- Implémenter schema.org Product markup pour SEO
- Afficher le stock en temps réel
- Désactiver le bouton si rupture de stock
- Ajouter Open Graph pour partage social

**Exemple : Schema.org**
```php
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "<?= $product['TITLE'] ?>",
  "image": "<?= $product['S_IMAGE_MAIN'] ?>",
  "description": "<?= $product['S_META_DESCRIPTION'] ?>",
  "sku": "<?= $product['S_SKU'] ?>",
  "offers": {
    "@type": "Offer",
    "url": "<?= $_SERVER['REQUEST_URI'] ?>",
    "priceCurrency": "EUR",
    "price": "<?= $product['PRICE'] ?>",
    "availability": "<?= $product['IN_STOCK'] ? 'InStock' : 'OutOfStock' ?>"
  }
}
</script>
```

---

#### 3.3 Panier

**Tâches**
- Ajout/suppression de produits
- Modification des quantités
- Calcul automatique (sous-total, taxes, livraison)
- Persistance (session pour invités, DB pour connectés)
- Panier mini (header)
- Application de coupon

**Fichiers à créer**
```
Controllers/CartController.php
Views/cart/index.php
Views/partials/mini-cart.php
Public/assets/js/cart.js
Utilities/CartManager.php
```

**Routes**
```php
Router::post('/cart/add', '\Controller\CartController:add');
Router::post('/cart/update', '\Controller\CartController:update');
Router::post('/cart/remove', '\Controller\CartController:remove');
Router::post('/cart/apply-coupon', '\Controller\CartController:applyCoupon');
Router::get('/cart', '\Controller\CartController:index');
```

**Bonnes Pratiques**
- Valider le stock avant ajout
- Utiliser AJAX pour toutes les actions
- Afficher un feedback visuel (toast notifications)
- Merger le panier session → DB lors de la connexion

**Exemple : CartManager**
```php
class CartManager {
    private $cart;
    
    public function __construct() {
        if (isset($_SESSION['user_id'])) {
            // Charger depuis DB
            $this->cart = (new Cart())->getUserCart($_SESSION['user_id']);
        } else {
            // Charger depuis session
            $this->cart = $_SESSION['cart'] ?? [];
        }
    }
    
    public function add(int $productId, int $quantity = 1, ?int $variantId = null) {
        // Vérifier stock
        $product = (new Product())->findOne($productId);
        if ($product['I_STOCK_QUANTITY'] < $quantity) {
            throw new Exception("Stock insuffisant");
        }
        
        // Ajouter au panier
        // ...
    }
    
    public function getTotal(): float {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
```

---

#### 3.4 Checkout (Tunnel d'Achat)

**Tâches**
- Étape 1 : Informations client (login ou guest)
- Étape 2 : Adresse de livraison/facturation
- Étape 3 : Méthode de livraison
- Étape 4 : Paiement (Stripe, PayPal)
- Étape 5 : Confirmation et email

**Packages**
- `stripe/stripe-php`
- `paypal/rest-api-sdk-php`
- `phpmailer/phpmailer`

**Fichiers à créer**
```
Controllers/CheckoutController.php
Views/checkout/step1-login.php
Views/checkout/step2-address.php
Views/checkout/step3-shipping.php
Views/checkout/step4-payment.php
Views/checkout/confirmation.php
Utilities/PaymentGateway/StripeGateway.php
Utilities/PaymentGateway/PayPalGateway.php
Utilities/Mailer.php
Views/emails/order-confirmation.php
```

**Routes**
```php
Router::get('/checkout', '\Controller\CheckoutController:index');
Router::post('/checkout/address', '\Controller\CheckoutController:saveAddress');
Router::post('/checkout/shipping', '\Controller\CheckoutController:saveShipping');
Router::post('/checkout/payment', '\Controller\CheckoutController:processPayment');
Router::get('/checkout/success', '\Controller\CheckoutController:success');
```

**Bonnes Pratiques**
- Sauvegarder l'état à chaque étape (session)
- Valider chaque étape avant de passer à la suivante
- Utiliser HTTPS obligatoire pour le paiement
- Ne jamais stocker les numéros de carte (PCI compliance)
- Envoyer email de confirmation avec PDF de facture

**Exemple : Stripe Payment**
```php
use Stripe\Stripe;
use Stripe\Charge;

class StripeGateway {
    public function __construct() {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
    }
    
    public function charge(float $amount, string $token, array $metadata = []): array {
        try {
            $charge = Charge::create([
                'amount' => $amount * 100, // En centimes
                'currency' => 'eur',
                'source' => $token,
                'description' => 'Commande ' . $metadata['order_number'],
                'metadata' => $metadata
            ]);
            
            return [
                'success' => true,
                'transaction_id' => $charge->id
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
```

---

#### 3.5 Compte Client

**Tâches**
- Inscription/Connexion
- Tableau de bord (overview)
- Historique des commandes
- Détails de commande
- Gestion des adresses
- Modification du profil
- Wishlist
- Changement de mot de passe

**Fichiers à créer**
```
Controllers/AccountController.php
Views/account/dashboard.php
Views/account/orders.php
Views/account/order-details.php
Views/account/addresses.php
Views/account/profile.php
Views/account/wishlist.php
Views/account/password.php
```

**Routes**
```php
Router::group('/account', function() {
    Router::get('/', '\Controller\AccountController:dashboard');
    Router::get('/orders', '\Controller\AccountController:orders');
    Router::get('/orders/{id}', '\Controller\AccountController:orderDetails');
    Router::get('/addresses', '\Controller\AccountController:addresses');
    Router::post('/addresses', '\Controller\AccountController:saveAddress');
    Router::get('/wishlist', '\Controller\AccountController:wishlist');
});
```

---

#### 3.6 Avis Produits

**Tâches**
- Affichage des avis sur fiche produit
- Soumission d'avis (clients connectés uniquement)
- Modération admin (approuver/rejeter)
- Calcul de la note moyenne

**Fichiers à créer**
```
Controllers/ReviewController.php
Views/partials/reviews.php
Views/partials/review-form.php
```

---

### **PHASE 4 : OPTIMISATION & FONCTIONNALITÉS AVANCÉES** (Priorité : MOYENNE)

#### 4.1 Performance

**Tâches**
- Mise en cache (Redis ou fichiers)
- Optimisation des requêtes SQL (indexes, EXPLAIN)
- Minification CSS/JS
- Compression Gzip
- CDN pour les assets statiques

**Packages**
- `predis/predis` (Redis client)

**Bonnes Pratiques**
- Cacher les catégories, paramètres, produits populaires
- Utiliser lazy loading pour les images
- Implémenter HTTP/2 Server Push

---

#### 4.2 SEO

**Tâches**
- Sitemap.xml automatique
- Robots.txt
- Canonical URLs
- Fil d'Ariane (breadcrumbs)
- URLs propres (pas de ?id=123)

**Fichiers à créer**
```
Controllers/SitemapController.php
Public/robots.txt
```

---

#### 4.3 Email Marketing

**Tâches**
- Newsletter (inscription/désinscription)
- Abandoned cart recovery (email après 24h)
- Email de bienvenue
- Email de relance (produits vus)

**Packages**
- `phpmailer/phpmailer`

**Fichiers à créer**
```
Controllers/NewsletterController.php
Utilities/EmailCampaign.php
Database/migrations/010_create_newsletter.sql
```

---

#### 4.4 Multi-Devises

**Tâches**
- Sélecteur de devise
- Conversion automatique (API taux de change)
- Affichage des prix convertis

**Packages**
- API externe : `exchangerate-api.com` ou `fixer.io`

---

#### 4.5 API REST (pour future app mobile)

**Tâches**
- Endpoints REST pour produits, panier, commandes
- Authentification JWT
- Documentation Swagger

**Packages**
- `firebase/php-jwt`

**Routes**
```php
Router::group('/api/v1', function() {
    Router::get('/products', '\Controller\Api\ProductController:index');
    Router::get('/products/{id}', '\Controller\Api\ProductController:show');
    Router::post('/cart', '\Controller\Api\CartController:add');
});
```

---

### **PHASE 5 : TESTS & DÉPLOIEMENT** (Priorité : HAUTE)

#### 5.1 Tests

**Tâches**
- Tests unitaires (Models, Utilities)
- Tests fonctionnels (Controllers)
- Tests d'intégration (Paiement, Email)

**Packages**
- `phpunit/phpunit`
- `fakerphp/faker`

**Fichiers à créer**
```
tests/Unit/ModelTest.php
tests/Unit/ValidatorTest.php
tests/Feature/CheckoutTest.php
phpunit.xml
```

**Exemple : Test Unitaire**
```php
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
    public function testCanCreateProduct() {
        $product = new Product();
        $data = [
            'FK_CATEGORY' => 1,
            'SLUG' => 'test-product',
            'TITLE' => 'Test Product',
            'PRICE' => 99.99
        ];
        
        $result = $product->insert($data);
        $this->assertTrue($result);
    }
}
```

---

#### 5.2 Sécurité (Checklist OWASP)

**Tâches**
- ✅ Protection CSRF (tokens)
- ✅ Protection XSS (htmlspecialchars sur outputs)
- ✅ Protection SQL Injection (requêtes préparées)
- ✅ Upload sécurisé (validation MIME, taille, extension)
- ✅ Hash mots de passe (bcrypt)
- ✅ HTTPS obligatoire
- ✅ Headers sécurité (X-Frame-Options, CSP)
- ✅ Rate limiting (login, API)
- ✅ Logs des actions sensibles

**Fichiers à créer**
```
Utilities/RateLimiter.php
Config/security-headers.php
```

---

#### 5.3 Documentation

**Tâches**
- README.md (installation, configuration)
- Documentation API (Swagger)
- Guide développeur (architecture, conventions)

---

#### 5.4 Déploiement

**Tâches**
- Configuration serveur (Apache/Nginx)
- SSL/TLS (Let's Encrypt)
- Backup automatique DB
- Monitoring (logs, erreurs)

---

## 🎯 FONCTIONNALITÉS DIFFÉRENCIANTES PROPOSÉES

### 1. **Système de Points de Fidélité**
- Gagner des points à chaque achat
- Convertir points en réduction
- Niveaux VIP (Bronze, Silver, Gold)

### 2. **Comparateur de Produits**
- Sélectionner jusqu'à 4 produits
- Tableau comparatif des caractéristiques
- Aide à la décision

### 3. **Wishlist Partageable**
- Créer des listes de souhaits
- Partager via lien unique
- Idéal pour cadeaux

### 4. **Live Chat Support**
- Widget de chat en temps réel
- Support client instantané
- Intégration Tawk.to ou Crisp

### 5. **Recommandations Personnalisées**
- Algorithme "Vous aimerez aussi"
- Basé sur l'historique de navigation
- Machine learning simple (collaborative filtering)

---

## 📋 CHECKLIST SÉCURITÉ (OWASP TOP 10)

| Vulnérabilité | Protection | Statut |
|---------------|------------|--------|
| **A01: Broken Access Control** | Middleware de rôles, vérification permissions | ⚠️ À implémenter |
| **A02: Cryptographic Failures** | HTTPS, hash bcrypt, chiffrement données sensibles | ⚠️ Partiel |
| **A03: Injection** | Requêtes préparées PDO | ✅ OK |
| **A04: Insecure Design** | Validation inputs, sanitization outputs | ⚠️ À améliorer |
| **A05: Security Misconfiguration** | Désactiver display_errors en prod, headers sécurité | ⚠️ À configurer |
| **A06: Vulnerable Components** | Composer update régulier | ⚠️ À surveiller |
| **A07: Auth Failures** | Rate limiting, 2FA, tokens sécurisés | ⚠️ À implémenter |
| **A08: Software Integrity** | Vérification intégrité uploads | ⚠️ À implémenter |
| **A09: Logging Failures** | Monolog, logs centralisés | ⚠️ À implémenter |
| **A10: SSRF** | Validation URLs, whitelist domaines | ⚠️ À implémenter |

---

## 📊 PRIORISATION (MoSCoW)

### **MUST HAVE** (MVP)
- ✅ Authentification (login/logout)
- ✅ CRUD Produits
- ✅ CRUD Catégories
- ✅ Panier
- ✅ Checkout
- ✅ Paiement Stripe
- ✅ Gestion commandes admin
- ✅ Compte client
- ✅ Sécurité de base (CSRF, XSS, SQL injection)

### **SHOULD HAVE** (V1)
- ✅ Coupons de réduction
- ✅ Wishlist
- ✅ Avis produits
- ✅ Recherche avancée
- ✅ Email transactionnels
- ✅ Analytics dashboard
- ✅ Multi-images produits
- ✅ Variants produits

### **COULD HAVE** (V2)
- ⭕ Multi-devises
- ⭕ API REST
- ⭕ Abandoned cart recovery
- ⭕ Points de fidélité
- ⭕ Comparateur produits
- ⭕ Live chat
- ⭕ Recommandations IA

### **WON'T HAVE** (Hors scope)
- ❌ Multi-tenant SaaS (pour l'instant)
- ❌ Application mobile native
- ❌ Marketplace multi-vendeurs

---

## 🛠️ CONVENTIONS DE CODE

### Nomenclature
- **Classes** : PascalCase (`ProductController`)
- **Méthodes** : camelCase (`getUserOrders()`)
- **Variables** : camelCase (`$userId`)
- **Constantes** : UPPER_SNAKE_CASE (`MAX_UPLOAD_SIZE`)
- **Tables DB** : snake_case avec préfixe (`t_b3s_product`)
- **Colonnes DB** : UPPER_SNAKE_CASE avec préfixe type (`PK_`, `FK_`, `S_`, `I_`, `D_`, `B_`, `E_`, `T_`, `DT_`)

### Structure des fichiers
```
Controllers/
  Admin/           # Back-office
  Auth/            # Authentification
  Api/             # API REST
  Middleware/      # Middlewares
  {Name}Controller.php
  
Model/
  {Name}.php
  
Views/
  admin/           # Back-office
  auth/            # Login/Register
  shop/            # Catalogue
  product/         # Fiche produit
  cart/            # Panier
  checkout/        # Tunnel achat
  account/         # Compte client
  emails/          # Templates email
  pdf/             # Templates PDF
  partials/        # Composants réutilisables
  layout.php       # Layout front
```

### Commentaires
```php
/**
 * Description de la méthode
 * 
 * @param int $userId ID de l'utilisateur
 * @param array $data Données à traiter
 * @return bool Succès de l'opération
 * @throws Exception Si validation échoue
 */
public function updateUser(int $userId, array $data): bool {
    // Code...
}
```

---

## 📅 ESTIMATION TEMPORELLE

| Phase | Durée estimée | Complexité |
|-------|---------------|------------|
| Phase 1 : Fondations & Sécurité | 1-2 semaines | Moyenne |
| Phase 2 : Dashboard Admin | 3-4 semaines | Haute |
| Phase 3 : Store Front | 3-4 semaines | Haute |
| Phase 4 : Optimisation | 1-2 semaines | Moyenne |
| Phase 5 : Tests & Déploiement | 1 semaine | Faible |
| **TOTAL** | **9-13 semaines** | - |

---

## 🚀 PROCHAINES ÉTAPES IMMÉDIATES

1. **Corriger le bug session** dans `Public/index.php`
2. **Exécuter les migrations SQL** pour créer toutes les tables
3. **Installer les packages recommandés** via Composer
4. **Créer le système de validation** avec Respect/Validation
5. **Implémenter l'authentification complète** (login/register/reset)
6. **Commencer le CRUD produits** dans le dashboard admin

---

## 📚 RESSOURCES UTILES

- **Sécurité** : [OWASP PHP Security Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html)
- **PSR Standards** : [PHP-FIG](https://www.php-fig.org/)
- **Stripe Docs** : [https://stripe.com/docs/api](https://stripe.com/docs/api)
- **PayPal Docs** : [https://developer.paypal.com/](https://developer.paypal.com/)
- **Schema.org** : [https://schema.org/Product](https://schema.org/Product)

---

**Auteur** : Cascade AI  
**Date** : 2026-05-07  
**Version** : 1.0
