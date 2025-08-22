<?php 
    include 'includes/app.php';
    $db = conectarDB();

    $email = 'correo@correo.com';
    $password = '123456';
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO `bienesraices_crud`.`usuarios` (`email`,`password`)VALUES('{$email}', '{$passwordHash}');";
    $resultado = mysqli_query($db, $query);
    if($resultado){
        echo "Insercion Exitosa"; 
    }else{
        echo "Error en la consulta";
    }
?>