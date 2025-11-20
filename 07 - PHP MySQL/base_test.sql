/* ----------------------------------------------------------
   CREATION DE LA BASE DE DONNEES
   ----------------------------------------------------------
   - On crée une base nommée "base_test"
   - Le charset utf8mb4 permet les emojis et caractères spéciaux
----------------------------------------------------------- */

CREATE DATABASE IF NOT EXISTS base_test
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

/* ----------------------------------------------------------
   ON SE CONNECTE A LA BASE DE DONNEES
----------------------------------------------------------- */

USE base_test;

/* ----------------------------------------------------------
   CREATION DE LA TABLE "produits"
   ----------------------------------------------------------
   Champs :
   - id_produit          : identifiant 
   - nom_produit         : nom du produit
   - description_produit : description 
   - prix_produit        : prix 
   ----------------------------------------------------------
----------------------------------------------------------- */

CREATE TABLE IF NOT EXISTS produits (
    id_produit INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Identifiant 
    nom_produit VARCHAR(255) NOT NULL,                   -- Nom du produit
    description_produit TEXT,                             -- Description 
    prix_produit DECIMAL(10,2) NOT NULL DEFAULT 0.00     -- Prix
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* ----------------------------------------------------------
   INSERTION DE DONNEES DE TEST pour avoir des données
----------------------------------------------------------- */

INSERT INTO produits (nom_produit, description_produit, prix_produit) VALUES
('Produit 1', 'Exemple de produit 1', 10.50),
('Produit 2', 'Exemple de produit 2', 25.90),
('Produit 3', 'Exemple de produit 3', 7.30);

/* ----------------------------------------------------------
   FIN DU FICHIER
----------------------------------------------------------- */
