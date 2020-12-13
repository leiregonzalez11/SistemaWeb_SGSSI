<?php

use PHP_IBAN\IBAN;

/**
 * Clase complementaria a validaciones JS del lado del cliente.
 * Usada para evitar bypass de función validadora JS
 */
class ValidadorBackend
{

    public function __construct()
    {
    }

    /**
     * Valida usuarios
     * @param Usuario $usuario El usuario
     * @param string $claveVerif Clave a comprobar
     * @return bool
     */
    public function validar($usuario, $claveVerif)
    {

        if ($usuario != null) {
            $iban = $usuario->getCuenta();
            $dni = $usuario->getDni();
            $tel = $usuario->getTelefono();
            $nombre = $usuario->getNombre();
            $ape = $usuario->getApellidos();
            $nick = $usuario->getNick();
            $fechNac = $usuario->getFechNac();
            $email = $usuario->getEmail();
            $clave = $usuario->getClave();

            return $this->validarCuenta($iban) &&
                $this->validarDNI($dni) &&
                $this->validarTelefono($tel) &&
                $this->validarNombre($nombre) &&
                $this->validarApellidos($ape) &&
                $this->validarNick($nick) &&
                $this->validarFechaNacimiento($fechNac) &&
                $this->validarEmail($email) &&
                $this->validarClave($clave) &&
                $clave == $claveVerif;
        } else {
            return false;
        }
    }

    private function validarCuenta($cuenta)
    {
        if (trim($cuenta) != "") {
            //Se ha empleado una biblioteca bajo licencia GNU/GPL para la validación del IBÁN.
            //Véase lib/php-iban para más información.
            $iban = new IBAN();
            return $iban->Verify($cuenta);
        }
        return true;
    }

    private function validarDNI($dni)
    {
        /**
         * Código tomado de https://www.adaweb.es/validar-dni-con-php/ para
         * realizar las validaciones de DNI.
         * Modificado por Christian B. para ajustarse a una función booleana
         */
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        $valido = false;
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
            $valido = true;
        }
        return $valido; 
    }

    private function validarTelefono($telefono)
    {
        //https://www.php.net/manual/es/function.strval.php
        return (strlen($telefono) == 9 && !is_nan($telefono));
    }

    private function validarNombre($nombre)
    {
        return strlen($nombre) <= 30;
    }

    private function validarApellidos($apellidos)
    {
        return strlen($apellidos) <= 120;
    }

    private function validarNick($nick)
    {
        return strlen($nick) <= 30 && strlen($nick) >= 6;
    }

    private function validarFechaNacimiento($fechaNac)
    {
        /**
         * El siguiente código está basado en el siguiente sitio web:
         *  - https://www.php.net/manual/en/datetime.diff.php
         *  - Autor: The PHP Group
         *  - Autor: acrion at gmail dot com
         * y ha sido adaptado para basarse en una función booleana.
         * 
         */
        $fechaHoy = time();
        
        //$fechaInput = mktime($fechaNac);

        $fechaHoy = date('Y-m-d', $fechaHoy) . "";
        
        $datetime1 = date_create($fechaNac);
        $datetime2 = date_create($fechaHoy);

        $interval = date_diff($datetime1, $datetime2);
        
        $diferenciaDias = 0;
        if ($interval->invert) {
            
            $diferenciaDias = intval("-" . $interval->format("%a"));
        } else {
            $diferenciaDias = intval($interval->format("%a"));
            
        }
        
        if ($diferenciaDias < 0) {
            return false;
        }
        
        return true;
    }

    private function validarEmail($email)
    {
        return preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email);
    }

    private function validarClave($clave)
    {
        return strlen($clave) >= 8 && strlen($clave) <= 15 && preg_match('/^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ](?=.*[!,@,#,$,%,^,&,*,?,_,~,-])/', $clave);
    }
}
