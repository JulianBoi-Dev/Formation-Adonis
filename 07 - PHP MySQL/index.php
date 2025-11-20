<?php require 'config.php'; ?>

<?php
$req = $pdo->query("SELECT * FROM produits");
$produits = $req->fetchAll(PDO::FETCH_ASSOC);
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

    <?php foreach($produits as $p): ?>
    <tr>
        <td><?= $p["id_produit"] ?></td>
        <td><?= $p["nom_produit"] ?></td>
        <td><?= $p["prix_produit"] ?> €</td>
        <td>
            <a href="details_produit.php?id_produit=<?= $p["id_produit"] ?>" class="btn btn-info btn-sm">Détails</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
