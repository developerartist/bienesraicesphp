<?php

    define('TEMPLATES_URL', __DIR__.'/templates');
    define('FUNCIONES_URL', __DIR__.'funciones.php');
    define('CARPETA_IMAGENES', dirname(__DIR__)."/imagenes/");
    function incluirTemplates( string $nombre, bool $inicio = false){
        include TEMPLATES_URL."/{$nombre}.php";
    }

    function estaAutenticado(): bool{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['login'])) {
        debuggear($_SESSION);
        header('Location: /', true, 302);
        exit; // importante
    }

    return true;
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

    function validarEntidad($entidad){
        $entidades = ["Propiedad", "Vendedor"];
        if(in_array($entidad, $entidades)){
            return true;
        }else{
            return false;
        }
        return false; 
    }
?>