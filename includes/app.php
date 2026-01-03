<?php 

require 'funciones.php';
require __DIR__.'/templates/config/database.php';
#'../templates/config/database.php';
#require en windows
require __DIR__.'/../vendor/autoload.php';
#require '../../classes/Propiedad.php';
//conectar a la base de datos
$db = conectarDB();
use App\ActiveRecord;
ActiveRecord::setDB($db);

?>