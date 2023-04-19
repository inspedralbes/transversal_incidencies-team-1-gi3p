<?php
$mysqli = include_once "connexio.php";
$id = $_POST["id"];
$tecnic = $_POST["tecnic"];
$prioritat = $_POST["prioritat"];
$tipus = $_POST["tipus"];

$sentencia = $mysqli->prepare("UPDATE INCIDENCIA SET
tecnic = ?,
tipologia = ?,
prioritat = ?
WHERE idInc = ?");
$sentencia->bind_param("iiii", $tecnic, $tipus, $prioritat, $id);
$sentencia->execute();
header("Location: llistat_incidencia_grid.php");