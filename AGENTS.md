# B3S E-Commerce — Agent Guide

## Project overview

PHP native e-commerce on XAMPP. Custom MVC with FastRoute, Illuminate/Eloquent (standalone), Twig, Vite + AdminLTE 3.

## Entry point & request flow

`Public/index.php` loads autoload, config, DB, then `Router/route.php`.
Routes in `Router/route.php` use `FastRoute\simpleDispatcher`. URL prefix (`/ecommerce/`) is stripped before dispatch — agent must know this when adding routes.

## Running the server

`RACINE` is computed dynamically in `Config/config.php` — relative URL path between `DOCUMENT_ROOT` and the project root. No hardcoded value:

```bash
# Apache/XAMPP → http://localhost/ecommerce/   (RACINE='ecommerce')
#   docroot = htdocs, .htaccess rewrites to Public/index.php
#   NOTE: Apache mode requires the Windows junction `assets/ → Public/assets`
#   (created with `mklink /J assets Public/assets`), because asset URLs are
#   served from {RACINE}/assets/dist/...

# PHP built-in server → http://localhost:8000/  (RACINE='')
php -S localhost:8000 -t Public router.php
#   router.php serves static files from Public/ and routes the rest to index.php
#   Without router.php, deep routes (/admin/...) return 404 — the built-in server
#   does not use .htaccess.
```

`Public/index.php` uses `__DIR__`-relative requires, so it works regardless of the server/CWD.

## Known bugs

- `Controllers\Middleware\CSRFMiddleware.php` is a stub that always returns `true`.
- Front-end pages (`/`, `/shop`, `/login`) return 500 — the referenced controllers/templates (`HomeController@view('home')`, `ShopController`, `LoginController`) don't exist. Only the admin dashboard works.

## Directory map (non-obvious)

| Path | Role |
|---|---|
| `Controllers/BaseController.php` | Twig setup + vite helper functions |
| `Controllers/Middleware/AuthMiddleware.php` | Session-based auth gate |
| `Model/` | Eloquent models, table prefix `t_b3s_`, PKs are `PK_*` (e.g. `PK_PRODUCT`) |
| `Domains/` | Business / stats logic (uses Eloquent models) |
| `Database/migrations/` | Anonymous-class migration files, runner: `php Database/migrations/migrate.php` |
| `Database/seeders/` | Seeders with truncate-all, runner: `php Database/seeders/seed.php` |
| `Config/vite-helper.php` | Functions `vite_asset()`, `vite_client()`, `vite_css()` — dev/prod switching via manifest.json existence. `vite_css()` traverses `imports` recursively to include CSS from imported chunks (e.g. Font Awesome). |

## Commands

```bash
# Install
composer install
npm install --legacy-peer-deps   # use --legacy-peer-deps because admin-lte@3.x peer deps conflict with Bootstrap 4
                                 # .npmrc has ignore-scripts=true (no Husky)

# Dev
npm run dev              # vite dev server on localhost:5173

# Build
npm run build            # vite build → Public/assets/dist/

# Database
php Database/migrations/migrate.php
php Database/seeders/seed.php
```

## Framework quirks

- **Vite**: root is `Public/`. Two entry points: `admin-bundle.js` (admin) and `app.js` (frontend). No other entries.
- **No CDN**: all CSS/JS comes through Vite from `node_modules` via ES module imports. Do not add `<link>` or `<script>` tags manually.
- **Admin layout** (`Views/admin/layout.twig`): only uses `vite_css()`, `vite_asset()`, `vite_client()`. No CDN links. Uses `{% set base_path = '/' ~ constant('RACINE') %}` for all internal URL references — any new Twig view must do the same.
- **CSS imports**: AdminLTE, Font Awesome, Bootstrap, and custom `admin.css` are all bundled via JS imports in the entry files.
- **JS modules**: `Public/assets/js/modules/` for reusable components, `Public/assets/js/pages/` for page-specific code.
- **DataTables**: v2.3.8 ESM. Do NOT call `DataTable(window, $)` — its factory does `window = window`, which throws in strict ES modules (`Cannot set property window of #<Window>`). The import auto-registers `$.fn.DataTable`. Init with `new DataTable('#table', opts)`.
- **DataTables i18n**: vendored locally at `Public/assets/js/vendor/datatables/fr-FR.json` and imported as JSON (Vite native JSON import). Do NOT use a CDN `language.url` — it is CORS-blocked.
- **AJAX-loaded views** (e.g. `Views/admin/product/add.php`): do NOT include `<script>` or `<link>` tags — their CSS/JS lives in `admin-bundle.js`.
- **In dev mode** assets are served from `localhost:5173`. In prod, `manifest.json` in `Public/assets/dist/` is read.
- **Eloquent**: custom PKs (`PK_PRODUCT`, `PK_USER`, etc.) and uppercase columns (`CREATED_AT`, `UPDATED_AT`). Set `protected $primaryKey` and `const CREATED_AT / UPDATED_AT` on every model.
- **Twig**: `.twig` extension, rendered by `BaseController::view()`. Some legacy `.php` views coexist but are dead code.
- **Admin routes**: all under `/admin` group in route file. `IS_ADMIN_ROUTE` constant defined at dispatch time.
- **`.htaccess`**: rewrites all requests to `Public/index.php`. `RACINE` is auto-detected in `Config/config.php` (`'ecommerce'` on XAMPP, `''` when docroot = `Public/`). `base_path` in Twig = `'/' ~ RACINE`, empty when RACINE is empty — views build links as `{{ base_path }}/admin/...`, so they work in both modes.
- **Tables**: all prefixed `t_b3s_` with `PK_*` primary keys and `FK_*` foreign keys.
- **npm**: `ignore-scripts=true` in `.npmrc`. AdminLTE runs on Bootstrap 4 (needs `popper.js@^1.16.1`, NOT `@popperjs/core`).
