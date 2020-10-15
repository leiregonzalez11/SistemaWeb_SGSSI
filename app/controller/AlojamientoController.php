<?php

class AlojamientoController{



    public function __construct()
    {
        
    }

    /**
     * En función de ciertas acciones tomadas por el usuario, se determinará la vista
     * a mostrar
     */
    public function determinarVista(){
        if(!isset($_GET['id_alojamiento'])){
            if(isset($_GET['tipo'])){
                $tipo=$_GET['tipo'];
                if($tipo=="parcela_tienda" || $tipo=="parcela_caravana" || $tipo=="caravana" || $tipo=="bungalow"){
                    include("view/php/alojamientos.php");
                    mostrarListado($tipo);
                }else{
                    //Redireccionamos por defecto
                    //header("Location: index.php?vista=alojamientos&tipo=parcela_tienda");
                    
                }
            }else{
                //REDIRIGIMOS
                //header("Location: index.php?vista=alojamientos&tipo=parcela_tienda");
            }
        }else{
            //JUZGAMOS, ADMIN O USUARIO NORMAL (CON SESIÓN INICIADA!)
        }
    }

}


?>