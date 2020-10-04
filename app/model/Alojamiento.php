<?php

class Alojamiento{


    private $idAlojamiento;
    private $descripcion;
    private $metrosCuadrados;
    private $capacidad;
    private $tipo;


    public function __construct($idAlojamiento, $descripcion, $metrosCuadrados, $capacidad, $tipo){
        $this->idAlojamiento=$idAlojamiento;
        $this->descripcion=$descripcion;
        $this->metrosCuadrados=$metrosCuadrados;
        $this->capacidad=$capacidad;
        $this->tipo=$tipo;
    }

    public function getIdAlojamiento(){
        return $this->idAlojamiento;
    }

    public function setIdAlojamiento($idAlojamiento){
        $this->idAlojamiento=$idAlojamiento;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function getMetrosCuadrados(){
        return $this->metrosCuadrados;
    }

    public function setMetrosCuadrados($metrosCuadrados){
        $this->metrosCuadrados=$metrosCuadrados;
    }

    public function getCapacidad(){
        return $this->capacidad;
    }

    public function setCapacidad($capacidad){
        $this->capacidad=$capacidad;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo=$tipo;
    }

}


?>