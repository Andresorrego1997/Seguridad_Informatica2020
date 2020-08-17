<?php 

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /php');
    }

    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM user WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /php');
        } else {
            $message = 'Su email o contraseña son incorrectos';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php require 'partials/header.php' ?>
    
    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>

    <?php endif;?>

    <h3>Iniciar Sesión</h3>
    <br/><br/><br/>
    <h4>¿Aún no te has registrado? <a href="signup.php">REGISTRATE</a></h4>

    

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your mail">
        <input type="password" name="password" placeholder="Enter your Password">
        <input type="submit" value="INICIAR">
    </form>
</body>
</html>