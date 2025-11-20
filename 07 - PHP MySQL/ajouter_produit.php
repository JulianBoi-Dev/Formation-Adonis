<?php require 'config.php'; ?>

<?php
if(isset($_POST["ajouter"])){
    $nom = $_POST["nom_produit"];
    $desc = $_POST["description_produit"];
    $prix = $_POST["prix_produit"];

    $req = $pdo->prepare("INSERT INTO produits(nom_produit, description_produit, prix_produit) VALUES (?, ?, ?)");
    $req->execute([$nom, $desc, $prix]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Ajouter un produit</h2>

<form method="POST">
    <input class="form-control mb-2" name="nom_produit" placeholder="Nom">
    <textarea class="form-control mb-2" name="description_produit" placeholder="Description"></textarea>
    <input class="form-control mb-2" name="prix_produit" placeholder="Prix">
    <button class="btn btn-success" name="ajouter">Ajouter</button>
</form>

</body>
</html>
