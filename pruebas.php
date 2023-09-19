<?php
require_once('clases/BaseDatos.class.php');
/*
$categorias = BaseDatos::getInstancia()->getCategorias();
$categorias2 = BaseDatos::getInstancia()->getCategorias(10);
$peliculas = BaseDatos::getInstancia()->getPeliculas();
echo"CATEGORIAS";
foreach ($categorias as $key ) {
  echo $key->getId()."<br>";
}
echo"CATEGORIAS CON ID PARAMETRO";
echo $categorias2."<br>";
echo "Productos";

foreach ($peliculas as $pelicula) {
   echo $pelicula->getNombre();
}
*/
$categorias3 = BaseDatos::getInstancia()->ObtenerPeliculas(1);
echo $categorias3->getNombre();