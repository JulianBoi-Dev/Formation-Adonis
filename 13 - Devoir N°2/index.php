<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/darkly/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body>

<?php
// 
try {
    $user = "root";
    $pass = "";
    $bdd = new PDO(
        'mysql:host=localhost;dbname=base_test;charset=utf8',
        $user,
        $pass,
        [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $sql = "SELECT * FROM produits";
    $stmt = $bdd->query($sql);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
if (isset($_POST['btn_ajouter'])) {

    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=base_test;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        $nom = $_POST['nom_produit'];
        $description = $_POST['description_produit'];
        $prix = $_POST['prix_produit'];

        $sql = "INSERT INTO produits 
                (nom_produit, description_produit, prix_produit)
                VALUES (:nom, :description, :prix)";

        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit;
        } else {
            echo "<script>alert('Erreur lors de l’ajout du produit');</script>";
        }

    } catch (PDOException $e) {
        echo "<script>alert('Erreur SQL : " . addslashes($e->getMessage()) . "');</script>";
    }
}

?>

<div class="container py-5">

    <h1 class="text-center mb-5">Liste des produits</h1>

    <a href="ajouter_produit.php" class="btn btn-success mb-4">
    Ajouter un produit
    </a>


    <div class="row g-4">
        <?php foreach ($produits as $produit): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title">
                            <?= htmlspecialchars($produit['nom_produit']) ?>
                        </h5>

                        <p class="card-text text-muted small mb-2">
                            ID : <?= htmlspecialchars($produit['id_produit']) ?>
                        </p>

                        <p class="card-text flex-grow-1">
                            <?= nl2br(htmlspecialchars($produit['description_produit'])) ?>
                        </p>

                        <div class="mt-3">
                            <span class="badge bg-success fs-6">
                                <?= htmlspecialchars($produit['prix_produit']) ?> €
                            </span>
                        </div>
                        <a href="details_produit.php?id=<?= urlencode($produit['id_produit']) ?>" class="btn btn-primary btn-sm mt-3">
                                Voir le détail
                        </a>

                    </div>


                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
