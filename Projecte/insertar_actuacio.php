<?php $mysqli = include "connexio.php";

$descripcio = $_POST["descripcio"];
$temps = $_POST["temps"];
$incidencia = $_POST["incidencia"];
if(isset($_POST["visible"])){
    $visible = 1;
} else {
    $visible = 0;
}

$sentencia = $mysqli->prepare("INSERT INTO ACTUACIO
(descripcio, temps, visible, incidencia)
VALUES
(?, ?, ?, ?)");
$sentencia->bind_param("siii", $descripcio, $temps, $visible, $incidencia);
$sentencia->execute();

header("Location: llistat_tecnics.php");