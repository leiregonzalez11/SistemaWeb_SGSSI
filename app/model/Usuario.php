<?php

/**
 * Clase Usuario, que contiene datos de usuarios registrados en el sistema,
 * ya sean administradores o clientes del camping.
 */
class Usuario{

    private $DNI;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $fechNac;
    private $email;
    private $clave;
    private $rol;

    /**
     * Función constructora
     * @param DNI DNI del usuario
     * @param nombre Nombre
     * @param apellidos Apellidos
     * @param telefono Teléfono
     * @param fechNac Fecha de nacimiento
     * @param email Email de contacto
     * @param clave Contraseña (en función del contexto, en hash o texto plano)
     * @param rol Rol del usuario (Admin o Cliente)
     */
    public function __construct($DNI, $nombre, $apellidos, $telefono, $fechNac, $email, $clave, $rol, $nick){
        $this->DNI=$DNI;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->telefono=$telefono;
        $this->fechNac=$fechNac;
        $this->email=$email;
        $this->clave=$clave;
        $this->rol=$rol;
        $this->nick=$nick; #Por si hace falta
    }

    public function getDni(){
        return $this->DNI;
    }

    public function setDni($DNI)
    {
        $this->DNI=$DNI;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    public function getFechNac(){
        return $this->fechNac;
    }

    public function setFechNac($fechNac){
        $this->fechNac=$fechNac;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getClave(){
        return $this->clave;
    }

    public function setClave($clave){
        $this->clave=$clave;
    }
    
    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol=$rol;
    }

    public function getNick(){
        return $this->nick;
    }

    public function setNick($nick){
        $this->nick=$nick;
    }
}


?>