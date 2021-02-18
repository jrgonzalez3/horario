<?php

setlocale(LC_TIME, 'es_ES.UTF-8');
/*Datos de conexion a la base de datos  */
define('DB_HOST', 'localhost'); //DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'root'); //Usuario de tu base de datos
define('DB_PASS', ''); //Contraseña del usuario de la base de datos
define('DB_NAME', 'horarios'); //Nombre de la base de datos

$con = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_query($con, 'SET NAMES UTF-8');

if (!$con) {
    die('Imposible conectarse!: '.mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die('La Conexión falló: '.mysqli_connect_errno().' : '.mysqli_connect_error());
}
