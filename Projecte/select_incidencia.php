<?php

$mysqli = include_once "connexio.php";

$resultat = $mysqli->query("SELECT idInc, DEPARTAMENT.nom as aula, descripcio, DATE(dataIni) as dataIni FROM INCIDENCIA JOIN DEPARTAMENT ON aula = DEPARTAMENT.idDept WHERE dataFi IS NULL ORDER BY idInc ASC");
$incidencies = $resultat->fetch_all(MYSQLI_ASSOC);
return $incidencies;
