<?php
require_once('clases/BaseDatos.class.php');
if (!isset($_SESSION['usuario'])) {
    header('Location: '.'inicioSesion.php');
}
if (isset($_SESSION['usuario'])) {
    echo"<a href='inicioSesion.php'> <button type='button'>Desconectar</button></a>";
}
$cesta = cestaCompra::cargaCesta();
$imagenes = array('PulpFiction'=>'imagenes/pulpFiction.jpg','elPadrino'=>'imagenes/elPadrino.jpg','laVidaEsBella'=>'imagenes/LaVidaEsBella.jpg','elClubDeLaLucha'=>'imagenes/ElClubDeLaLucha.jpg','cadenaPerpetua'=>'imagenes/CadenaPerpetua.jpg','laListaDeSchindler'=>'imagenes/schindlerList.jpg','saw'=>'imagenes/Saw.jpg','ReservoirDogs'=>'imagenes/reservoirDogs.jpg','elSeñorDeLosAnillos:ElRetornoDelRey'=>'imagenes/elSenorDeLosAnillosElRetornoDelRey.jpg','elPadrino.ParteII'=>'imagenes/elPadrinoParteII.jpg');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Pagar</title>
  </head>
  <body>
<table class="table table-primary table-hover">
  <tr>
    <th>Nombre</th>
    <th>Precio</th>
  </tr>
  <?php

  foreach ($cesta->getPeliculas() as $peliculas => $pelicula) {
    echo"<tr>";
    echo"<td>".$pelicula->getNombre();

    foreach ($imagenes as $titulo => $ruta) {
        if (strtolower(str_replace(" ","",$titulo)) == strtolower(str_replace(" ","",$pelicula->getNombre()))) {
            echo"<img width='200px' src='".$ruta."' alt='".$titulo."'/>";
        }
    }
    echo "</td>";
    echo"<td>".$pelicula->getPrecio()."</td>";
    echo"</tr>";
  ?>
  <?php    
    }
    echo"";
    ?>
</table>
  <a href='index.php'> <button type='button'>Seguir comprando</button></a>
  <a href='pagar.php'> <button type='button'>Realizar compra</button></a>
</body>
</html>


