<?php

class DBControl{

    private $user="root";
    private $pwd="root";
    private $dbName="database";
    private $hostname="db";
    private $key='8A68AKSGGBHBSDEW465892456IWR38YR732';


    /**
     * Constructor
     */
    public function __construct(){

    }


    /**
     * Añada aquí el resto de las funciones, a conveniencia y según necesidades del software
     */
    public function iniciarSesion($nick,$contr){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        //$sal=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,rand(10,30));
        //$contrase=$sal.$contr;
        $nick=mysqli_real_escape_string($enlace,$nick);
        $consulta ="SELECT DNI, clave FROM Usuario WHERE nick='$nick'";
        $resultado=mysqli_query($enlace,$consulta);
        $num=mysqli_num_rows ($resultado);
        mysqli_close ($enlace);

        if($num==1){
            $row=$resultado->fetch_assoc();
            $claveVerif= $row['clave'];
            if(password_verify($contr, $claveVerif)){
                return true;
            }else{
                return false;
            }
            
        }
        else{
            return false;
        }
    }
    public function registrase(Usuario $usu){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $dni=$usu->getDni();
        $Nombre=$usu->getNombre();
        $Apellidos=$usu->getApellidos();
        $telf=$usu->getTelefono();
        $fecha=$usu->getFechNac();
        $email=$usu->getEmail();
        $rol=$usu->getRol();
        $nick=$usu->getNick();
        $clave=$usu->getClave();
        $cuenta=$usu->getCuenta();
        $llave=$this->key;
        //$sal=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,rand(10,30));
        //$contrase=$sal.$clave;
        $contrase=password_hash($clave, PASSWORD_BCRYPT);

        if (mysqli_num_rows (mysqli_query($enlace,"SELECT DNI FROM Usuario WHERE DNI='$dni' OR nick='$nick'"))==0){
            $consulta="INSERT INTO Usuario (DNI, nick, Nombre, Apellidos, telefono, FechNac, email, clave, cuenta, rol) VALUES ('$dni', '$nick', '$Nombre', '$Apellidos', '$telf', '$fecha', '$email', '$contrase', 'AES_ENCRYPT($cuenta,$llave)', '$rol')";
            $res=mysqli_query($enlace,$consulta);
            mysqli_close ($enlace);
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
    public function verDatos($usuarioNick){
        $usuario=null;
        $llave=$this->key;
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT DNI, Nombre, Apellidos, telefono, FechNac, email, clave, nick, AES_DECRYPT(cuenta, '$llave') as 'cuenta', rol FROM Usuario WHERE nick='$usuarioNick'";
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows==1){
                if($row=$res->fetch_assoc()){
                    $usuario=new Usuario($row["DNI"], $row["Nombre"], $row["Apellidos"],$row["telefono"],$row["FechNac"], $row["email"], $row["clave"], $row["rol"], $row["nick"], $row["cuenta"]);                    
                }
            }
        }
        mysqli_close ($enlace);
        return $usuario;
    }

    public function actualizarDatos(Usuario $usu){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $dni=$usu->getDni();
        $nick=$usu->getNick();
        $Nombre=$usu->getNombre();
        $Apellidos=$usu->getApellidos();
        $telf=$usu->getTelefono();
        $fecha=$usu->getFechNac();
        $email=$usu->getEmail();
        $clave=$usu->getClave();
        $cuenta=$usu->getCuenta();
        $llave=$this->key;
        //$sal=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,rand(10,30));
        //$contrase=$sal.$clave;
        $contrase=password_hash($clave, PASSWORD_BCRYPT);
        $cons="UPDATE Usuario SET DNI='$dni', Nombre='$Nombre', Apellidos='$Apellidos', telefono='$telf', FechNac='$fecha', cuenta='AES_ENCRYPT($cuenta, $llave)',email='$email', clave='$contrase' WHERE nick='$nick'";
        mysqli_query($enlace,$cons);
        $nu=mysqli_affected_rows($enlace);
        mysqli_close ($enlace);
        return $nu;
    }

