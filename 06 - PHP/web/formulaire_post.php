<!-- Exercices 9 -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice POST</title>
</head>
<body>

<form method="post" action="formulaire_post.php">
    <input type="text" name="utilisateur" placeholder="Ajouter un prénom">
    <button type="submit">Valider</button>
</form>

<?php

if (isset($_POST["utilisateur"]) && !empty($_POST["utilisateur"])) {

    $tableau_prenom = ["Bob", "Paul", "Louis", "Edouard"];

    $utilisateur = trim($_POST["utilisateur"]);

    $tableau_prenom[] = $utilisateur;

    echo "<h2>Liste des prénoms (avec le nouveau) :</h2>";

    foreach ($tableau_prenom as $prenom) {
        echo htmlspecialchars($prenom) . "<br>";
    }

} else {
    echo "<p>Veuillez entrer un prénom et valider le formulaire.</p>";
}

?>
</body>
</html>
