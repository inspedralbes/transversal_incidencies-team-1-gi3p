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

?>

<div class="px-4 py-5 my-5 text-center">
  <h1 class="display-5 fw-bold py-5">Llistat Tècnics</h1>
  <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $untecnic["idTecn"] ?>" aria-expanded="false" aria-controls="collapseOne">
            <?php echo $untecnic["nom"] ?>
          </button>
        </h2>
        <div id="<?php echo $untecnic["idTecn"] ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?php 
                $idTecnic = $untecnic["idTecn"];

                $agafarIncidencies = $mysqli->query("SELECT idInc, descripcio, aula, prioritat FROM INCIDENCIA WHERE tecnic = $idTecnic AND dataFi IS NULL");
                $incidencies = $agafarIncidencies->fetch_all(MYSQLI_ASSOC);

                ?>
                <div class="list-group">
                <?php foreach ($incidencies as $unaIncidencia) { ?>
                    <a href="gestionar_incidencia_tecnic.php?id=<?php echo $unaIncidencia["idInc"]?>" class="list-group-item list-group-item-action " aria-current="true">
                    <?php printf("%s  %s  %d",$unaIncidencia["aula"],$unaIncidencia["descripcio"],$unaIncidencia["prioritat"])?>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>

<?php include("footer.php")?>
</body>
</html>