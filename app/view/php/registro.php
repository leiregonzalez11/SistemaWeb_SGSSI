<?php
include 'view/php/conexion.php';
$nickname = test_input($_POST["nickname_reg"]);
$nombre = test_input($_POST["nombre_reg"]);
$apellidos = test_input($_POST["apellidos_reg"]);
$dni = test_input($_POST["dni_reg"]);
$email = test_input($_POST["mail_reg"]);
$fechaNac = test_input($_POST["fechaNac_reg"]);
$telefono = test_input($_POST["phone_reg"]);
$clave = test_input($_POST["clave_reg"]);

$insertar = "INSERT INTO Usuario (DNI, Nombre, Apellidos, telefono, FechNac, email, clave, nick) VALUES ('$dni','$nombre','$apellidos','$telefono','$fechaNac','$email','$clave','$nickname')";

$verificar_usuario = mysqli_query ($conexion, "SELECT * FROM Usuario WHERE nick = '$nickname'");
if (mysqli_num_rows($verificar_usuario) > 0){
    echo '<script> 
            alert("El usuario ya esta registrado");
            window.history.go(-1);
          </script>';
    exit;
}

$verificar_correo = mysqli_query ($conexion, "SELECT * FROM Usuario WHERE email = '$email'");
if (mysqli_num_rows($verificar_correo) > 0){
    echo '<script> 
            alert("El correo ya esta registrado");
            window.history.go(-1);
          </script>';
    exit;
}

$resultado = mysqli_query($conexion, $insertar);

if (!$resultado) {
    echo '<script> 
            alert("Error al registrarse");
            window.history.go(-1);
          </script>';
} else{
    echo '<script> 
            alert("Usuario registrado correctamente");
            window.history.go(-1);
         </script>';
}

mysqli_close($conexion);

?>





