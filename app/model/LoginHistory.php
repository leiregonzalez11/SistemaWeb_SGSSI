<?php

class LoginHistory{

    private $history;

    public function __construct(){
    }

    public function getHistorial(){
        if($this->history==null){
            $this->history=array();
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
            $xml->read();
            
            $nodo=$xml->expand();
            $k=0;
            $valores=array();
            for($i=0; $i<sizeof($nodo->childNodes); $i++){
                if($nodo->childNodes[$i]->nodeName!="#text"){
                    $nodosHijo=$nodo->childNodes[$i];
                    for($j=0; $j<sizeof($nodosHijo->childNodes); $j++){
                        if($nodosHijo->childNodes[$j]->nodeName!="#text"){
                            $nodoAnalizar=$nodosHijo->childNodes[$j];
                            $valor= $nodoAnalizar->nodeValue;
                            $valores[$k]=$valor;
                            $k++;
                        }
                    }
                    $k=0;
                    array_push($this->history, new LoginHistoryElement($valores[0], $valores[1], $valores[2], $valores[3]));
                }
            }
        }
    }

    private function writeXML(){

    }


}



?>