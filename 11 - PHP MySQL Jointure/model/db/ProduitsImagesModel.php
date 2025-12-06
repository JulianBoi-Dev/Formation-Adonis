<?php
require_once __DIR__ . '/../BaseModel.php';

class ProduitsImagesModel extends BaseModel {

    public ?int $produits_id;
    public ?int $image_id;
    
    public function __construct(?int $produits_id = null, ?int $image_id = null) {
        parent::__construct();
        $this->tableName = "produits_images";
        $this->produits_id = $produits_id;
        $this->image_id = $image_id;
    }

    public function getProduits_id(): ?int {
        return $this->produits_id;
    }

    public function setProduits_id(?int $produits_id): void {
        $this->produits_id = $produits_id;
    }

    public function getImage_id(): ?int {
        return $this->image_id;
    }

    public function setImage_id(?int $image_id): void {
        $this->image_id = $image_id;
    }
}