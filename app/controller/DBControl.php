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
            $stmt=$enlace->prepare("INSERT INTO Usuario (DNI, nick, Nombre, Apellidos, telefono, FechNac, email, clave, cuenta, rol) VALUES (?,?,?,?,?,?,?,?, AES_ENCRYPT(?,'$llave'),?)");
            $stmt->bind_param("ssssisssss",$dni, $nick, $Nombre, $Apellidos, $telf, $fecha, $email, $contrase, $cuenta, $rol);
            $res=$stmt->execute();
            $stmt->close();

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
        $stmt=$enlace->prepare("UPDATE Usuario SET DNI=?, Nombre=?, Apellidos=?, telefono=?, FechNac=?, cuenta='AES_ENCRYPT(?, $llave)',email=?, clave=? WHERE nick=?");
        $stmt->bind_param("sssisssss",$dni, $Nombre, $Apellidos, $telf, $fecha, $cuenta, $email, $contrase, $nick);
        $res=$stmt->execute();
        $stmt->close();
        return $res;
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
                $stmt=$enlace->prepare("UPDATE Usuario SET rol='administrador' WHERE nick=?");
                $stmt->bind_param("s",$nick);
                $res=$stmt->execute();
                $stmt->close();
            }
            else{
                $stmt=$enlace->prepare("UPDATE Usuario SET rol='usuario' WHERE nick=?");
                $stmt->bind_param("s",$nick);
                $res=$stmt->execute();
                $stmt->close();
            }
        }
        return $res;
    }

    public function eliminarUsuario($nick){
        $enlace=mysqli_connect(($this->hostname),($this->user),($this->pwd),($this->dbName));
        if(!$enlace){
            die("Fallo de conexion:" . mysqli_connect_error());
        }
        $cons="SELECT DNI FROM Usuario WHERE nick='$nick'";
        $res=mysqli_query($enlace,$cons);
        if(mysqli_num_rows ($res)==1){
            $stmt=$enlace->prepare("DELETE FROM Usuario WHERE nick=?");
            $stmt->bind_param("s",$nick);
            $res=$stmt->execute();
            $stmt->close();

        }
        return $res;

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

        $idA=mysqli_insert_id($enlace);
        $existe=mysqli_query($enlace,"SELECT EXISTS (SELECT * FROM Alojamiento WHERE idAlojamiento='$idA');");
        $reg=mysqli_num_rows($existe);
        //mysqli_close ($enlace);

        $stmt=$enlace->prepare("INSERT INTO Alojamiento (descripcion, metrosCuadrados, capacidad, tipo) VALUES (?,?,?,?)");
        $stmt->bind_param("sdis",$descr, $m2, $cap, $tipo);
        $stmt->execute();
        $stmt->close();
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
            $stmt=$enlace->prepare("DELETE FROM Alojamiento WHERE idAlojamiento=?");
            $stmt->bind_param("i",$idAl);
            $res=$stmt->execute();
            $stmt->close();
        }
        return $res;
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

        $stmt=$enlace->prepare("UPDATE Alojamiento SET descripcion=?, metrosCuadrados=?, capacidad=?, tipo=? WHERE idAlojamiento=?");
        $stmt->bind_param("sdisi",$descr, $m2, $cap, $tipo, $idAl);
        $res=$stmt->execute();
        $stmt->close();
        return $res;
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
        mysqli_close($enlace);
        if ($reg==0){

            $stmt=$enlace->prepare("INSERT INTO Galeria (idAlojamiento, num, foto, extension) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss",$idAl, $num, $foto, $exten);
            $res=$stmt->execute();
            $stmt->close();
            return $res;
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
            $stmt=$enlace->prepare("DELETE FROM Galeria WHERE idAlojamiento=? AND num=?");
            $stmt->bind_param("ii",$idAl, $num);
            $res=$stmt->execute();
            $stmt->close();
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

        $stmt=$enlace->prepare("UPDATE Galeria SET foto=?,extension=? WHERE idAlojamiento=? AND num=?");
        $stmt->bind_param("ssii",$foto, $exten, $idal, $num);
        $res=$stmt->execute();
        $stmt->close();

        return $res;
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