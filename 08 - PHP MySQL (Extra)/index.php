<?php 
    require 'model/ProduitModel.php';
    
    $produitModel = new Produits();
    $produits = $produitModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Produits</title>
</head>
<body class="p-4">

<h1>Liste des produits</h1>
<a href="ajouter_produit.php" class="btn btn-success mb-3">Ajouter un produit</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Actions</th>
    </tr>

    <?php foreach($produits as $produit): ?>
    <tr>
        <td><?= $produit["id_produit"] ?></td>
        <td><?= $produit["nom_produit"] ?></td>
        <td><?= number_format($produit["prix_produit"], 2, ',', ' ') ?> €</td>
        <td>
            <a href="details_produit.php?id_produit=<?= $produit["id_produit"] ?>" class="btn btn-info btn-sm">Détails</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
