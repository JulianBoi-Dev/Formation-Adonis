<?php
    require 'model/ProduitModel.php';

    $id = htmlspecialchars($_GET["id_produit"]);
    $produitModel = new Produits(null,"", "", "");
    $produit = $produitModel->getById($id);
    if(!$produit) {
        header("Location: index.php");
    }

    if(isset($_POST["modifier"])){
        $produit = new Produits($id, $_POST["nom_produit"], $_POST["description_produit"], $_POST["prix_produit"]);
        $produit->update($id);
        header("Location: details_produit.php?id_produit=".$id);
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Éditer un produit</h2>

<form method="POST">
    <input class="form-control mb-2" name="nom_produit" value="<?= $produit["nom_produit"] ?>">
    <textarea class="form-control mb-2" name="description_produit"><?= $produit["description_produit"] ?></textarea>
    <input class="form-control mb-2" name="prix_produit" value="<?= $produit["prix_produit"] ?>">
    <button class="btn btn-primary" name="modifier">Modifier</button>
</form>

</body>
</html>
