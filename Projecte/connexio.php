<?php

$host = "localhost";
$usuario = "a22arnfergil_gi3pgrup1";
$contrasenia = "InsPedralbes2022";
$base_de_datos = "a22arnfergil_gi3pgrup1";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;
