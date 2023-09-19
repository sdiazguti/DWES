<?php
require_once('clases/BaseDatos.class.php');
$total=cestaCompra::cargaCesta()->getCoste();
if (isset($_SESSION['cesta'])) {
unset($_SESSION['cesta']);
}

echo"Se ha realizado una compra con importe de ".$total." €";
echo"<a href='index.php'> <button type='button'>Realizar otra compra</button></a>";
?>