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
        $consulta ="SELECT DNI FROM Usuario WHERE nick='.$nick.' AND clave='.$contr.'";
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

        if (mysqli_num_rows (mysqli_query($enlace,"SELECT DNI FROM Usuario WHERE DNI='.$dni.' or nick='.$nick.'"))){

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
    public function verDatos($usuario){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT DNI, Nombre, Apellidos, telefono, FechNac, email, clave FROM Usuario WHERE nick='.$usuario.'";
        echo $cons;
        $res=mysqli_query($enlace,$cons);
        if($res!=false){
            if($res->num_rows=1){
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
        mysqli_close ($enlace);
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
                $cambiar="UPDATE Usuario SET rol='administrador' WHERE nick='.$nick.'";
                mysqli_query($enlace,$cambiar);
            }
            else{
                $cambiar="UPDATE Usuario SET rol='usuario' WHERE nick='.$nick.'";
                mysqli_query($enlace,$cambiar);
            }
        }
        mysqli_close ($enlace);
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
        mysqli_close ($enlace);
    }

    public function VerListaAlojamientos($IdA){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT * FROM Usuario WHERE idAlojamiento='.$IdA.'";
        $res=mysqli_query($enlace,$cons);
        mysqli_close ($enlace);
        return $res;
    }

    public function VerAlojamiento($idA){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT descripcion, metrosCuadrados, capacidad, tipo FROM Alojamiento WHERE idAlojamiento='.$idA.'";
        $res=mysqli_query($enlace,$cons);
        $buscado=mysqli_fetch_object ($res, 'Alojamiento');
        mysqli_close ($enlace);
        return $buscado;
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
        $idA=$aloj->getIdAlojamiento();
        $descr=$aloj->getDescripcion();
        $m2=$aloj->getMetrosCuadrados();
        $cap=$aloj->getCapacidad();
        $tipo=$aloj->getTipo();
        $cons="SELECT idA FROM Alojamiento WHERE idAlojamiento='.$idA.'";
        $resp=mysqli_query($enlace,$cons);
        if (mysqli_num_rows($resp)){
            $consulta="INSERT INTO Alojamiento (idAlojamiento, descripcion, metrosCuadrados, capacidad, tipo) Values ('$idA', '$descr', '$m2', '$cap', '$tipo')";
            mysqli_query($enlace,$consulta);
        }
        mysqli_close ($enlace);
    }

    public function eliminarAlojamiento($idAl){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT idA FROM Alojamiento WHERE idAlojamiento='.$idAl.'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Alijamiento WHERE idAlojamiento='.$idAl.'";
            mysqli_query($enlace,$borrar);
        }
        mysqli_close ($enlace);
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
        mysqli_close ($enlace);
    }

    public function anadirImagen(Galeria $imag){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $idAl=$imag->getIdAlojamiento();
        $num=$imag->getNum();
        $foto=$imag->getFoto();
        $cons="INSERT INTO Galeria (idAlojamiento, num, foto) Values ('$idAl','$num','$foto')";
        $resp=mysqli_query($enlace,$cons);
        mysqli_close ($enlace);
    }

    public function eliminarImagen($idAl, $num){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT foto FROM Galeria WHERE idAlojamiento='.$idAl.' AND num='.$num.'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $borrar="DELETE FROM Galeria WHERE idAlojamiento='.$idAl.'AND num='.$num.'";
            mysqli_query($enlace,$borrar);
        }
        mysqli_close ($enlace);
    }

    public function actualizarImagen(Galeria $imag){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $idAl=$imag->getIdAlojamiento();
        $num=$imag->getNum();
        $foto=$imag->getFoto();
        $cons="UPDATE Galeria SET foto='$foto' WHERE idAlojamiento='.$idAl.' AND num='.$num.'";
        mysqli_query($enlace,$cons);
        mysqli_close ($enlace);
    }
    public function VerImagen($idAl, $num){
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
                        $imagen = new Galeria($row["idAlojamiento"], $row["num"], $row["foto"]);
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
                    $imagen = new Galeria($row["idAlojamiento"], $row["num"], $row["foto"]);
                    array_push($imagenes,$imagen);
                }
            }
        }
        return $imagenes;
    }
}
?>