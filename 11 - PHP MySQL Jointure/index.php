<?php 
    require_once __DIR__ . '/model/BaseExtraModel.php';
    
    $baseExtraModel = new BaseExtraModel("produits");
    $baseExtraData = $baseExtraModel->getAllRequest([
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
    ]);
    $baseExtraImageModel = new BaseExtraModel("produits_images");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/custom-styles.css">
    <title>Gestion des Produits</title>
</head>
<body>

<div class="container py-5">
    <div class="content-wrapper p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold text-primary">
                <i class="bi bi-bag-fill me-2"></i>Gestion des Produits
            </h1>
            <a href="ajouter_produit.php" class="btn btn-success btn-lg shadow">
                <i class="bi bi-plus-circle me-2"></i>Nouveau Produit
            </a>
        </div>

        <?php if(empty($baseExtraData)): ?>
        <div class="alert alert-info text-center py-5">
            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
            <h4>Aucun produit pour le moment</h4>
            <p class="mb-0">Commencez par ajouter votre premier produit !</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><i class="bi bi-hash me-1"></i>ID</th>
                        <th><i class="bi bi-tag me-1"></i>Nom</th>
                        <th><i class="bi bi-currency-euro me-1"></i>Prix</th>
                        <th><i class="bi bi-folder me-1"></i>Catégorie</th>
                        <th><i class="bi bi-upc me-1"></i>Référence</th>
                        <th><i class="bi bi-images me-1"></i>Images</th>
                        <th class="text-center"><i class="bi bi-gear me-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($baseExtraData as $data): ?>
                    <tr>
                        <td><strong>#<?= $data["id_produit"] ?></strong></td>
                        <td><?= $data["nom_produit"] ?></td>
                        <td><span class="badge bg-success fs-6"><?= number_format($data["prix_produit"], 2, ',', ' ') ?> €</span></td>
                        <td><span class="badge bg-secondary"><?= $data["categorie_nom"] ?></span></td>
                        <td><code><?= $data["reference_nom"] ?></code></td>
                        <td>
                            <span class="badge badge-images">
                                <i class="bi bi-image me-1"></i><?= $baseExtraImageModel->getCountById($data["id_produit"], "produits_id") ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="details_produit.php?id_produit=<?= $data["id_produit"] ?>" class="btn btn-info btn-sm me-1" title="Voir les détails">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="editer_produit.php?id_produit=<?= $data["id_produit"] ?>" class="btn btn-warning btn-sm me-1" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="supprimer_produit.php?id_produit=<?= $data["id_produit"] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
