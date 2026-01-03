<?php
    namespace App;

    class Vendedor extends ActiveRecord{
        protected static $tabla = 'vendedores';
        protected static $columnasDB = ["id", "nombre", "apellido", "telefono", "correo_electronico"];

        public $id;
        public $nombre;
        public $apellido;
        public $telefono;
        public $correo_electronico;

        public function __construct($args = []){
        
            $this->id = $args['id'] ?? NULL;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? 0;
            $this->telefono = $args['telefono'] ?? '';
            $this->correo_electronico = $args['correo_electronico'] ?? '';
        }

        public function validar(){
            if(!$this->nombre){
                self::$errores[] = "Nombre Obligatorio del Vendedor";
            }
            if(!$this->apellido){
                self::$errores[] = "El Apellido del Vendedor es obligatorio";
            }
            if(!$this->correo_electronico || !filter_var($this->correo_electronico, FILTER_VALIDATE_EMAIL)){
                self::$errores[] = "El Correo Electronico del Vendedor es obligatorio";
            }
            if(!$this->telefono || !preg_match('/[0-9]{10}/', $this->telefono) || strlen($this->telefono) !== 10){
                self::$errores[] = "Número telefonico no válido";
            }
            
            return self::$errores;
        }
    }
?>