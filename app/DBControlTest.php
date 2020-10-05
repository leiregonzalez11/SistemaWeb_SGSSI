<?php
ini_set("display_erros", "on"); //Muestra errores del parser PHP

/*
Incluimos los modelos y la clase a usar
*/
include ("model/Alojamiento.php");
include ("model/Galeria.php");
include ("model/Reserva.php");
include ("model/Usuario.php");
include ("controller/DBControl.php");

$var=null; //La variable con la que haces las pruebas


var_dump($var); //Devuelve información en formato JSON sobre el objeto. útil para comprobar SELECT
?>