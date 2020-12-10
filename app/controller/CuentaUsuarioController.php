<?php

class CuentaUsuarioController{


    public function __construct()
    {
        
    }

    public function analizarCambios(){
        if(isset($_POST['borrar']) && $_POST['token']==$_SESSION['token']){
            $this->eliminarCuentaUsuario();
        }elseif(isset($_POST['nombre_edit'] ) && $_POST['token']==$_SESSION['token']){
            $this->editarCuentaUsuario();
        }
    }

    public function editarCuentaUsuario(){
        $nick=$_SESSION['id_usr'];
        $usuario = new Usuario(test_input($_POST['dni_edit']), test_input($_POST['nombre_edit']), test_input($_POST['apellidos_edit']), test_input($_POST['telefono_edit']), test_input($_POST['fechaNac_edit']), test_input($_POST['mail_edit']), test_input($_POST['clave_edit']), null, $nick, test_input($_POST['cuenta_edit']));

        $DB=new DBControl();
        $DB->actualizarDatos($usuario);

        $_SESSION['clave']=test_input($_POST['clave_edit']);
    }

    public function eliminarCuentaUsuario(){
        $nick=$_SESSION['id_usr'];
        $DB=new DBControl();
        $res=$DB->eliminarUsuario($nick);
        if($res){
            echo "<script>window.location.replace('index.php?accion=logout');</script>";
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }
}


?>