<?php
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("ID produit invalide");
}

$id_produit = (int) $_GET['id'];

try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=base_test;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $sql = "DELETE FROM produits WHERE id_produit = ?";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(1, $id_produit, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }

} catch (PDOException $e) {
    header("Location: index.php");
    exit;
}
