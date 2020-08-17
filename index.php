<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, password FROM user WHERE id=:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguridad Informática</title>
    <?php require 'partials/font.php' ?>
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>

    <?php require 'partials/header.php' ?>

    <h1>Por Favor Inicie Sesión o Registrate</h1>
    <h2 class="sentence">Podras ver
       <div class="slidingHorizontal">
         <span>Seguridad Informática.</span>
         <span>Pruebas de Intrusión.</span>
         <span>Análisis de Vulnerabilidades.</span>
         <span>Analisis de Seguridad Perimetral.</span>
       </div>
     </h2>

     <?php if(!empty($user)): ?>
        <br>Welcome. <?= $user['email'] ?>
        <br>You are Succesfully Logged In
        <a href="logout.php">Cerrar Sesión</a>
    <?php else: ?>

        <a id="login"href="login.php">INGRESAR</a>
      <a id="signup"href="signup.php">REGISTRARSE</a>
    <?php endif; ?>
</body>
</html>