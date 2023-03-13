<?php

$mysqli = include_once "connexio.php";

$resultat = $mysqli->query("SELECT idInc, aula, descripcio, DATE(dataIni) as dataIni FROM INCIDENCIA WHERE dataFi IS NULL");
$incidencies = $resultat->fetch_all(MYSQLI_ASSOC);
return $incidencies;
