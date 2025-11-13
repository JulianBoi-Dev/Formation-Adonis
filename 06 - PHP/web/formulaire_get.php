<!-- Exercices 8 -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire GET</title>
</head>
<body>

<form method="get" action="formulaire_get.php">
    <input type="text" name="utilisateur" placeholder="Votre nom">
    <button type="submit">Valider</button>
</form>

<?php

if (isset($_GET["utilisateur"]) && !empty($_GET["utilisateur"])) {

    $utilisateur = htmlentities(trim($_GET["utilisateur"]));

    echo "<p>Bonjour, merci : " . $utilisateur . "</p>";
}
?>

</body>
</html>
