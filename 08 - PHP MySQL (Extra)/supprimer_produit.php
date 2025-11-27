<?php
    require 'model/ProduitModel.php';
    $id = htmlspecialchars($_GET["id_produit"]);
    $produitModel = new Produits(null,"", "", "");
    $produit = $produitModel->getById($id);
    if(!$produit) {
        header("Location: index.php");
    }
    $produitModel->delete($id);
    header("Location: index.php");