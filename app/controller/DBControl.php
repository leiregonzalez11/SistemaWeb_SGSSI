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
    public function iniciarSesion($usuario,$contr){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $consulta ="SELECT nick FROM Usuario WHERE nick='$usuario' AND clave='$contr'";
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
    public function registrase($dni, $nick, $Nombre, $Apellidos, $telf, $fecha, $email, $clave, $rol){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        if (mysqli_num_ros (mysqli_query("SELECT DNI FROM Usuario WHERE DNI='$usuario' or nick='$nick'"))){
            $consulta="INSERT INTO Usuario (DNI, nick, Nombre, Apellidos, telefono, FechNac, email, clave, rol) VALUES ('$dni', '$nick', '$Nombre', '$Apellidos', '$telf', '$fecha', '$email', '$clave', '$rol')";
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
    public function verDatos($usuario){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="SELECT DNI, Nombre, Apellidos, telefono, FechNac, email, clave FROM Usuario WHERE nick='$usuario'";
        $res=mysqli_query($cons);
        mysqli_close ($dbName);
        return $res;
    }
    public function actualizarDatos($dni, $nick, $Nombre, $Apellidos, $telf, $fecha, $email, $clave){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="UPDATE Usuario SET DNI='$dni', nick='$nick', Nombre='$Nombre', Apellidos='$Apellidos', telefono='$telf', FechNac='$fecha', email='$email', clave='$clave' WHERE DNI='$dni'";
        mysqli_query($cons);
        mysqli_close ($dbName);
    }
    public function cambiarRol($nick){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="SELECT rol FROM Usuario WHERE nick='$nick'";
        $res=mysqli_query($cons);
        if(mysqli_num_rows ($res)==1){
            if($res=='usuario'){
                $cambiar="UPDATE Usuario SET rol='$administrador' WHERE nick='$nick'");
                mysqli_query($cambiar);
            }
            else{
                $cambiar="UPDATE Usuario SET rol='$usuario' WHERE nick='$nick'");
                mysqli_query($cambiar);
            }
        }
        mysqli_close ($dbName);
    }
    public function eliminarUsuario($nick){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="SELECT DNI FROM Usuario WHERE nick='$nick'";
        $res=mysqli_query($cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Usuario WHERE nick='$nick'");
            mysqli_query($cambiar);
        }
        mysqli_close ($dbName);
    }
    public function VerListaAlojamientos($IdA){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="SELECT * FROM Usuario WHERE idAlojamiento='$idA'";
        $res=mysqli_query($cons);
        mysqli_close ($dbName);
        return $res;
    }
    public function VerAlojamiento($idA){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="SELECT descripcion, metrosCuadrados, capacidad, tipo FROM Alojamiento WHERE idAlojamiento '$idA'";
        $res=mysqli_query($cons);
        mysqli_close ($dbName);
        return $res;
    }
    public function anadirAlojamiento($idA, $descr, $m2, $cap, $tipo){
        mysqli_connect($hostname,$user,$pwd);
        mysqli_select_db($dbName);
        $cons="SELECT idA FROM Alojamiento WHERE idAlojamiento='$idA'";
        $resp=mysqli_query($cons);
        if (mysqli_num_rows($resp)){
            $consulta="INSERT INTO Alojamiento (idAlojamiento, descripcion, metrosCuadrados, capacidad, tipo) Values ('$idA', '$descr', '$m2', '$cap', '$tipo')";
            mysqli_query($consulta);
        }
        mysqli_close ($dbName);
    }
}

?>