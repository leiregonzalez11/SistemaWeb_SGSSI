
<?php
/**
 * 
 * Clase PHP que discrimina el CSS a mostrar en función de ciertas variables 
 *  
*/

class CSSDisplayController{
    public function __construct(){

    }

    public function generarCSS(){
        echo '<link rel="stylesheet" href="view/css/global.css">';
        echo '<link rel="stylesheet" href="view/css/header.css">';
        echo '<link rel="stylesheet" href="view/css/footer.css">';
        if(!$sesionIniciada){
            echo '<link rel="stylesheet" href="view/css/login_signin_container.css">';
        }

        if(!isset($_GET['vista']) || ($_GET['vista']!="instalaciones" && $_GET['vista']!="filosofia" && $_GET['vista']!="donde_estamos" && $_GET['vista']!="contacto" && $_GET['vista']!="alojamientos")){
            echo ' <link rel="stylesheet" href="view/css/homepage.css">';
        }
    }
}

?>