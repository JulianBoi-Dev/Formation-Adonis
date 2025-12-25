<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/darkly/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body>

<div class="container py-5">

    <h1 class="mb-4">Ajouter un produit</h1>

    <form method="post" action="index.php">

        <div class="mb-3">
            <label class="form-label">Nom du produit</label>
            <input type="text" name="nom_produit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description_produit" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (€)</label>
            <input type="number" step="0.01" name="prix_produit" class="form-control" required>
        </div>

        <button type="submit" name="btn_ajouter" class="btn btn-primary">
            Ajouter
        </button>

        <a href="index.php" class="btn btn-outline-light ms-2">
            Annuler
        </a>

    </form>

</div>

</body>
</html>
