<?php

$conexion = mysqli_connect("localhost","root","","database");
if (!conexion){
    echo 'Error al conectarse a la base de datos';
}
else{
    echo 'Conectado a la base de datos';
}
?>