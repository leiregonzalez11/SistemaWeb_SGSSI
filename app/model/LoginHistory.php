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
    //https://www.php.net/manual/es/domdocument.getelementsbytagname.php
    private function readXML(){
        
        $doc=new DOMDocument();
        $doc->load("login_record.xml");
        $elementos=$doc->getElementsByTagName("login_attempt");
        for($i=0; $i<sizeof($elementos); $i++){
            $lhe=new LoginHistoryElement(null, null, null, null);
            $listaElemConcreto=$elementos[$i]->childNodes;
            foreach($listaElemConcreto as $nodo){
                
                if($nodo->nodeName!="#text"){
                    switch($nodo->nodeName){
                        case "username":
                            $lhe->setUsuario($nodo->nodeValue);
                        break;
                        case "ip_address":
                            $lhe->setIpAddr($nodo->nodeValue);
                        break;
                        case "date":
                            $lhe->setLoginDate($nodo->nodeValue);
                        break;
                        case "login_successful":
                            $lhe->setSuccessful($nodo->nodeValue);
                        break;
                    }
                }
                
            }
            array_push($this->history, $lhe);
        }
    }

    private function writeXML(){

    }


}



?>