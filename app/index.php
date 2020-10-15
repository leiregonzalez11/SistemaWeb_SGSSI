<?php
ini_set("display_erros", "on"); //Muestra errores del parser PHP -BORRAR EN PRODUCCIÓN
session_start();
include("controller/CSSDisplayController.php");
include("controller/TitleController.php");

$sesionIniciada=(isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada']==true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="shortcut icon" type="image/png" href="view/img/camping.png"/>
    <?php
        $controladorCSS=new CSSDisplayController();
        $controladorCSS->generarCSS();
    ?>

    <script src="view/js/interactivo.js"></script>
    <script src="view/js/validacion_datos.js"></script>
    <?php
        $controladorTitulo=new TitleController();
        $controladorTitulo->generarTitulo();
    ?>
</head>
<body>

<?php
include("view/php/header.inc.php");
if(isset($_GET['vista'])){
    $vista=$_GET['vista'];

    
    if(!$sesionIniciada){ //Si la sesión no está iniciada, se muestran los formularios de inicio de sesión y registro
        include("view/php/login_interface.inc.php");
        include("view/php/register_interface.inc.php");
    }
    switch($vista){ //Dependiendo del parámetro vista, se mostrará una web distinta
        case "instalaciones":
            include("view/php/instalaciones.php");
        break;
        case "filosofia":
            include("view/php/filosofia.php");
        break;
        case "donde_estamos":
            include("view/php/dondeestamos.php");
        break;
        case "contacto":
            include("view/php/contacto.php");
        break;
        case "alojamientos": //IMPLEMENTAR SUBCLASE
        break;
        default:
            include("view/php/home_interface.inc.php");
    }
}else{
//EVALUAR SI HA DADO A INICIAR SESIÓN


include("view/php/home_interface.inc.php");
}
include("view/php/footer.inc.php");

?>
</body>

</html>