    public function cambiarRol($nick){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT rol FROM Usuario WHERE nick='$nick'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            if($res=='usuario'){
                $cambiar="UPDATE Usuario SET rol='administrador' WHERE nick='$nick'";
                mysqli_query($enlace,$cambiar);
            }
            else{
                $cambiar="UPDATE Usuario SET rol='usuario' WHERE nick='$nick'";
                mysqli_query($enlace,$cambiar);
            }
        }
        $nu=mysqli_affected_rows($enlace);
        mysqli_close ($enlace);
        return $nu;
    }

    public function eliminarUsuario($nick){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT DNI FROM Usuario WHERE nick='$nick'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Usuario WHERE nick='$nick'";
            mysqli_query($enlace,$borrar);
        }
        $existe=mysqli_query($enlace,"SELECT * FROM Usuario WHERE nick='$nick'");
        $reg=mysqli_num_rows($existe);
        mysqli_close ($enlace);
        if($reg==0){
            return true;
        }
        else{
            return false;
        }
    }

    public function VerAlojamiento($idA){
        $aloj=null;
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT descripcion, metrosCuadrados, capacidad, tipo FROM Alojamiento WHERE idAlojamiento='$idA'";
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows==1){
                if($row=$res->fetch_assoc()){
                    $aloj=new Alojamiento($row["idAlojamiento"],$row["descripcion"], $row["metrosCuadrados"], $row["capacidad"], $row["tipo"]);
                }
            }
        }
        mysqli_close ($enlace);
        return $aloj;
    }

    public function VerAlojamientosPorTipo($idA, $tipo){
        $enlace=mysqli_connect($this->hostname,$this->user,$this->pwd,$this->dbName);
        $alojamientos=array();
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT idAlojamiento, descripcion, metrosCuadrados, capacidad FROM Alojamiento WHERE tipo ='$tipo'";
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if ($res->num_rows > 0) {
                // output data of each row
                while($row = $res->fetch_assoc()) {
                    $aloj = new Alojamiento($row["idAlojamiento"],$row["descripcion"], $row["metrosCuadrados"], $row["capacidad"], $tipo);
                    array_push($alojamientos, $aloj);
                }
            }

        }
        mysqli_close ($enlace);
        return $alojamientos;
    }

    public function anadirAlojamiento(Alojamiento $aloj){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $descr=$aloj->getDescripcion();
        $m2=$aloj->getMetrosCuadrados();
        $cap=$aloj->getCapacidad();
        $tipo=$aloj->getTipo();
        $consulta="INSERT INTO Alojamiento (descripcion, metrosCuadrados, capacidad, tipo) Values ('$descr', '$m2', '$cap', '$tipo')";
        mysqli_query($enlace,$consulta);
        $idA=mysqli_insert_id($enlace);
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Alojamiento WHERE idAlojamiento='$idA');");
        $reg=mysqli_num_rows($existe);
        mysqli_close ($enlace);
        if($reg==1){
            return $idA;
        }
        else{
            return -1;
        }
    }

    public function eliminarAlojamiento($idAl){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT idAlojamiento FROM Alojamiento WHERE idAlojamiento='$idAl'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Alojamiento WHERE idAlojamiento='$idAl'";
            mysqli_query($enlace,$borrar);
        }
        $existe=mysqli_query($enlace,"SELECT * FROM Alojamiento WHERE idAlojamiento='$idAl'");
        $reg=mysqli_num_rows($existe);
        mysqli_close ($enlace);
        if($reg==0){
            return true;
        }
        else{
            return false;
        }
    }

    public function actualizarDatosAlojamiento(Alojamiento $aloj){
        $idAl=$aloj->getIdAlojamiento();
        $descr=$aloj->getDescripcion();
        $m2=$aloj->getMetrosCuadrados();
        $cap=$aloj->getCapacidad();
        $tipo=$aloj->getTipo();
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="UPDATE Alojamiento SET descripcion='$descr', metrosCuadrados='$m2', capacidad='$cap', tipo='$tipo' WHERE idAlojamiento='$idAl'";
        mysqli_query($enlace,$cons);
        $nu=mysqli_affected_rows($enlace);
        mysqli_close ($enlace);
        if($nu==-1){
            return false;
        }
        elseif($nu==0){
            return true;
        }
        else{
            return true;
        }
    }

    public function anadirImagen(Galeria $imag){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $idAl=$imag->getIdAlojamiento();
        $num=$imag->getNum();
        $foto=$imag->getFoto();
        $exten=$imag->getExtension();
        $existe=mysqli_query($enlace,"SELECT * FROM Galeria WHERE idAlojamiento='$idAl'AND num='$num'");
        $reg=mysqli_num_rows($existe);
        if ($reg==0){
            $cons="INSERT INTO Galeria (idAlojamiento, num, foto, extension) Values ('$idAl','$num','$foto', '$exten')";
            mysqli_query($enlace,$cons);
            $existe=mysqli_query($enlace,"SELECT * FROM Galeria WHERE idAlojamiento='$idAl'AND num='$num';");
            $reg=mysqli_num_rows($existe);
            mysqli_close ($enlace);
            if($reg==1){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            mysqli_close($enlace);
            return true;
        }
    }

    public function eliminarImagen($idAl, $num){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT foto FROM Galeria WHERE idAlojamiento='$idAl' AND num='$num'";
        
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Galeria WHERE idAlojamiento='$idAl'AND num='$num'";
            mysqli_query($enlace,$borrar);
        }
        $existe=mysqli_query($enlace,"SELECT * FROM Galeria WHERE idAlojamiento='$idAl' AND num='$num'");
        $reg=mysqli_num_rows($existe);
        mysqli_close ($enlace);
        if($reg==0){
            return true;
        }
        else{
            return false;
        }
    }

    public function actualizarImagen(Galeria $imag){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $idAl=$imag->getIdAlojamiento();
        $num=$imag->getNum();
        $foto=$imag->getFoto();
        $exten=$imag->getExtension();
        $cons="UPDATE Galeria SET foto='$foto',extension='$exten' WHERE idAlojamiento='$idAl' AND num='$num'";
        mysqli_query($enlace,$cons);
        $nu=mysqli_affected_rows($enlace);
        mysqli_close ($enlace);
        return $nu;
    }
    public function VerImagen($idAl, $num){
        $imagen=null;
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT idAlojamiento, num, foto, extension FROM Galeria WHERE idAlojamiento='$idAl' AND num='$num'";
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows==1){
                if ($row=$res->fetch_assoc()){
                        $imagen = new Galeria($row["idAlojamiento"], $row["num"], $row["foto"], $row["extension"]);
                }
            }
        }
        return $imagen;
    }
    public function VerImagenes($idAl){
        $imagenes=array();
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT * FROM Galeria WHERE idAlojamiento='$idAl'";
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    $imagen = new Galeria($row["idAlojamiento"], $row["num"], $row["foto"], $row["extension"]);
                    array_push($imagenes,$imagen);
                }
            }
        }
        return $imagenes;
    }
}
?>