<!-- Exercices 10 -->
<?php
$host = "localhost";
$dbname = "test";
$user = "root";
$pass = "";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Vous êtes connecté à PDO MySQL<br>";
} 
catch (PDOException $e) {
    echo "Erreur de connexion à PDO MySQL : " . $e->getMessage();
}
