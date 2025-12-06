<?php
require_once __DIR__ . '/../BaseModel.php';

class ReferenceModel extends BaseModel {

    public ?int $reference_id;
    public string $reference_nom;


    public function __construct($id = 0, string $nom = "") {
        parent::__construct();

        $this->tableName = "produit_references";

        $this->reference_id  = $id ? (int)$id : null;
        $this->reference_nom = htmlspecialchars($nom);
    }

    public function getReference_id(): ?int {
        return $this->reference_id;
    }

    public function setReference_id(?int $reference_id): void {
        $this->reference_id = $reference_id;
    }

    public function getReference_nom(): string {
        return $this->reference_nom;
    }

    public function setReference_nom(string $reference_nom): void {
        $this->reference_nom = htmlspecialchars($reference_nom);
    }
}
