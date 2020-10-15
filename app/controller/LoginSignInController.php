<?php

class LoginSignInController{

    public function __construct(){

    }

    /**
     * Precondición: Se transfieren datos de registro y se validan en backend
     * Post: Devuelve True si los datos son adecuados. False en caso contrario
     */
    public function validarRegistro($pUsuario){

    }

    /**
     * Realiza llamadas a funciones de DBControl.php para realizar el registro
     */
    public function efectuarRegistro($pUsuario){

    }

    /**
     * Valida que los valores sean correctos
     * Precondición: Se transfieren datos de login y se validan en backend
     * Post: Devuelve True si los datos son adecuados. False en caso contrario
     */
    public function validarInicioSesion($pUsuario){

    }

    public function efectuarInicioSesion($pUsuario){
        
    }
}
?>