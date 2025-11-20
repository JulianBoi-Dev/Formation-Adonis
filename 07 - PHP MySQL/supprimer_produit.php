<?php
require 'config.php';

$id = $_GET["id_produit"];

try {
    $req = $pdo->prepare("DELETE FROM produits WHERE id_produit = ?");
    $req->bindParam(1, $id);
    $req->execute();

    echo "<script>window.location='index.php';</script>";

} catch(PDOException $e){
    die("Erreur : " . $e->getMessage());
}
