<?php
require_once('categorias.class.php');
 class Peliculas{

    protected $codigo,$precio,$nombre,$descripcion;
    protected categorias $categoria;
    public function __construct($codigo,$precio,$nombre,$descripcion, categorias $categoria){

        $this->codigo=$codigo;
        $this->precio=$precio;
        $this->nombre=$nombre;
        $this->categoria=$categoria;
        $this->descripcion=$descripcion;
        
    }

    public function getCodigo(){

        return $this->codigo;

    }

    public function getPrecio(){

        return $this->precio;

    }

    public function getNombre(){

        return $this->nombre;

    }

    public function getCategoria(){

        return $this->categoria->getNombre();

    }

    public function getDescripcion(){

        return $this->descripcion;

    }

    public function setCodigo($codigo){

        $this->codigo = $codigo;

    }

    public function setPrecio($precio){

        $this->precio = $precio;

    }

    public function setNombre($nombre){

        $this->nombre = $nombre;

    }

    public function setCategoria($categoria){

        $this->categoria = $categoria;

    }

    public function setDescripcion($descripcion){

        $this->descripcion = $descripcion;

    }

    public function __toString(){

        return "Nombre: ".$this->nombre.". Precio: ".$this->precio.". Codigo: ".$this->codigo.". Categoria: ".$this->categoria.". Descripcion: ".$this->descripcion.".";

    }

}

?>