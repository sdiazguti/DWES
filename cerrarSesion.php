<?php
    session_start();
    echo $_SESSION['usuario']['nombre'];
if (isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location: '.'inicioSesion.php');
}