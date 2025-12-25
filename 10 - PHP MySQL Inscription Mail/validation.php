<?php
    require_once 'db_connexion.php';

    $error = "";
    $success = "";

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['is_active']) {
                $error = "Votre compte est déjà activé.";
            } else {
                // Activer le compte utilisateur
                $stmt = $pdo->prepare("UPDATE users SET is_active = 1 WHERE id_user = :id_user");
                $stmt->execute(['id_user' => $userId]);
                $success = "Votre compte a été activé avec succès ! Vous pouvez maintenant vous connecter.";
            }
        } else {
            $error = "Lien d'activation invalide.";
        }
    } else {
        $error = "Lien d'activation invalide.";
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validation mail</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
        </div>
    </body>
    </html>
