<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/darkly/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body>

<?php
    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
        die("Produit invalide");
    }

    $id = (int) $_GET['id'];

    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=base_test;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        $sql = "SELECT * FROM produits WHERE id_produit = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produit) {
            die("Produit introuvable");
        }

    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
?>

<div class="container py-5">

    <a href="index.php" class="btn btn-outline-light mb-4">
        Retour à la liste
    </a>

    <div class="card shadow-lg">
        <div class="card-body">

            <h1 class="card-title mb-3">
                <?= htmlspecialchars($produit['nom_produit']) ?>
            </h1>

            <p class="text-muted">
                Référence produit : #<?= htmlspecialchars($produit['id_produit']) ?>
            </p>

            <hr>

            <h5>Description</h5>
            <p class="mt-2">
                <?= nl2br(htmlspecialchars($produit['description_produit'])) ?>
            </p>

            <hr>

            <h4 class="text-success">
                Prix : <?= htmlspecialchars($produit['prix_produit']) ?> €
            </h4>
            <a href="editer_produit.php?id_produit=<?= $produit['id_produit'] ?>"
            class="btn btn-warning mt-3">
                Éditer le produit
            </a>
            <a href="supprimer_produit.php?id=<?= urlencode($produit['id_produit']) ?>"
            class="btn btn-danger mt-3">
                Supprimer
            </a>

        </div>
    </div>

</div>

</body>
</html>
