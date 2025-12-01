<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Bienvenue sur la page d'accueil</h1>
    <?php if (isset($_SESSION["user_email"])): ?>
        <p>Connecté en tant que : <?= htmlspecialchars($_SESSION["user_email"]) ?></p> 
        <?php if ($_SESSION["user_role"] == 1): ?>
            <button class="btn btn-info"><a href="dashboard.php">Tableau de bord</a></button>
        <?php endif; ?>
        <a class="btn btn-danger text-white" href="deconnexion.php" role="button">Se déconnecter</a>
    <?php else: ?>
        <button class="btn btn-primary"><a class="text-white" href="connexion.php">Se connecter</a></button>
        <button class="btn btn-secondary"><a class="text-white" href="inscriptions.php">S'inscrire</a></button>
    <?php endif; ?>
</body>
</html>