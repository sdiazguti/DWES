<?php
require_once('clases/BaseDatos.class.php');
if (!isset($_SESSION['usuario'])) {
    header('Location: '.'inicioSesion.php');
}
if (isset($_SESSION['usuario'])) {
    echo"<form action='' method='post'><a href='cerrarSesion.php' type='button' >Desconectar</a></form>";
}
$cesta = cestaCompra::cargaCesta();
$peliculas = BaseDatos::getInstancia()->getPeliculas();
$imagenes = array('PulpFiction'=>'imagenes/pulpFiction.jpg','elPadrino'=>'imagenes/elPadrino.jpg','laVidaEsBella'=>'imagenes/LaVidaEsBella.jpg','elClubDeLaLucha'=>'imagenes/ElClubDeLaLucha.jpg','cadenaPerpetua'=>'imagenes/CadenaPerpetua.jpg','laListaDeSchindler'=>'imagenes/schindlerList.jpg','saw'=>'imagenes/Saw.jpg','ReservoirDogs'=>'imagenes/reservoirDogs.jpg','elSeñorDeLosAnillos:ElRetornoDelRey'=>'imagenes/elSenorDeLosAnillosElRetornoDelRey.jpg','elPadrino.ParteII'=>'imagenes/elPadrinoParteII.jpg');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Tienda Peliculas</title>
  </head>
  <body>
    <?php

      if(isset($_POST['anadir'])){

        $cesta->nuevaPelicula($_POST['idPelicula']);
        $cesta->guardaCesta();    
        

      }
      $cesta->muestraCesta();
      if (isset($_SESSION['cesta'])) {
        echo"<form action ='' method='post'>";
        echo"<input type='submit' name='vaciar' id='vaciar' value='Vaciar'>";
        echo"<input type='submit' name='pagar' id='pagar' value='Pagar'>";
      }
      if (isset($_POST['vaciar'])) {
       unset($_SESSION['cesta']);
       header ('Location:'.'principal.php');
      }
      if (isset($_POST['pagar'])) {
        header ('Location:'.'paginaPagar.php');
      }
    ?>  
<table class="table table-primary table-hover">
  <tr>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Categoria</th>
    <th>Precio</th>
  </tr>
  <?php
  echo"";
  foreach ($peliculas as $pelicula) {
    echo"<tr>";
    echo"<td>".$pelicula->getNombre();

    foreach ($imagenes as $titulo => $ruta) {
        if (strtolower(str_replace(" ","",$titulo)) == strtolower(str_replace(" ","",$pelicula->getNombre()))) {
            echo"<img width='200px' src='".$ruta."' alt='".$titulo."'/>";
        }
    //echo"<img src='".$ruta."' alt='".$nombre."'/>";
    }
    echo "</td>";
    echo"<td>".$pelicula->getDescripcion()."</td>";
    echo"<td>".$pelicula->getCategoria()."</td>";
    echo"<td>".$pelicula->getPrecio()."<form action='' method='post'> <input type='submit' name='anadir' id='anadir' value='Añadir a la cesta'></td>";
    echo"<input type='hidden' name='idPelicula' value='".$pelicula->getCodigo()."' id='idPelicula'/></form>";
    echo"</tr>";
  ?>
  <?php    
    }
    echo"";
    ?>
</table>
</body>
</html>

