<?php session_start();
  $nomTecnic = $_SESSION["nom"];
?>

<!DOCTYPE html> 
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <?php include("includes.php")?>
    <title>GI3Pedralbes</title>
</head>
<body>
<?php include("header.php");

$mysqli = include_once "connexio.php";
$resultat = $mysqli->query("SELECT idTecn, nom FROM TECNIC WHERE nom = '$nomTecnic'");
$untecnic = $resultat->fetch_assoc();
$idTecnic = $untecnic["idTecn"];
$agafarIncidencies = $mysqli->query("SELECT idInc, descripcio, DEPARTAMENT.nom as aula, prioritat FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDept = INCIDENCIA.aula WHERE tecnic = $idTecnic AND dataFi IS NULL ORDER BY prioritat DESC;");
$incidencies = $agafarIncidencies->fetch_all(MYSQLI_ASSOC);

?>

<div class="px-4 py-5 my-5 text-center">
  <h1 class="display-5 fw-bold py-5">Benvingut Tècnic (<?php echo $untecnic["nom"] ?>)!</h1>
      <img src="https://imgs.search.brave.com/FeeCUGRofhiTx2GyaiG3M7RTzpvpxxrAZW5arlSb39o/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2Ux/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC52/SW5ENmUtRk9EUk5p/QVYwNmIzTE5BSGFI/YSZwaWQ9QXBp" class="rounded mx-auto d-block my-4" hight="150" width="150">
        <div id="<?php echo $untecnic["idTecn"] ?>">
            <div class="col-lg-8 mx-auto text-center container border border-primary-subtle" style="border-collapse: collapse">
                  <div class="row border border-dark py-3">
                    <div class="col"><h5>#</h5></div>
                    <div class="col"><h5>Departament</h5></div>
                    <div class="col-6"><h5>Descripció</h5></div>
                    <div class="col"><h5>Prioritat</h5></div>
                  </div>
                    <?php foreach ($incidencies as $unaIncidencia) { 
                      if ($unaIncidencia["prioritat"] == 1) {
                        ?><a style="text-decoration: none; color: black; " href="gestionar_incidencia_tecnic.php?id=<?php echo $unaIncidencia["idInc"]?>">
                          <div class="row border border-primary-subtle py-3" style="background-color: #d9f99d">
                            <div class="col"><?php echo $unaIncidencia["idInc"] ?></div>
                            <div class="col"><?php echo $unaIncidencia["aula"] ?></div>
                            <div class="col-6"><?php echo $unaIncidencia["descripcio"] ?></div>
                            <div class="col">Baixa</div>
                          </div>
                        </a><?php     
                      } else if ($unaIncidencia["prioritat"] == 2) {
                        ?><a style="text-decoration: none; color: black; " href="gestionar_incidencia_tecnic.php?id=<?php echo $unaIncidencia["idInc"]?>">
                          <div class="row border border-primary-subtle py-3" style="background-color: #fef08a">
                            <div class="col"><?php echo $unaIncidencia["idInc"] ?></div>
                            <div class="col"><?php echo $unaIncidencia["aula"] ?></div>
                            <div class="col-6"><?php echo $unaIncidencia["descripcio"] ?></div>
                            <div class="col">Mitja</div>
                          </div>
                        </a><?php
                      } else if ($unaIncidencia["prioritat"] == 3) {
                        ?><a style="text-decoration: none; color: black" href="gestionar_incidencia_tecnic.php?id=<?php echo $unaIncidencia["idInc"]?>">
                          <div class="row border border-primary-subtle py-3" style="background-color: #fed7aa">
                            <div class="col"><?php echo $unaIncidencia["idInc"] ?></div>
                            <div class="col"><?php echo $unaIncidencia["aula"] ?></div>
                            <div class="col-6"><?php echo $unaIncidencia["descripcio"] ?></div>
                            <div class="col">Alta</div>
                          </div>
                        </a><?php
                      } else if ($unaIncidencia["prioritat"] == 4) {
                        ?><a style="text-decoration: none; color: black" href="gestionar_incidencia_tecnic.php?id=<?php echo $unaIncidencia["idInc"]?>">
                          <div class="row border border-primary-subtle py-3" style="background-color: #fecaca">
                            <div class="col"><?php echo $unaIncidencia["idInc"] ?></div>
                            <div class="col"><?php echo $unaIncidencia["aula"] ?></div>
                            <div class="col-6"><?php echo $unaIncidencia["descripcio"] ?></div>
                            <div class="col">Urgent</div>
                          </div>
                        </a><?php
                      } }?>
            </div>
        </div>
</div>
<?php include("footer.php")?>
</body>
</html>