<?php
require_once __DIR__ . '/model/db/ProduitsModel.php';
require_once __DIR__ . '/model/db/CategoriesModel.php';
require_once __DIR__ . '/model/db/ReferenceModel.php';
require_once __DIR__ . '/model/db/ImagesModel.php';
require_once __DIR__ . '/model/db/ProduitsImagesModel.php';

if(isset($_POST["ajouter"])){
    $name_products       = $_POST["nom_produit"];
    $description_products = $_POST["description_produit"];
    $price_products      = $_POST["prix_produit"];
    $id_categorie        = (int)$_POST["id_categorie"];
    $reference_products  = trim($_POST["reference_produit"]);
    
    if (!isset($_FILES['photo_produit'])) {
        die("Aucun fichier reçu.");
    }
    $files = $_FILES['photo_produit'];
    $produit = new ProduitsModel(
        null,
        $name_products,
        $description_products,
        $price_products,
        $id_categorie,
        0
    );

    $reference = new ReferenceModel(null, $reference_products);
    $getReferenceName = $reference->getByField("reference_nom", $reference_products);

    if(empty($getReferenceName)){
        $reference->insertIntoDatabase();
        $getReferenceName = $reference->getByField("reference_nom",$reference_products);
    }

    $produit->produit_reference = (int)$getReferenceName[0]["reference_id"];
    $produit->insertIntoDatabase();

    $id_produit_insere = (int)$produit->id_produit;

    for ($i = 0; $i < count($files['name']); $i++) {

        if ($files['error'][$i] !== UPLOAD_ERR_OK) {
            echo "Erreur sur le fichier : " . $files['name'][$i] . "<br>";
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
            echo "Image enregistrée : " . $targetPath . "<br>";

            $image = new ImagesModel(null, $targetPath);
            $image->insertIntoDatabase();

            $id_image_insere = (int)$image->image_id;

            $produit_image = new ProduitsImagesModel($id_produit_insere, $id_image_insere);
            $produit_image->insertIntoDatabase();

        } else {
            echo "Erreur enregistrement : " . $name . "<br>";
        }
    }
    header("Location: index.php");
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
    <title>Ajouter un Produit</title>
</head>
<body>

<div class="container py-5">
    <div class="content-wrapper p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-6 fw-bold text-primary">
                <i class="bi bi-plus-circle-fill me-2"></i>Ajouter un Produit
            </h2>
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Retour
            </a>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-tag-fill me-1"></i>Nom du produit</label>
                    <input class="form-control form-control-lg" name="nom_produit" placeholder="Ex: iPhone 15 Pro" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-currency-euro me-1"></i>Prix</label>
                    <input type="number" step="0.01" class="form-control form-control-lg" name="prix_produit" placeholder="0.00" required>
                </div>

                <div class="col-12">
                    <label class="form-label"><i class="bi bi-text-paragraph me-1"></i>Description</label>
                    <textarea class="form-control" name="description_produit" rows="4" placeholder="Décrivez votre produit..."></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-folder-fill me-1"></i>Catégorie</label>
                    <select class="form-select form-select-lg" name="id_categorie" required>
                        <option value="">Sélectionner une catégorie</option>
                        <?php
                            $categorieModel = new CategoriesModel();
                            $categories = $categorieModel->getAll();
                            foreach($categories as $categorie){
                                echo '<option value="'.$categorie["categorie_id"].'">'.$categorie["categorie_nom"].'</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-upc me-1"></i>Référence</label>
                    <input class="form-control form-control-lg" name="reference_produit" placeholder="Ex: REF-2024-001" required>
                </div>

                <div class="col-12">
                    <label class="form-label"><i class="bi bi-images me-1"></i>Images du produit</label>
                    <div class="upload-zone">
                        <i class="bi bi-cloud-upload fs-1 text-primary mb-2"></i>
                        <h5>Cliquez pour sélectionner des images</h5>
                        <p class="text-muted mb-0">Vous pouvez sélectionner plusieurs images à la fois</p>
                        <input type="file" name="photo_produit[]" accept="image/*" multiple style="display: none;" onchange="previewImages(event)" id="fileInput">
                        <button type="button" class="btn btn-outline-primary mt-3" onclick="document.getElementById('fileInput').click()">
                            <i class="bi bi-plus-lg me-1"></i>Parcourir
                        </button>
                    </div>
                    <div id="preview" class="mt-3 row g-2"></div>
                </div>

                <div class="col-12 mt-4">
                    <button class="btn btn-success btn-lg w-100" name="ajouter">
                        <i class="bi bi-check-circle me-2"></i>Ajouter le Produit
                    </button>
                </div>

                <?php
                    if(isset($erreur)){
                        echo '<div class="col-12"><div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>'.$erreur.'</div></div>';
                    }
                ?>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/custom-script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
