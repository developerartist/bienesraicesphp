<?php

    namespace App;
    
    class ActiveRecord{
        
        protected static $db;
        protected static $errores = [];
        protected static $columnasDB = [];
        protected static $tabla = '';
        

        public static function setDB($database){
            self::$db = $database;
        }

        public function validar(){
            static::$errores;
            return static::$errores;
        }

        public function guardar(){
            if(!is_null($this->id)){
                $this->actualizar();
            }else{
                $this->crear();
            }
        }
        public function crear(){
            $atributos = $this->sanitizarAtributos();
            $query = "INSERT INTO `bienesraices_crud`.`".static::$tabla."` (";
            $query .= implode(", ", array_keys($atributos));
            $query .= ") VALUES ('";
            $query .= implode("', '", array_values($atributos));
            $query .= "');";
            $resultado = self::$db->query($query); 
            
            if($resultado){
                header('Location: /admin?resultado=1');
            }
        }

        public function actualizar(){
            $atributos = $this->sanitizarAtributos();
            $valores = [];

            foreach($atributos AS $key => $value){
                $valores[] = "{$key}='{$value}'";
            }

            $query = "UPDATE ".static::$tabla." SET ";
            $query .= join(', ',  $valores);
            $query .= " WHERE id = '" .self::$db->escape_string($this->id). "' LIMIT 1;";
            $resultado = self::$db->query($query);
            if($resultado){
                header('Location: /admin?resultado=2');
            }
            return $resultado;

        }
        //Eliminar un registro
        public function eliminar(){
            $query = "DELETE FROM ".static::$tabla." WHERE id = ". self::$db->escape_string($this->id). " LIMIT 1;";
            $resultado = self::$db->query($query);
            if($resultado){
                $this->borrarImagen();
                header('Location: /admin?resultado=3');
            }
        }

        public function borrarImagen(){
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES .$this->imagen);
            }
        }
        public function arreglo(){
            $atributos = [];

            foreach(static::$columnasDB as $columna){
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
            return static::$errores;
        }

        public function setImage($imagen){
            if(!is_null($this-> id)){
                $this->borrarImagen();
            }
            if($imagen){
                $this->imagen = $imagen;
            }
        }

        public static function all(){
            $query = "SELECT * FROM ".static::$tabla.";";
            $resultado = self::consultarquery($query);
            return $resultado;
        }

        public static function find($id){
            $query = "SELECT * FROM ".static::$tabla." WHERE id = $id;";
            $resultado = self::consultarquery($query);
            return array_shift( $resultado ) ;  
        }

        public static function consultarquery($query){
            $resultado = self::$db->query($query);
            $arr = [];
            while($r = $resultado->fetch_assoc()):
                $arr[] = static::crearobjeto($r);
            endwhile;
            $resultado->free();
            return $arr;
        }
        protected static function crearobjeto($r){
            $objeto = new static;
            foreach($r as $key => $value){
                if(property_exists($objeto, $key)):
                    $objeto->$key = $value;                
                endif;
            }
            return $objeto;
        }

        //metodo sincronizar con los cambios realizados
        public function sincronizar($args = []){
            foreach($args as $key=>$value){
                if(property_exists($this, $key) && !is_null($value)){
                    $this->$key = $value;
                }
            }
        }
    }
?>