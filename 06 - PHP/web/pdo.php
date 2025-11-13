<!-- Exercices 9 et 10 -->
<?php

$user = "root";
$pass = "";

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    var_dump($dbh);

    echo "Vous etes connecter a PDO MySQL";
} catch (PDOException $e) {
    echo "Erreur de connexion a PDO MySQL ! " . $e->getMessage();
}
?>
