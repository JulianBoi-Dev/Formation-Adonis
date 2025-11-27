<?php   
session_start();
if (!isset($_SESSION["user_email"]) || $_SESSION["user_role"] != 1) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">  
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur le tableau de bord administrateur</h1>
        <p>Seul les utilisateur peuvent voir cette page.</p>
        <button class="btn btn-primary"><a class="text-white" href="index.php">Retour à l'accueil</a></button>
        <button class="btn btn-danger"><a class="text-white" href="deconnexion.php">Se déconnecter</a></button>
        
    </div>
</body>