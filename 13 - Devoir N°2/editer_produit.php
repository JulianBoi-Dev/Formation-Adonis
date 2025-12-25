<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Éditer un produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/darkly/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body>

<?php
if (!isset($_GET['id_produit']) || !ctype_digit($_GET['id_produit'])) {
    die("Produit invalide");
}

$id_produit = (int) $_GET['id_produit'];

try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=base_test;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $sqlSelect = "SELECT * FROM produits WHERE id_produit = :id";
    $stmtSelect = $bdd->prepare($sqlSelect);
    $stmtSelect->bindParam(':id', $id_produit, PDO::PARAM_INT);
    $stmtSelect->execute();

    $produit = $stmtSelect->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        die("Produit introuvable");
    }

    if (isset($_POST['btn_modifier'])) {

        $nom = $_POST['nom_produit'];
        $description = $_POST['description_produit'];
        $prix = $_POST['prix_produit'];

        $sqlUpdate = "UPDATE produits 
                      SET nom_produit = ?, 
                          description_produit = ?, 
                          prix_produit = ?
                      WHERE id_produit = ?";

        $stmtUpdate = $bdd->prepare($sqlUpdate);

        $stmtUpdate->bindParam(1, $nom, PDO::PARAM_STR);
        $stmtUpdate->bindParam(2, $description, PDO::PARAM_STR);
        $stmtUpdate->bindParam(3, $prix);
        $stmtUpdate->bindParam(4, $id_produit, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            header("Location: details_produit.php?id=$id_produit");
            exit;
        } else {
            echo "<script>alert('Erreur lors de la modification');</script>";
        }
    }

} catch (PDOException $e) {
    echo "<script>alert('Erreur SQL : " . addslashes($e->getMessage()) . "');</script>";
}
?>

<div class="container py-5">

    <h1 class="mb-4">Éditer le produit</h1>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Nom du produit</label>
            <input type="text"
                   name="nom_produit"
                   class="form-control"
                   value="<?= htmlspecialchars($produit['nom_produit']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description_produit"
                      class="form-control"
                      rows="4"
                      required><?= htmlspecialchars($produit['description_produit']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (€)</label>
            <input type="number"
                   step="0.01"
                   name="prix_produit"
                   class="form-control"
                   value="<?= htmlspecialchars($produit['prix_produit']) ?>"
                   required>
        </div>

        <button type="submit" name="btn_modifier" class="btn btn-warning">
            Enregistrer les modifications
        </button>

        <a href="details_produit.php?id=<?= $id_produit ?>" 
           class="btn btn-outline-light ms-2">
            Annuler
        </a>

    </form>

</div>

</body>
</html>
