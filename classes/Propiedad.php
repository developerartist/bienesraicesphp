<?php
namespace App;

class Propiedad{
    public $id;
    public $titulo;
    public $precio;
    public $descripcion;
    public $habitaciones;
    public $baños;
    public $estacionamiento;
    public $vendedor;
    public $imagen;

    public function __construct(){
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->baños = $args['baños'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedor = $args['vendedor'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }
}
?>