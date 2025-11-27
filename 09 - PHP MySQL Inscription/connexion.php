<?php 

session_start();

require 'db_connexion.php';

$error = "";


if (isset($_POST["email"], $_POST["password"])) {
    $email = trim(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email_user = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password_user"])) {
        $_SESSION["user_id"] = $user["id_user"];
        $_SESSION["user_email"] = $user["email_user"];
        $_SESSION["user_role"] = $user["role_user"];
        if($user["role_user"] == 1){
            header("Location: dashboard.php");
        } else {
            header("Location: index.php");
        }
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
} else {
    if(!empty($_POST)){
         $error = "Veuillez remplir tous les champs.";
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <div>
                <label for="email">Email :</label>
                <input class="form-control mb-2" type="email" id="email" name="email">
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input class="form-control mb-2" type="password" id="password" name="password">
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if (isset($_GET["success"])): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <div>
                <button class="btn btn-primary text-white" type="submit">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>