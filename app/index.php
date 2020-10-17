<?php
ini_set("display_erros", "on"); //Muestra errores del parser PHP -BORRAR EN PRODUCCIÓN
session_start();

if(isset($_GET['accion']) && $_GET['accion']=="logout"){
    session_destroy();
    header("Location: index.php");
}


include("controller/CSSDisplayController.php");
include("controller/TitleController.php");
include("controller/LoginSignInController.php");
include("controller/CuentaUsuarioController.php");
include("controller/DBControl.php"); 
include("controller/AlojamientoController.php");
include("model/Usuario.php");
include("model/Alojamiento.php");
include("model/Galeria.php");
//$_SESSION['sesion_iniciada']=true;
//$_SESSION['usr_rol']="Admin";
//ANTES DE NADA VALIDAMOS SI HA INICIADO SESIÓN EL USUARIO, YA QUE
//EL RESTO DEL SITIO WEB DEPENDE DE ELLO



if(isset($_POST['dni_reg'])){
    $usuario=new Usuario($_POST['dni_reg'],
                         $_POST['nombre_reg'],
                        $_POST['apellidos_reg'],
                        $_POST['phone_reg'],
                        $_POST['fechaNac_reg'],
                        $_POST['mail_reg'],
                        $_POST['clave_reg'],
                        'Cliente',
                        $_POST['nickname_reg']);
    $ctrRegistro=new LoginSignInController();
    if($ctrRegistro->validarRegistro($usuario)){
        $ctrRegistro->efectuarRegistro($usuario);
    }

}else if(isset($_POST['iniciar_sesion'])){
    $usuario=new Usuario(null,
                        null,
                        null,
                        null,
                        null,
                        $_POST['mail'],
                        $_POST['clave'],
                        null,
                        $_POST['nickname']);
    $ctrInicioSesion=new LoginSignInController();
    if($ctrInicioSesion->validarInicioSesion($usuario)){
        $ctrInicioSesion->efectuarInicioSesion($usuario);
    }
}



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

    <script src="view/js/interactivo.js" async></script>
    <script src="view/js/validar_Usuario.js" async></script>
    <?php
        $controladorTitulo=new TitleController();
        $controladorTitulo->generarTitulo();
    ?>
</head>
<body>

<?php
include("view/php/header.inc.php");
if(!$sesionIniciada){ //Si la sesión no está iniciada, se muestran los formularios de inicio de sesión y registro
    include("view/php/login_interface.inc.php");
    include("view/php/register_interface.inc.php");
}
if(isset($_GET['vista'])){
    $vista=$_GET['vista'];

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
        case "faqs":
            include("view/php/faqs.php");
        break;
        case "alojamientos": //DELEGAMOS EN OTRA CLASE
            $controladorAlojamiento=new AlojamientoController();
            $controladorAlojamiento->determinarVista();
        break;
        case "editar_cuenta":
            $cuentaControlador=new CuentaUsuarioController();
            $cuentaControlador->analizarCambios();
            include("view/php/cuenta_usuario.php");
        break;
        case "quienes_somos":
            include("view/php/quienessomos.php");
        break;
        default:
            include("view/php/home_interface.inc.php");
    }
}else{

    include("view/php/home_interface.inc.php");
}
include("view/php/footer.inc.php");

?>
</body>

</html>
