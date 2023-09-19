<?php
require_once('BaseDatos.class.php');
require_once('peliculas.class.php');
require_once('categorias.class.php');
session_start();
class cestaCompra{

    protected $arrPeliculas;



    public  function __construct()
    {
        $this->arrPeliculas=array();
    }

   public function nuevaPelicula($codigo){
    $pelicula = BaseDatos::getInstancia()->ObtenerPeliculas($codigo);
    array_push($this->arrPeliculas,$pelicula);

    
   }

   public function getPeliculas(){

    return $this->arrPeliculas;

   }

   public function getCoste(){
    $total=0;
    foreach ($this->arrPeliculas as $pelicula) {
        $total+=$pelicula->getPrecio();
    }
    return $total;
   }

   public function estaVacia(){
    $vacia=false;
    if (count($this->arrPeliculas) == 0) {
        $vacia=true;
    }
    return $vacia;
   }

   public  function guardaCesta(){

   $_SESSION['cesta']=$this;

   }

   public static function cargaCesta(){

    if (!isset($_SESSION['cesta'])) {
        return  new cestaCompra();
        
    }else{
       return $_SESSION['cesta'];
    }
    

   }

   public function muestraCesta(){
    if ($this->estaVacia()) {
        echo"Cesta vacia";
    }else{
        echo count($this->arrPeliculas)." peliculas ";
        echo "coste total ".$this->getCoste()." €.";
    }
   }

}

?>