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

$agafarIncidencies = $mysqli->query("SELECT idInc, descripcio, aula, prioritat FROM INCIDENCIA WHERE tecnic = $idTecnic AND dataFi IS NULL");
$incidencies = $agafarIncidencies->fetch_all(MYSQLI_ASSOC);

?>

<div class="px-4 py-5 my-5 text-center">
  <h1 class="display-5 fw-bold py-5">Benvingut Tècnic (<?php echo $untecnic["nom"] ?>)!</h1>
        </h2>
        <div id="<?php echo $untecnic["idTecn"] ?>">
            <div class="col-lg-8 mx-auto text-center">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Departamnet</th>
                      <th scope="col">Descripció</th>
                      <th scope="col">Prioritat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($incidencies as $unaIncidencia) { ?>            
                      <a href="gestionar_incidencia_tecnic.php?id=<?php echo $unaIncidencia["idInc"]?>">
                        <tr>
                          <th scope="row"><?php echo $unaIncidencia["idInc"] ?></th>
                          <td><?php echo $unaIncidencia["aula"] ?></td>
                          <td><?php echo $unaIncidencia["descripcio"] ?></td>
                          <td><?php echo $unaIncidencia["prioritat"] ?></td>
                        </tr>
                      </a>
                    <?php } ?>
                  </tbody>
              </table>
            </div>
        </div>
</div>

<?php include("footer.php")?>
</body>
</html>