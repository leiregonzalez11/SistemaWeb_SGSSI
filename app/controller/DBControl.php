<?php

class DBControl{

    private $user="root";
    private $pwd="root";
    private $dbName="database";
    private $hostname="db";


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
        $consulta ="SELECT DNI FROM Usuario WHERE nick='$nick' AND clave='$contr'";
        $resultado=mysqli_query($enlace,$consulta);
        $num=mysqli_num_rows ($resultado);
        mysqli_close ($enlace);
        if($num==1){
            return true;
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

        if (mysqli_num_rows (mysqli_query($enlace,"SELECT DNI FROM Usuario WHERE DNI='$dni' OR nick='$nick'"))==0){
            $consulta="INSERT INTO Usuario (DNI, nick, Nombre, Apellidos, telefono, FechNac, email, clave, rol) VALUES ('$dni', '$nick', '$Nombre', '$Apellidos', '$telf', '$fecha', '$email', '$clave', '$rol')";
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
    public function verDatos($nckUsuario){
        $usuario=null;
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT DNI, Nombre, Apellidos, telefono, FechNac, email, clave, nick, rol FROM Usuario WHERE nick='$nckUsuario'";
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows==1){
                if($row=$res->fetch_assoc()){
                    $usuario=new Usuario($row["DNI"], $row["Nombre"], $row["Apellidos"],$row["telefono"],$row["FechNac"], $row["email"], $row["clave"], $row["rol"], $row["nick"]);
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

        $cons="UPDATE Usuario SET DNI='$dni', nick='$nick', Nombre='$Nombre', Apellidos='$Apellidos', telefono='$telf', FechNac='$fecha', email='$email', clave='$clave' WHERE DNI='$dni'";
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
        $cons="SELECT DNI FROM Usuario WHERE nick='.$nick.'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Usuario WHERE nick='.$nick.'";
            mysqli_query($enlace,$borrar);
        }
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Usuario WHERE nick='$nick');");
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
        echo $cons;
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
        echo $cons;
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
        $idAl=$aloj->getIdAlojamiento();
        $descr=$aloj->getDescripcion();
        $m2=$aloj->getMetrosCuadrados();
        $cap=$aloj->getCapacidad();
        $tipo=$aloj->getTipo();
        $consulta="INSERT INTO Alojamiento (idAlojamiento, descripcion, metrosCuadrados, capacidad, tipo) Values ('$idAl', '$descr', '$m2', '$cap', '$tipo')";
        mysqli_query($enlace,$consulta);
        $idA=mysqli_insert_id($enlace);
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Alojamiento WHERE idAlojamiento='$idA');");
        $reg=mysqli_num_rows($existe);
        mysqli_close ($enlace);
        if($reg==1){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function eliminarAlojamiento($idAl){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT idA FROM Alojamiento WHERE idAlojamiento='$idAl'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Alojamiento WHERE idAlojamiento='$idAl'";
            mysqli_query($enlace,$borrar);
        }
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Alojamiento WHERE idAlojamiento='$idAl');");
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
            return false;
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
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Galeria WHERE nick='$idAl'AND num='$num');");
        $reg=mysqli_num_rows($existe);
        if ($reg==0){
            $cons="INSERT INTO Galeria (idAlojamiento, num, foto, extension) Values ('$idAl','$num','$foto', '$exten')";
            mysqli_query($enlace,$cons);
            $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Galeria WHERE nick='$idAl'AND num='$num');");
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
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Galeria WHERE idAlojamiento='$idAl' AND num='$num');");
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
        $cons="SELECT * FROM Galeria WHERE idAlojamiento='.$idAl.' AND num='.$num.'";
        echo $cons;
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows==1){
                if ($row=$res->fetch_assoc()){
                        $imagen = new Galeria($row["idAlojamiento"], $row["num"], $row["foto"], $row["Extension"]);
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
        echo $cons;
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
