<?php
ini_set("display_errors", "on"); //Muestra errores del parser PHP -BORRAR EN PRODUCCIÓN

session_start();


if(isset($_GET['accion']) && $_GET['accion']=="logout"){
    session_destroy();
    header("Location: index.php");
}

if(isset($_SESSION['tiempo'])){
    $time=intval($_SESSION['tiempo']);
    if(intval(time())>($time+60) && isset($_SESSION['sesion_iniciada'])){
        session_destroy();
        header("Location: index.php?inactivo=true");
    }
}
$_SESSION['tiempo']=time();

include("controller/CSSDisplayController.php");
include("controller/TitleController.php");
include("controller/LoginSignInController.php");
include("controller/CuentaUsuarioController.php");
include("controller/DBControl.php"); 
include("controller/AlojamientoController.php");
include("model/Usuario.php");
include("model/Alojamiento.php");
include("model/Galeria.php");

include("model/LoginHistoryElement.php");
include("model/LoginHistory.php");
include("model/InputCleaner.php");
include("model/ValidadorFormulariosBackend.php");

//$_SESSION['sesion_iniciada']=true;
//$_SESSION['usr_rol']="Admin";
//ANTES DE NADA VALIDAMOS SI HA INICIADO SESIÓN EL USUARIO, YA QUE
//EL RESTO DEL SITIO WEB DEPENDE DE ELLO

$DB = new DBControl();
$numUsrs=$DB->getNumeroUsuarios();
if($numUsrs==0){
    $_SESSION['nueva_instalacion']=true;
}

if(isset($_POST['dni_reg'])){
    $val = new InputCleaner();
    
    $usuario=new Usuario($val->test_input($_POST['dni_reg']),
                        $val->test_input($_POST['nombre_reg']),
                        $val->test_input($_POST['apellidos_reg']),
                        $val->test_input($_POST['phone_reg']),
                        $val->test_input($_POST['fechaNac_reg']),
                        $val->test_input($_POST['mail_reg']),
                        $val->test_input($_POST['clave_reg']),
                        'Cliente',
                        $val->test_input($_POST['nickname_reg']),
                        $val->test_input($_POST['cuenta_reg']));
    
    if(isset($_SESSION['nueva_instalacion'])){
        $usuario->setRol("Admin");
        unset($_SESSION['nueva_instalacion']);
    }
    
    
    $ctrRegistro=new LoginSignInController();
    if($ctrRegistro->validarRegistro($usuario)){
        $resultRegistro=$ctrRegistro->efectuarRegistro($usuario);
        if(!$resultRegistro){
            $_SESSION['registro_incorrecto']="No se ha podido registrar el usuario. Puede que ya tenga otro usuario con el mismo DNI. Inténtelo de nuevo más tarde.";    
        }else{
            $lhe=new LoginHistoryElement($_POST['nickname_reg'], $_SERVER['REMOTE_ADDR'], time(), "True");
            $lh=new LoginHistory();
            $lh->agregarInicioSesion($lhe);
        }
    }else{
        $_SESSION['registro_incorrecto']="No se ha podido registrar el usuario. Tal vez el nick ya exista. Pruebe con otro nick e inténtelo de nuevo.";
    }

}else if(isset($_POST['iniciar_sesion'])){
    $val = new InputCleaner();
    $usuario=new Usuario(null,
                        null,
                        null,
                        null,
                        null,
                        $val->test_input($_POST['mail']),
                        $val->test_input($_POST['clave']),
                        null,
                        $val->test_input($_POST['nickname']),
                        null);
    
    $ctrInicioSesion=new LoginSignInController();
    $lhe=null;
    if($ctrInicioSesion->validarInicioSesion($usuario)){
        $ctrInicioSesion->efectuarInicioSesion($usuario);
        $lhe=new LoginHistoryElement($_POST['nickname'], $_SERVER['REMOTE_ADDR'], time(), "True");//https://www.php.net/manual/es/reserved.variables.server.php
    }else{
        $_SESSION['inicio_sesion_incorrecto']="Nick o clave incorrectas";
        $lhe=new LoginHistoryElement($_POST['nickname'], $_SERVER['REMOTE_ADDR'], time(), "False");
    }
    $lh=new LoginHistory();
    $lh->agregarInicioSesion($lhe);
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
    <script src="view/js/modificar_usuario.js" async></script>
    <script src="view/js/iban_validator/iban.js" async></script>
    <!-- Se pueden ver ejemplos de códigos IBAN en https://www.citadele.lt/en/online-banking/examples/-->
    <!--<audio src="view/img/Lluvia-1.mp3" autoplay loop>-->
</audio>
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
            mostrarDatosCuenta();
        break;
        case "quienes_somos":
            include("view/php/quienessomos.php");
        break;
        case "terminos":
            include("view/php/terminos.php");
        break;
        case "logs":
            include("view/php/logs.php");
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
