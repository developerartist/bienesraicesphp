<?php 
    function conectarDB() : mysqli{
        $db = mysqli_connect('localhost', 'root', 'root', 'bienesraices_crud');
        if(!$db){
            echo('Error al conectar a la base de datos');
        }
        return $db;
    }
?>