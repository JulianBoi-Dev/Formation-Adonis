<?php 
require 'config.php';

$id = htmlspecialchars($_GET["id_produit"]);

$req = $pdo->prepare("SELECT * FROM produits WHERE id_produit = ?");
$req->execute([$id]);
$produit = $req->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["modifier"])){
    $nom = htmlspecialchars($_POST["nom_produit"]);
    $desc = htmlspecialchars($_POST["description_produit"]);
    $prix = htmlspecialchars($_POST["prix_produit"]);

    $update = $pdo->prepare("
        UPDATE produits 
        SET nom_produit=?, description_produit=?, prix_produit=? 
        WHERE id_produit=?
    ");

    $update->execute([$nom, $desc, $prix, $id]);

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
