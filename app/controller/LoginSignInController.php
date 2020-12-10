<?php

class LoginSignInController{

    public function __construct(){

    }

    /**
     * Precondición: Se transfieren datos de registro y se validan en backend
     * Post: Devuelve True si los datos son adecuados. False en caso contrario
     */
    public function validarRegistro($pUsuario){
        $resultado=true;
        $DB = new DBControl();
        $usr=$DB->verDatos($pUsuario->getNick());
        if($usr!=null){
            $resultado=false;
        }
        return $resultado;
    }

    /**
     * Realiza llamadas a funciones de DBControl.php para realizar el registro
     */
    public function efectuarRegistro($pUsuario){
        $DB=new DBControl();
        $resultadoRegistro=$DB->registrase($pUsuario);
        if($resultadoRegistro==true){
            $_SESSION['sesion_iniciada']=true;
            $_SESSION['id_usr']=$pUsuario->getNick();
            $_SESSION['rol_usr']=$pUsuario->getRol();
            $_SESSION['token']=md5(time());
        }
        return $resultadoRegistro;
    }

    /**
     * Valida que los valores sean correctos
     * Precondición: Se transfieren datos de login y se validan en backend
     * Post: Devuelve True si los datos son adecuados. False en caso contrario
     */
    public function validarInicioSesion($pUsuario){
        $DB=new DBControl();
        $resultadoInicioSesion=$DB->iniciarSesion($pUsuario->getNick(), $pUsuario->getClave());
        return $resultadoInicioSesion;
    }

    public function efectuarInicioSesion($pUsuario){
        $DB=new DBControl();
        $usuarioDefinitivo=$DB->verDatos($pUsuario->getNick());
        
        $_SESSION['sesion_iniciada']=true;
        $_SESSION['id_usr']=$usuarioDefinitivo->getNick();
        $_SESSION['rol_usr']=$usuarioDefinitivo->getRol();
        $_SESSION['token']=md5(time());
    }
}
?>