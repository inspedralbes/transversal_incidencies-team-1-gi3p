<?php

$host = "localhost";
$usuario = "a22arnfergil_arnau";
$contrasenia = "InsPedralbes2022";
$base_de_datos = "a22arnfergil_incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;
