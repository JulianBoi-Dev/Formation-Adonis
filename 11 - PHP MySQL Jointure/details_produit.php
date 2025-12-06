<?php 
    require_once __DIR__ . '/model/BaseExtraModel.php';
    $id = htmlspecialchars($_GET["id_produit"]);    

    $baseExtraModel = new BaseExtraModel("produits");
    $baseExtraData = $baseExtraModel->getAllRequestById([
        [
            'table'     => 'categories',
            'foreign'   => 'produit_categorie',
            'reference' => 'categorie_id'
        ],
        [
            'table'     => 'produit_references',
            'foreign'   => 'produit_reference',
            'reference' => 'reference_id'
        ]
    ],"id_produit",$id);
    if(!$baseExtraData[0]) {
        header("Location: index.php");
    }

    $baseExtraImageModel = new BaseExtraModel("produits_images");
    $imagesData = $baseExtraImageModel->getAllRequestById([
        [
            'table'     => 'images',
            'foreign'   => 'image_id',
            'reference' => 'image_id'
        ]
    ],"produits_id",$id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/custom-styles.css">
    <title>Détails - <?= $baseExtraData[0]["nom_produit"] ?></title>
</head>
<body>

<div class="container py-5">
    <div class="content-wrapper p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-6 fw-bold text-primary">
                <i class="bi bi-eye-fill me-2"></i>Détails du Produit
            </h2>
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Retour à la liste
            </a>
        </div>

        <div class="card product-card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="display-5 mb-3"><?= $baseExtraData[0]["nom_produit"] ?></h1>

                        <div class="mb-4">
                            <span class="badge bg-success fs-4 me-2">
                                <i class="bi bi-currency-euro me-1"></i><?= number_format($baseExtraData[0]["prix_produit"], 2, ',', ' ') ?> €
                            </span>
                            <span class="badge bg-secondary fs-6">
                                <i class="bi bi-folder me-1"></i><?= $baseExtraData[0]["categorie_nom"] ?>
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-muted mb-2"><i class="bi bi-text-paragraph me-2"></i>Description</h5>
                            <p class="lead"><?= $baseExtraData[0]["description_produit"] ?: "Aucune description disponible" ?></p>
                        </div>

                        <div class="mb-3">
                            <h5 class="text-muted mb-2"><i class="bi bi-info-circle me-2"></i>Informations</h5>
                            <div>
                                <span class="info-badge">
                                    <i class="bi bi-upc me-1"></i>Référence: <strong><?= $baseExtraData[0]["reference_nom"] ?></strong>
                                </span>
                                <span class="info-badge">
                                    <i class="bi bi-images me-1"></i>Images: <strong><?= count($imagesData) ?></strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($imagesData)): ?>
                    <div class="col-md-4">
                        <img id="mainImage" src="<?= $imagesData[0]['images_nom'] ?>" class="img-fluid rounded shadow" alt="<?= $baseExtraData[0]["nom_produit"] ?>">
                    </div>
                    <?php endif; ?>
                </div>

                <?php if(!empty($imagesData)): ?>
                <div class="mt-4">
                    <h5 class="text-muted mb-3"><i class="bi bi-images me-2"></i>Galerie d'images (<?= count($imagesData) ?>)</h5>
                    <div class="row g-3">
                        <?php foreach($imagesData as $image): ?>
                        <div class="col-md-3 col-6">
                            <img src="<?= htmlspecialchars($image['images_nom']) ?>"
                                 class="img-fluid gallery-img shadow-sm"
                                 alt="Image produit"
                                 data-image-src="<?= htmlspecialchars($image['images_nom']) ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <hr class="my-4">

                <div class="d-flex gap-2 flex-wrap">
                    <a href="editer_produit.php?id_produit=<?= $baseExtraData[0]["id_produit"] ?>" class="btn btn-warning btn-lg">
                        <i class="bi bi-pencil me-2"></i>Modifier
                    </a>
                    <a href="supprimer_produit.php?id_produit=<?= $baseExtraData[0]["id_produit"] ?>"
                       class="btn btn-danger btn-lg"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        <i class="bi bi-trash me-2"></i>Supprimer
                    </a>
                    <a href="index.php" class="btn btn-secondary btn-lg">
                        <i class="bi bi-house me-2"></i>Accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/custom-script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
