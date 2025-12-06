<?php
    require __DIR__ . '/model/db/ProduitsModel.php';
    require __DIR__ . '/model/db/ReferenceModel.php';
    require __DIR__ . '/model/db/ImagesModel.php';
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
        var_dump($baseExtraData);
        $produitModel = new ProduitsModel();
        $produitModel->id_produit = (int)$baseExtraData[0]["id_produit"];

        $referenceModel = new ReferenceModel();
        $referenceModel->reference_id = (int)$baseExtraData[0]["reference_id"];

        if(!$produitModel) {
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

        foreach($imagesData as $imageData) {
            $imageModel = new ImagesModel($imageData["image_id"], $imageData["images_nom"]);
            $imageModel->deleteImageFile();
        }

        $referenceModel->deleteFromDatabase($referenceModel->reference_id,"reference_id");
        $produitModel->deleteFromDatabase($produitModel->id_produit,"id_produit");
        header("Location: index.php");