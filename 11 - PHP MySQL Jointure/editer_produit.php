<?php
    require_once __DIR__ . '/model/BaseExtraModel.php';
    require_once __DIR__ . '/model/db/CategoriesModel.php';
    require_once __DIR__ . '/model/db/ProduitsModel.php';
    require_once __DIR__ . '/model/db/ReferenceModel.php';
    require_once __DIR__ . '/model/db/ImagesModel.php';
    require_once __DIR__ . '/model/db/ProduitsImagesModel.php';
    
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
    $categorieModel = new CategoriesModel();
    $categories = $categorieModel->getAll();

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

    if(isset($_GET["delete_image"])){
        $image_id_to_delete = (int)$_GET["delete_image"];

        $imageModel = new ImagesModel();
        $imageData = $imageModel->getById($image_id_to_delete, "image_id");

        if($imageData){
            $imageToDelete = new ImagesModel($imageData["image_id"], $imageData["images_nom"]);
            $imageToDelete->deleteImageFile();
            $imageToDelete->deleteFromDatabase($image_id_to_delete, "image_id");
        }

        header("Location: editer_produit.php?id_produit=".$id);
        exit;
    }

    if(isset($_POST["modifier"])){

        $name_products       = $_POST["nom_produit"];
        $description_products = $_POST["description_produit"];
        $price_products      = $_POST["prix_produit"];
        $id_categorie        = (int)$_POST["categorie_id"];
        $reference_products_name  = trim($_POST["reference_nom"]);

        $produit = new ProduitsModel(
            $id,
            $name_products,
            $description_products,
            $price_products,
            $id_categorie,
            $baseExtraData[0]["produit_reference"]
        );
        $produit->updateDatabase("id_produit");

        $reference = new ReferenceModel($baseExtraData[0]["reference_id"], $reference_products_name);
        $reference->updateDatabase("reference_id");

        if(isset($_FILES['nouvelles_images']) && !empty($_FILES['nouvelles_images']['name'][0])){
            $files = $_FILES['nouvelles_images'];

            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                    continue;
                }

                $tmpName = $files['tmp_name'][$i];
                $name = basename($files['name'][$i]);

                $targetDir = "assets/uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $targetPath = $targetDir . $name;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $image = new ImagesModel(null, $targetPath);
                    $image->insertIntoDatabase();

                    $id_image_insere = (int)$image->image_id;

                    $produit_image = new ProduitsImagesModel($id, $id_image_insere);
                    $produit_image->insertIntoDatabase();
                }
            }
        }

        header("Location: details_produit.php?id_produit=".$id);
        exit;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/custom-styles.css">
    <title>Modifier - <?= $baseExtraData[0]["nom_produit"] ?></title>
</head>
<body>

<div class="container py-5">
    <div class="content-wrapper p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-6 fw-bold text-primary">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Produit
            </h2>
            <a href="details_produit.php?id_produit=<?= $id ?>" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Annuler
            </a>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-tag-fill me-1"></i>Nom du produit</label>
                    <input class="form-control form-control-lg" name="nom_produit" value="<?= $baseExtraData[0]["nom_produit"] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-currency-euro me-1"></i>Prix</label>
                    <input type="number" step="0.01" class="form-control form-control-lg" name="prix_produit" value="<?= $baseExtraData[0]["prix_produit"] ?>" required>
                </div>

                <div class="col-12">
                    <label class="form-label"><i class="bi bi-text-paragraph me-1"></i>Description</label>
                    <textarea class="form-control" name="description_produit" rows="4"><?= $baseExtraData[0]["description_produit"] ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-folder-fill me-1"></i>Catégorie</label>
                    <select class="form-select form-select-lg" name="categorie_id" required>
                        <?php foreach($categories as $categorie): ?>
                            <option value="<?= $categorie["categorie_id"] ?>" <?= $categorie["categorie_id"] == $baseExtraData[0]["produit_categorie"] ? "selected" : "" ?>>
                                <?= $categorie["categorie_nom"] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-upc me-1"></i>Référence</label>
                    <input class="form-control form-control-lg" name="reference_nom" value="<?= $baseExtraData[0]["reference_nom"] ?>" required>
                </div>

                <?php if(!empty($imagesData)): ?>
                <div class="col-12">
                    <label class="form-label"><i class="bi bi-images me-1"></i>Images actuelles (<?= count($imagesData) ?>)</label>
                    <div class="row g-3">
                        <?php foreach($imagesData as $image): ?>
                        <div class="col-md-3 col-6">
                            <div class="image-preview-card">
                                <img src="<?= $image['images_nom'] ?>" class="img-fluid" alt="Image produit">
                                <a href="editer_produit.php?id_produit=<?= $id ?>&delete_image=<?= $image['image_id'] ?>"
                                   class="delete-overlay text-decoration-none"
                                   onclick="return confirm('Supprimer cette image ?')">
                                    <i class="bi bi-trash me-1"></i>Supprimer
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-12">
                    <label class="form-label"><i class="bi bi-plus-circle me-1"></i>Ajouter de nouvelles images</label>
                    <div class="upload-zone">
                        <i class="bi bi-cloud-upload fs-1 text-primary mb-2"></i>
                        <h5>Cliquez pour ajouter des images</h5>
                        <p class="text-muted mb-0">Vous pouvez sélectionner plusieurs images à la fois</p>
                        <input type="file" name="nouvelles_images[]" accept="image/*" multiple style="display: none;" onchange="previewImages(event)" id="fileInput">
                        <button type="button" class="btn btn-outline-primary mt-3" onclick="document.getElementById('fileInput').click()">
                            <i class="bi bi-plus-lg me-1"></i>Parcourir
                        </button>
                    </div>
                    <div id="preview" class="mt-3 row g-2"></div>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                        <a href="details_produit.php?id_produit=<?= $id ?>" class="btn btn-secondary btn-lg">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button class="btn btn-primary btn-lg" name="modifier">
                            <i class="bi bi-check-circle me-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/custom-script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
