<?php

class Reserva{

    private $dniUsuario;
    private $idAlojamiento;
    private $aforo;
    private $fechaReserva;


    public function __construct($dniUsuario, $idAlojamiento, $aforo, $fechaReserva){
        $this->dniUsuario=$dniUsuario;
        $this->idAlojamiento=$idAlojamiento;
        $this->aforo=$aforo;
        $this->fechaReserva=$fechaReserva;
    }

    public function getDniUsuario(){
        return $this->dniUsuario;
    }

    public function setDniUsuario($dniUsuario){
        $this->dniUsuario=$dniUsuario;
    }

    public function getIdAlojamiento(){
        return $this->idAlojamiento;
    }

    public function setIdAlojamiento($idAlojamiento){
        $this->idAlojamiento=$idAlojamiento;
    }

    public function getAforo(){
        return $this->aforo;
    }

    public function setAforo($aforo){
        $this->aforo=$aforo;
    }

    public function getFechaReserva(){
        return $this->fechaReserva;
    }

    public function setFechaReserva($fechaReserva){
        $this->fechaReserva=$fechaReserva;
    }

}



?>