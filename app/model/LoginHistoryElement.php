<?php

class LoginHistoryElement{

    private $usuario;
    private $ipAddr;
    private $loginDate;
    private $successful;


    public function __construct($usuario, $ipAddr, $loginDate, $successful){
        $this->usuario=$usuario;
        $this->ipAddr=$ipAddr;
        $this->loginDate=$loginDate;
        $this->successful=$successful;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }

    public function getIpAddr(){
        return $this->ipAddr;
    }

    public function setIpAddr($ipAddr){
        $this->ipAddr=$ipAddr;
    }

    public function getLoginDate(){
        return $this->loginDate;
    }

    public function setLoginDate($loginDate){
        $this->loginDate=$loginDate;
    }

    public function isSuccessful(){
        return $this->successful;
    }

    public function setSuccessful($successful){
        $this->successful=$successful;
    }

}



?>