<?php

class CuentaUsuarioController{


    public function __construct()
    {
        
    }

    public function analizarCambios(){
        if(isset($_POST['borrar'])){
            $this->eliminarCuentaUsuario();
        }elseif(isset($_POST['nombre_edit'])){
            $this->editarCuentaUsuario();
        }
    }

    public function editarCuentaUsuario(){
        $nick=$_SESSION['id_usr'];
        $usuario = new Usuario($_POST['dni_edit'], $_POST['nombre_edit'], $_POST['apellidos_edit'], $_POST['telefono_edit'], $_POST['fechaNac_edit'], $_POST['mail_edit'], $_POST['clave_edit'], null, $nick);

        $DB=new DBControl();
        $DB->actualizarDatos($usuario);
    }

    public function eliminarCuentaUsuario(){
        $nick=$_SESSION['id_usr'];
        $DB=new DBControl();
        $res=$DB->eliminarUsuario($nick);
        if($res){
            echo "<script>window.location.replace('index.php?accion=logout');</script>";
        }
    }
}


?>