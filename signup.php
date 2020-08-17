<?php
    /*Requerir la conecxión con la base de datos*/
    require 'database.php';
    

    $message = ''; 
    /* Agregar los datos para que se guarden en la base de datos*/

    /* Condicional de para que los 2 campos no esten vacios para agregarlos en la base de datos */
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        /* Datos que se quieren guardar en la base de datos */
        $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";

        /* Ejecutar la consulta de SQL */
        $stmt = $conn->prepare($sql);

        /* Vincular el email y el password */
        $stmt->bindParam(':email',$_POST['email']);

        /* Cifrado de password en la base de datos por metodo de password_hash */
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        /* Almacenar el password ya cifrado */
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = 'Se creo el usuario correctamente.';
        } else{
            $message = 'Lamentablemente no se pudo crear la cuenta.';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <?php require 'partials/font.php' ?>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

    <?php require 'partials/header.php' ?>
    
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>


    <h3>Registrarse</h3>
    <br/><br/><br/>
    <h4>¿Ya tienes una cuenta? <a href="login.php">INICIAR SESIÓN</a></h4>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your mail">
        <input type="password" name="password" placeholder="Enter your Password">
        <input type="password" name="confirm_password" placeholder="Confirm your Password">
        <input type="submit" value="REGISTRARSE">
    </form>
    
</body>
</html>