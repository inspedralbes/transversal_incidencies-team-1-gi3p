<?php
$mysqli = include "connexio.php";
session_start();
$aula = $_POST["aula"];
$descripcio = $_POST["descripcio"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA (aula, descripcio, professor) VALUES (?, ?, ?)");
$sentencia->bind_param("ssi", $aula, $descripcio, $_SESSION["idUsu"]);
$sentencia->execute();
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
    <img class="d-block mx-auto mb-4" src="https://img.freepik.com/vector-premium/actualizar-icono-sistema-proceso-carga-actualizar-software-o-icono-progreso-aplicacion-vector-sobre-fondo-blanco-aislado-eps-10_399089-2838.jpg?w=2000" alt="" width="150" height="140">
    <h1 class="display-5 fw-bold">Incidencia registrada</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4"><?php printf("La teva ID és %d", $mysqli->insert_id)?></p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="index.php" class="btn btn-primary btn-lg px-4">Inici</a>
      </div>
    </div>
  </div>

<?php include("footer.php")?>
</body>
</html>