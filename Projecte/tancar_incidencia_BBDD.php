<?php

$mysqli = include_once "connexio.php";
$id = $_GET["id"];
$sentencia = $mysqli->prepare("UPDATE INCIDENCIA SET dataFi=NOW() WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
header("Location: llistat_tecnics.php");

?>