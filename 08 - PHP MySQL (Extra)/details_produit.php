<?php 
    require 'model/ProduitModel.php';
    $id = htmlspecialchars($_GET["id_produit"]);
    $produitModel = new Produits(null,"", "", "");
    $produit = $produitModel->getById($id);
    if(!$produit) {
        header("Location: index.php");
    }
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
<p><strong>Prix :</strong> <?= number_format($produit["prix_produit"], 2, ',', ' ') ?> €</p>

<a href="editer_produit.php?id_produit=<?= $produit["id_produit"] ?>" class="btn btn-warning">Modifier</a>
<a href="supprimer_produit.php?id_produit=<?= $produit["id_produit"] ?>" class="btn btn-danger">Supprimer</a>
<a href="index.php" class="btn btn-secondary">Retour</a>

</body>
</html>
