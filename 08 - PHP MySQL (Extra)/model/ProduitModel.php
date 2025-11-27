<?php
require 'PDOModel.php';

class Produits extends PDOModel{
    private $id_produit;
    private $nom;
    private $description;
    private $prix;

    public function __construct($id_produit = 0, $nom = "", $description = "", $prix = 0) {
        parent::__construct();
        $this->id_produit = htmlspecialchars($id_produit);
        $this->nom = htmlspecialchars($nom) ;
        $this->description = htmlspecialchars($description);
        $this->prix = htmlspecialchars($prix);
    } 

    
    function getAll() {
        $connect = new PDOModel();
        $req = $connect->pdo->prepare("SELECT * FROM produits");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $req = $this->pdo->prepare("SELECT * FROM produits WHERE id_produit = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    public function add() {
        $req = $this->pdo->prepare("INSERT INTO produits(nom_produit, description_produit, prix_produit) VALUES (?, ?, ?)");
        $req->execute([$this->nom, $this->description, $this->prix]);
    }
    public function update($id) {
        $req = $this->pdo->prepare("UPDATE produits SET nom_produit = ?, description_produit = ?, prix_produit = ? WHERE id_produit = ?");
        $req->execute([$this->nom, $this->description, $this->prix, $id]);
    }

    public function delete($id) {
        $req = $this->pdo->prepare("DELETE FROM produits WHERE id_produit = ?");
        $req->execute([$id]);
    }
    

    public function __toString() {
        return "Produit: " . $this->nom . ", Description: " . $this->description . ", Prix: " . $this->prix;
    }

    public function getIdProduit() {
        return $this->id_produit;
    }

    public function setIdProduit($id_produit) {
        $this->id_produit = $id_produit;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }
}