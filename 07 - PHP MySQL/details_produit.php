<?php 
require 'config.php';

$id = htmlspecialchars($_GET["id_produit"]);

$req = $pdo->prepare("SELECT * FROM produits WHERE id_produit = ?");
$req->bindParam(1, $id);
$req->execute();

$produit = $req->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Détails produit</title>
</head>
<body class="p-4">

<h2><?= $produit["nom_produit"] ?></h2>
<p><strong>Description :</strong> <?= $produit["description_produit"] ?></p>
<p><strong>Prix :</strong> <?= $produit["prix_produit"] ?> €</p>

<a href="editer_produit.php?id_produit=<?= $produit["id_produit"] ?>" class="btn btn-warning">Modifier</a>
<a href="supprimer_produit.php?id_produit=<?= $produit["id_produit"] ?>" class="btn btn-danger">Supprimer</a>
<a href="index.php" class="btn btn-secondary">Retour</a>

</body>
</html>
