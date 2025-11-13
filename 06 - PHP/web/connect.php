<?php
declare(strict_types = 1);

require_once "database.php";

?>
<!-- Exercices 10 -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion PDO</title>
</head>
<body>

<h2>Test de connexion PDO</h2>

<?php
if (isset($dbh) && $dbh instanceof PDO) {
    echo "<p>Connexion OK ✔</p>";
} else {
    echo "<p>Connexion échouée ❌</p>";
}
?>

</body>
</html>
