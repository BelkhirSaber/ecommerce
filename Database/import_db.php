<?php
// 1. Paramètres de connexion
$host     = 'localhost';
$db_name  = 'b3s_store'; // Assurez-vous que la base existe déjà
$user     = 'root';
$password = ''; // Par défaut vide sur XAMPP/WAMP

try {
    // 2. Connexion à MySQL via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Connexion réussie à la base de données.<br>";

    // 3. Lecture du fichier SQL
    $sqlFile = __DIR__.'/b3s_store.sql';
    
    if (!file_exists($sqlFile)) {
        die("❌ Erreur : Le fichier $sqlFile est introuvable.");
    }

    $sql = file_get_contents($sqlFile);

    // 4. Exécution des requêtes
    // Note : exec() peut exécuter plusieurs requêtes séparées par des points-virgules
    $pdo->exec($sql);

    echo "🚀 Les tables ont été créées avec succès dans '$db_name' !";

} catch (PDOException $e) {
    die("❌ Erreur lors de l'importation : " . $e->getMessage());
}