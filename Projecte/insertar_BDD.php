<?php
$host = "localhost";
$usuario = "a22arnfergil_arnau";
$contrasenia = "InsPedralbes2022";
$base_de_datos = "a22arnfergil_incidencies";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$aula = $_POST["aula"];
$descripcio = $_POST["descripcio"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA
(aula, descripcio)
VALUES
(?, ?)");
$sentencia->bind_param("ss", $aula, $descripcio);
$sentencia->execute();
header("Location: llistat_incidencia_grid.php");