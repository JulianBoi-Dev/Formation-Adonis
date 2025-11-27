<?php require 'model/ProduitModel.php'; ?>


<?php
    if(isset($_POST["ajouter"])){
        $produit = new Produits(null, $_POST["nom_produit"], $_POST["description_produit"], $_POST["prix_produit"]);
        $produit->add();
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
