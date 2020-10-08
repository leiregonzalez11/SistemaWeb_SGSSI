<?php

class DBControl{

    private $user;
    private $pwd;
    private $dbName;
    private $hostname;


    /**
     * Constructor
     */
    public function __construct(){

    }


    /**
     * Añada aquí el resto de las funciones, a conveniencia y según necesidades del software
     */
    public function __iniciarSesion($usuario,$contr){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $consulta ="SELECT DNI FROM Usuario WHERE DNI=$usuario AND clave=$contr"
        $resultado=mysqli_query($consulta);
        $num=mysqli_num_rows ($resultado);
        mysqli_close ($dbName);
        if($num==1){
            return true;
        }
        else{
            return false;
        }
    }
    public function __registrase($dni, $Nombre, $Apellidos, $telf, $fecha, $email, $clave, $rol){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        if (mysqli_num_ros (mysqli_query("SELECT DNI FROM Usuario WHERE DNI=$usuario"))){
            $consulta="INSERT INTO Usuario (DNI, Nombre, Apellidos, telefono, FechNac, email, clve, rol) VALUES ($dni, $Nombre, $Apellidos, $telf, $fecha, $email, $clave, $rol)"
            $res=mysqli_query($consulta);
            mysqli_close ($dbName);
            if($res){
               return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function __ 
}

?>