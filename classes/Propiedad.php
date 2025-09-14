<?php
namespace App;

class Propiedad{

    protected static $db;
    protected static $columnasDB = ["id", "titulo", "precio","imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "vendedorId"];
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $vendedorId;

    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = []){
        
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? 0;
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardarPropiedad(){

        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO `bienesraices_crud`.`propiedades` (";
        $query .= implode(", ", array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= implode("', '", array_values($atributos));
        $query .= "');";
        $resultado = self::$db->query($query);  
        return $resultado;
    }
    public function arreglo(){
        $atributos = [];

        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->arreglo();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public static function getErrores(){
        return self::$errores;
    }

    
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio || $precio < 0){
            self::$errores[] = "El precio es obligatorio";
        }
        if(strlen($this->descripcion) < 50 ){
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }
        if($this->wc < 0 || $this->wc == '' ){
            self::$errores[] = "El numero de baños es obligatorio";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamiento es obligatorio";
        }
        if($this->vendedorId == '' || $this->vendedorId <= 0){
            self::$errores[] = "Elije un vendedor";
        }
        if($this->imagen == ''){
            self::$errores[] = "La imagen es obligatoria";
        }
        return self::$errores;
    }

    public function setImage($imagen){
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public static function all(){
        $query = "SELECT * FROM propiedades;";
        $resultado = self::consultarquery($query);
        return $resultado;
    }
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = $id;";
        $resultado = self::consultarquery($query);
        return array_shift( $resultado ) ;  
    }

    public static function consultarquery($query){
        $resultado = self::$db->query($query);
        $arr = [];
        while($r = $resultado->fetch_assoc()):
            $arr[] = self::crearobjeto($r);
        endwhile;
        $resultado->free();
        return $arr;
    }
    protected static function crearobjeto($r){
        $objeto = new self;
        foreach($r as $key => $value){
            if(property_exists($objeto, $key)):
                $objeto->$key = $value;                
            endif;
        }
        return $objeto;
    }
}
?>