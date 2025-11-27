<?php 

    require_once 'db_connexion.php';

    $error = "";
    $success = "";
    
    if (isset($_POST["email"], $_POST["password"], $_POST["retap-password"])) {
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $retapPassword = htmlspecialchars($_POST["retap-password"]);
        $defaultRole = 1; // Rôle par défaut pour un nouvel utilisateur

        if ($password !== $retapPassword) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "L'adresse email n'est pas valide.";
            }
            if (strlen($password) < 6) {
                $error = "Le mot de passe doit contenir au moins 6 caractères.";
            }

            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email_user = ?");
            $stmt->execute([$email]);
            $userExists = $stmt->fetchColumn();

            if ($userExists) {
                $error = "Cet email est déjà utilisé.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO users (email_user, password_user, role_user) VALUES (?, ?, ?)");
                try {
                    $stmt->execute(array(
                        $email, $hashedPassword, $defaultRole
                    ));
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                } catch (PDOException $e) {
                    $error = "Erreur lors de l'inscription : " . $e->getMessage();
                }
            }
        }
    } else {
        if(!empty($_POST)){
            $error = "Veuillez remplir tous les champs.";
        } else {
            $error = "";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <div>
                <label for="email">Email :</label>
                <input class="form-control mb-2" type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input class="form-control mb-2" type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="retap-password">Mot de passe :</label>
                <input class="form-control mb-2" type="password" id="retap-password" name="retap-password" required>
            </div>
            <?php if ($error ): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <div>
                <button class="btn btn-primary text-white" type="submit">S'inscrire</button>
                <button class="btn btn-secondary"><a class="text-white" href="index.php">Retour à l'accueil</a></button>
            </div>
        </form>
    </div>
</body>
</html>