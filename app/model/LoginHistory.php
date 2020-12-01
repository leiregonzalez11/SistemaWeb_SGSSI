<?php

class LoginHistory{

    private $history;

    public function __construct(){
    }

    public function getHistorial(){
        if($this->history==null){
            $this->readXML();
        }
        return $this->history;
    }

    public function agregarInicioSesion($lhe){
        
    }

    //https://www.php.net/manual/es/intro.xmlreader.php
    private function readXML(){
        
        $xml=new XMLReader();
        $bool=$xml->open("login_record.xml");
        
        if($bool){
            echo "A<br>";
            var_dump($xml);
            echo "B<br>";
        }else{
            echo "Ops";
        }
    }

    private function writeXML(){

    }


}



?>