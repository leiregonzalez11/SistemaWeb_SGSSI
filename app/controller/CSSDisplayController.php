
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
        
        if(isset($_GET['vista']) && $_GET['vista']=="alojamientos" && !isset($_GET['id_alojamiento'])){
            echo '<link rel="stylesheet" href="view/css/alojamientos_general.css">';
        }

        if(!isset($_GET['vista']) || ($_GET['vista']!="instalaciones" && $_GET['vista']!="editar_cuenta" && $_GET['vista']!="filosofia" && $_GET['vista']!="donde_estamos" && $_GET['vista']!="contacto" && $_GET['vista']!="alojamientos" && $_GET['vista']!="faqs" && $_GET['vista']!="terminos" && $_GET['vista']!="quienes_somos" && $_GET['vista']!="logs")){
            echo ' <link rel="stylesheet" href="view/css/homepage.css">';
        }

        if(isset($_GET['vista']) && $_GET['vista']=="alojamientos" && isset($_GET['id_alojamiento'])|| $_GET['vista']=="editar_cuenta"){
            echo '
            <link rel="stylesheet" href="view/css/alojamiento_admin.css">
            <link rel="stylesheet" href="view/css/alojamiento_detalle.css">
            <link rel="stylesheet" href="view/css/carrusel.css">
            <script src="view/js/carrusel.js" async></script>';
        }

        if(isset($_GET['vista']) && $_GET['vista']=="logs"){
            echo '<link rel="stylesheet" href="view/css/log_tabla.css">';
        }
    }
}

?>