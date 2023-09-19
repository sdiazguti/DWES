<?php
//Llamar a las clases requeridas para realizar las funciones
require_once('categorias.class.php');
require_once('peliculas.class.php');
require_once('cestaCompra.class.php');

class BaseDatos{
//Definir constantes para conectar a la base de datos
    const  HOST = "localhost";
    const  DATABASE = "tienda";
    const  USERNAME = "root";
    const PASSWORD = "";
//Atributo estatico instancia para acceder sin llamar a la clase (Guarda una instacia de la clase)
    private static $instancia = null;
//Constructor privado por defecto 
    private function __construct(){}
//Funcion publica y estatica para cargar y devolver el atributo instancia
    public static function getInstancia(){

        if (self::$instancia==null) {
            self::$instancia = new BaseDatos();
        }
        return self::$instancia;
    }
//Funcion publica para obtener conexion con la base de datos
    public function getConexion(){

        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        try {
            
            $dwes = new PDO('mysql:host='.self::HOST.';dbname='.self::DATABASE, self::USERNAME, self::PASSWORD, $opciones);
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dwes;

        } catch (Exception $ex) {
            
            echo"<p>{$ex->getMessage()}</p>";
            return null;

        }

    }

    function registrarUsuario($user,$passwd){
        $correcto=false;
        $conexion = $this->getConexion();
        $consulta = "INSERT INTO usuarios (usuario,password) VALUES (?,md5(?))";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bindValue(1,$user);
        $sentencia->bindValue(2,$passwd);
        try{

            if ($sentencia->execute()) {
                $correcto=true;
            }
    
        }
        catch(Exception $ex){
    
            echo"<p>ERROR el usuario ya esta registrado</p><p>{$ex->getMessage()}</p>";

    
        }

        
        unset($consulta);
        unset($sentencia);
        return $correcto;
    }

    function verificarUsuario($nombre,$passwd){

        $comp=false;
        $user= [];
        $conexion = $this->getConexion();
        $consulta = "SELECT usuario, password from usuarios where usuario = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bindValue(1,$nombre);
        
        try{

            if ($sentencia->execute()) {
                while ($fila = $sentencia->fetchObject()) {
        
                    $user []= array("nombre"=>$fila->usuario,"password"=>$fila->password);
                   
                }
        
            }

            if ($user != null) {
                foreach ($user as $data) {
                    if ($nombre == $data['nombre'] && $passwd == $data['password']) {
                        $comp=true;
                    }else{
                        $comp=false;
                    }
                            
                }
            }
    
        }
        catch(Exception $ex){
    
            echo"<p>No se pudo iniciar sesion</p>";

    
        }

        
        unset($consulta);
        unset($sentencia);

        return $comp;
    
    }

    public function getPeliculas($cat = NULL){

        $peliculas = [];

        $conexion = $this->getConexion();

        $consulta = "SELECT categoria, codigo, nombre, descripcion, precio FROM peliculas ";
        //si se le pasa una categoria añade el where si no no añade nada
        $consulta.= $cat !=NULL ? "WHERE categoria = ?":"";

        $sentencia = $conexion->prepare($consulta);

        if ($cat != NULL) {
            $sentencia->bindValue(1,$cat);
        }

        if ($sentencia->execute()) {
            while ($fila = $sentencia->fetchObject()) {
            //Si se le pasa categoria se le pasa la categoria(id) a la funcion getCategorias, si no, la obtiene del producto
                $c = $cat != NULL ? $this->getCategorias($cat):$this->getCategorias($fila->categoria);
            //Carga un array de objetos Electronica
                $peliculas [] = new peliculas($fila->codigo,$fila->precio,$fila->nombre,$fila->descripcion,$c);
            }

            unset($sentencia);
            return $peliculas;

        }

    }

    public function ObtenerPeliculas($codigo){

        $peliculas;

        $conexion = $this->getConexion();

        $consulta = "SELECT categoria, codigo, nombre, descripcion, precio FROM peliculas WHERE codigo = ?";
        //si se le pasa una categoria añade el where si no no añade nada

        $sentencia = $conexion->prepare($consulta);

            $sentencia->bindValue(1,$codigo);

        if ($sentencia->execute()) {
            while ($fila = $sentencia->fetchObject()) {
            //Si se le pasa categoria se le pasa la categoria(id) a la funcion getCategorias, si no, la obtiene del producto
                $c =  $this->getCategorias($fila->categoria);
            //Carga un array de objetos Electronica
                $peliculas  = new peliculas($fila->codigo,$fila->precio,$fila->nombre,$fila->descripcion,$c);
            }

            unset($sentencia);
            return $peliculas;

        }

    }

    public function getCategorias($id = NULL){

        $categoria ;

        $conexion = $this->getConexion();

        $consulta = "SELECT id, nombre FROM categorias ";
//si se le pasa el id se añade la linea, si no, no añade nada
        $consulta.= $id != NULL ? "WHERE id = ?":"";

        $sentencia = $conexion->prepare($consulta);

        if($id != NULL){
//si se la pasa el id le asigna el valor            
            $sentencia->bindValue(1,$id);

        }

        if ($sentencia->execute()) {

            
                while($fila = $sentencia->fetchObject()){

                    if ($id != NULL) {
                        //si se le pasa id carga en $categoria un objeto Categoria
                        $categoria = new categorias($fila->id, $fila->nombre);
                        
                    }else{
                        //si no se le pasa el id carga un ARRAY de objetos Categoria
                    $categoria [] = new categorias($fila->id, $fila->nombre);

                    }
                }

            unset($sentencia);
            return $categoria;

        }

    }

}
