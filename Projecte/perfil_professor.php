<?php session_start(); 
  $nomProfessor = $_SESSION["nom"];
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
  <h1 class="display-5 fw-bold my-4">Benvingut professor (<?php echo $nomProfessor ?>) !!</h1>
    <div class="col-lg-6 mx-auto my-3">
      <img src="https://imgs.search.brave.com/kdBYEtArcxLBS4q0NrMlLIS4HHWmonhMJHCrMEqy4UM/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2Uz/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5p/YVM4U1NJN181STJZ/ak00Skx0NGVBSGFI/YSZwaWQ9QXBp" class="rounded mx-auto d-block my-4" hight="150" width="150">
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="insertar_incidencia.php" class="btn btn-primary btn-lg px-4 mx-3">Insertar incidencia</a>
        <a href="consultar_incidencia.php" class="btn btn-success btn-lg px-4 mx-3">Consultar incidencia</a>
      </div>
    </div>
</div>

<?php include("footer.php")?>
</body>
</html>
