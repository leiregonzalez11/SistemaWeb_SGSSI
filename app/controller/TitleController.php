<?php
/**
 * Controlador de títulos de la página web
 */

class TitleController{
     public function __construct(){

     }

     public function generarTitulo(){
        $titulo="<title>CAMPING SGSSI -";
        if(isset($_GET['vista'])){
            $vista=$_GET['vista'];
            switch($vista){
                case "instalaciones":
                    $titulo=$titulo." Instalaciones</title>";
                break;
                case "filosofia":
                    $titulo=$titulo." Filosofía</title>";
                break;
                case "donde_estamos":
                    $titulo=$titulo." ¿Dónde estamos?</title>";
                break;
                case "contacto":
                    $titulo=$titulo." Contacto</title>";
                break;
                case "alojamientos":
                    $titulo=$titulo." Alojamientos</title>";
                break;
                default:
                $titulo=$titulo." Página Principal</title>";
            }
        }else{
            $titulo=$titulo." Página Principal</title>";
        }

        echo $titulo;
     }
 }


?>