<?php

    define('TEMPLATES_URL', __DIR__.'/templates');
    define('FUNCIONES_URL', __DIR__.'funciones.php');
    define('CARPETA_IMAGENES', dirname(__DIR__)."/imagenes/");
    function incluirTemplates( string $nombre, bool $inicio = false){
        include TEMPLATES_URL."/{$nombre}.php";
    }

    function estaAutenticado() : bool{
        session_start();
        if(!$_SESSION['login']){
            //echo "Sesion no iniciada";
            header('Location: /');
            return false;
        }else{
            return true;
        }
        
    }

    function debuggear($variable){
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }

    function sA($html){
        $s = htmlspecialchars($html);
        return $s;
    }
?>