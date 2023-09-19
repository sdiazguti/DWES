<?php
require_once('clases/BaseDatos.class.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>REGISTRO</title>
  </head>
  <body>
  <?php
                if (isset($_POST['registrar'])) {
        
                    if (isset($_POST['usuario']) && isset($_POST['passwd']) && isset($_POST['passwd2'])) {
                        
                        if ($_POST['passwd'] == $_POST['passwd2']) {

                            if (BaseDatos::getInstancia()->registrarUsuario($_POST['usuario'],($_POST['passwd']))) {
                                session_start();
                                $arrUser = array('nombre'=>$_POST['usuario'],'password'=>md5($_POST['passwd']));
                                $_SESSION['usuario']=$arrUser;
                                header('Location: '.'index.php');
                            }else{
                                echo"USUARIO ya esta registrado";
                            }
                            
                        }else{
                            echo"CONTRASEÑAS NO COINCIDEN";
                        }
            
                    }
                }
        ?>
    <form method="post" action="">
        <fieldset>
            <legend>Registro de usuarios</legend> 
        <label for="usuario">Nombre usuario: </label>
        <input type="text" id="usuario" name="usuario" required><br>
        <label for="passwd">Contraseña: </label>
        <input type="password" id="passwd" name="passwd" required><br>
        <label for="passwd">Repita la contraseña: </label>
        <input type="password" id="passwd2" name="passwd2" required><br>
        <button  type='submit' name='registrar'>Registrar</button>
        <a href='inicioSesion.php'> <button type='button'>Iniciar sesión</button></a>
        </fieldset>
    </form>
</body>
</html>