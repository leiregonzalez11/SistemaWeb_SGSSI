<?php


class Galeria{

    private $idAlojamiento;
    private $num;
    private $foto;
    private $extension;

    public function __construct($idAlojamiento, $num, $foto, $extension){
        $this->idAlojamiento=$idAlojamiento;
        $this->num=$num;
        $this->foto=$foto;
        $this->extension=$extension;
    }

    public function getIdAlojamiento(){
        return $this->idAlojamiento;
    }

    public function setIdAlojamiento($idAlojamiento){
        $this->idAlojamiento=$idAlojamiento;
    }

    public function getNum(){
        return $this->num;
    }

    public function setNum($num){
        $this->num=$num;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto=$foto;
    }


    public function getExtension(){
        return $this->extension;
    }

    public function setExtension($ext){
        $this->extension=$ext;
    }
}



?>