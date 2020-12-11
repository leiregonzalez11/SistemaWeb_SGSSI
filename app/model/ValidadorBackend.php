<?php

use PHP_IBAN\IBAN;

/**
 * Clase complementaria a validaciones JS del lado del cliente.
 * Usada para evitar bypass de función validadora JS
 */
class ValidadorBackend{

    public function __construct()
    {
        
    }

    /**
     * Valida usuarios
     * @param Usuario $usuario El usuario
     * @return bool
     */
    public function validar($usuario){
        
        if($usuario!=null){
            $iban=$usuario->getCuenta();
            $dni=$usuario->getDni();
            $tel=$usuario->getTelefono();
            $nombre=$usuario->getNombre();
            $ape=$usuario->getApellidos();
            $nick = $usuario->getNick();
            $fechNac=$usuario->getFechNac();
            $email=$usuario->getEmail();
            $clave=$usuario->getClave();

            return $this->validarCuenta($iban) && 
                $this->validarDNI($dni) &&
                $this->validarTelefono($tel) &&
                $this->validarNombre($nombre) &&
                $this->validarApellidos($ape) &&
                $this->validarNick($nick) &&
                $this->validarFechaNacimiento($fechNac) &&
                $this->validarEmail($email) &&
                $this->validarClave($clave);
        }else{
            return false;
        }
    }

    private function validarCuenta($cuenta){
        $iban = new IBAN();
        return $iban->Verify($cuenta);
    }

    private function validarDNI($dni){
        $letras="TRWAGMYFPDXBNJZSQVHLCKET";
        $caracterDNI= substr($dni, 8, sizeof($dni));//https://www.php.net/manual/es/function.substr.php
        $numCaracterDNI=intval($caracterDNI)%23;
        $letraValida=$letras[substr($letras, $numCaracterDNI, ($numCaracterDNI+1))];
        return $caracterDNI==$letraValida;

    }

    private function validarTelefono($telefono){
        return sizeof($telefono)==9 && !is_nan($telefono);

    }

    private function validarNombre($nombre){
        return sizeof($nombre)<=30;
    }

    private function validarApellidos($apellidos){
        return sizeof($apellidos)<=120;
    }

    private function validarNick($nick){
        return sizeof($nick)<=30 && sizeof($nick)>=6;
    }

    private function validarFechaNacimiento($fechaNac){

    }

    private function validarEmail($email){
        return preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email);
    }

    private function validarClave($clave){
        return sizeof($clave)>=8 && sizeof($clave)<=15;
    }

}
