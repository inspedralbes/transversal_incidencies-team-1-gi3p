<?php session_start(); ?>
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
$resultat = $mysqli->query("SELECT idTecn, nom FROM TECNIC;");
$tecnics = $resultat->fetch_all(MYSQLI_ASSOC);

?>

<div class="px-4 py-5 my-5 text-center">
  <h1 class="display-5 fw-bold py-5">Informe de Tècnics</h1>
  <div class="accordion" id="accordionExample">
    <?php foreach ($tecnics as $untecnic) { ?>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $untecnic["idTecn"] ?>" aria-expanded="false" aria-controls="collapseOne">
            <?php echo $untecnic["nom"] ?>
          </button>
        </h2>
            <?php
                $nomtecnic = $untecnic["nom"];
                $agafarIncidencies = $mysqli->query("SELECT nom, descripcio, prioritat, DATA, temps FROM informeTecnics WHERE nom = '$nomtecnic'");
                $incidencies = $agafarIncidencies->fetch_all(MYSQLI_ASSOC);
            ?>
        <div id="<?php echo $untecnic["idTecn"] ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="list-group">
                    <div class="row my-2">
                        <div class="col"><strong>Descripció</strong></div>
                        <div class="col"><strong>Prioritat</strong></div>
                        <div class="col"><strong>Data</strong></div>   
                        <div class="col"><strong>Temps</strong></div>        
                      </div>
                <?php foreach ($incidencies as $unaIncidencia) { ?>
                      <div class="row my-2">
                        <div class="col my-4"><?php echo $unaIncidencia["descripcio"]?></div>
                        <?php if ($unaIncidencia["prioritat"] == 1) {
                            ?><div class="col" style="background-color: #d9f99d"><p class="my-4">Baixa</p></div><?php
                        } else if ($unaIncidencia["prioritat"] == 2) {
                            ?><div class="col" style="background-color: #fef08a"><p class="my-4">Mitja</p></div><?php
                        } else if ($unaIncidencia["prioritat"] == 3) {
                            ?><div class="col" style="background-color: #fed7aa"><p class="my-4">Alta</p></div><?php
                        } else if ($unaIncidencia["prioritat"] == 4) {
                            ?><div class="col" style="background-color: #fecaca"><p class="my-4">Urgent</p></div><?php
                        } ?>
                        <div class="col my-4"><?php echo $unaIncidencia["DATA"]?></div>   
                        <div class="col my-4"><?php 
                          if(!$unaIncidencia["temps"]) {
                            echo 0;
                          } else {
                            echo $unaIncidencia["temps"];
                          }
                        ?></div>        
                      </div>
                    <?php } ?>
                </div>
            </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="my-5">
        <a href="perfil_administrador.php" class="btn btn-outline-primary">Tornar al menú</a>
  </div>
</div>

<?php include("footer.php")?>
</body>
</html>