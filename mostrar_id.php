<?php
$mysqli = include_once "connexio.php";
$id = $_GET["id"];
$sentencia = $mysqli->prepare("SELECT idInc FROM INCIDENCIA WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();

$incidencia = $resultado->fetch_assoc();
if (!$incidencia) {
    exit("No hay resultados para ese ID");
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes.php")?>
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <title>Gestió incidències</title>
</head>
<body>
<?php include("header.php")?>

<div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold">Incidencia registrada</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">El ID de la teva incidencia és <?php echo $incidencia["idInc"]?></p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="index.php" class="btn btn-primary btn-lg px-4 gap-3">Inici</a>
        <a href="llistat_incidencia_grid.php" class="btn btn-outline-secondary btn-lg px-4">Incidencies</a>
      </div>
    </div>
  </div>

<?php include("footer.php")?>
</body>
</html>