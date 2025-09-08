<?php
namespace App;

class Propiedad{

    protected static $db;
    protected static $columnasDB = ["id", "titulo", "precio", "descripcion", "habitaciones", "wc", "estacionamiento", "vendedorId", "imagen"];
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $descripcion;
    public $habitaciones;
    public $baños;
    public $estacionamiento;
    public $vendedor;
    public $imagen;

    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = []){
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedorId = $args['vendedor'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
    }

    public function guardarPropiedad(){

        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO `bienesraices_crud`.`propiedades` (";
        $query .= implode(", ", array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= implode("', '", array_values($atributos));
        $query .= "');";
        $resultado = self::$db->query($query);       
        
        if($resultado){
            header('Location: /crear');
        } 
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
        if(!$this->precio || $precio === ''){
            self::$errores[] = "El precio es obligatorio";
        }
        if(strlen($this->descripcion) < 50 ){
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$this->baños){
            self::$errores[] = "El numero de baños es obligatorio";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamiento es obligatorio";
        }
        if($this->vendedor == ''){
            self::$errores[] = "Elije un vendedor";
        }
        return self::$errores;
    }
}
?>