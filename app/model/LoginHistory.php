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
        $usrn=$lhe->getUsuario();
        $ipAddr=$lhe->getIpAddr();
        $lgdt=$lhe->getLoginDate();
        $suc=$lhe->isSuccessful();

        //https://www.php.net/manual/es/domdocument.createelement.php
        
        $dom =new DOMDocument();

        $dom->load("log/login_record.xml", LIBXML_NOBLANKS);
        $dom->formatOutput = true;

        $elemRoot=$dom->createElement("login_attempt");
        $elemUsr=$dom->createElement("username", $usrn);
        $elemIp=$dom->createElement("ip_address", $ipAddr);
        $elemDate=$dom->createElement("date", $lgdt);
        $elemSuccess=$dom->createElement("login_successful", $suc);
        $elemRoot->appendChild($elemUsr);
        $elemRoot->appendChild($elemIp);
        $elemRoot->appendChild($elemDate);
        $elemRoot->appendChild($elemSuccess);

        $dom->getElementsByTagName("log_history")[0]->appendChild($elemRoot);
        //https://www.php.net/manual/es/domdocument.save.php
        $dom->save("log/login_record.xml");
        
    }

    //https://www.php.net/manual/es/intro.xmlreader.php
    //https://www.php.net/manual/es/domdocument.getelementsbytagname.php
    private function readXML(){
        
        $doc=new DOMDocument();
        $doc->load("log/login_record.xml");
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
}



?>