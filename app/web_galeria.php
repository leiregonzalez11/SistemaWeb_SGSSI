


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="view/css/global.css">
    
    <link rel="stylesheet" href="view/css/carrusel.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/footer.css">
    <link rel="stylesheet" href="view/css/login_signin_container.css">
    <script src="view/js/interactivo.js"></script>
    
    <script src="view/js/validacion_datos.js"></script>
    <script src="view/js/carrusel.js" async></script>
    <title>CAMPING SGSSI</title>
</head>
<body>
<?php
    include("view/php/header.inc.php");

    /*TODO: Agregar solo cuando no ha iniciado sesión el usuario.
    Control mediante sesión*/
    include("view/php/login_interface.inc.php");
    include("view/php/register_interface.inc.php");

    include("view/php/galeria.php");

    include("view/php/footer.inc.php");
?>
</body>

</html>
