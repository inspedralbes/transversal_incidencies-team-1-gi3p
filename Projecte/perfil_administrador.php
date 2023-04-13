<?php session_start(); ?>
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
    <h1 class="display-5 fw-bold my-4">Benvingut Administrador!</h1>
    <div class="col-lg-9 mx-auto my-3">
    <img src="https://imgs.search.brave.com/fzTT1bOdJytB6tSgni7ZSQU6WSLUBbMNez_NpVsLNtU/rs:fit:512:512:1/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzL2M3Lzli/L2ExL2M3OWJhMWY0/NzgyZWE4MWQyYjcx/ZmQzMzI1YjA4NTA0/LnBuZw" class="rounded mx-auto d-block my-4" hight="150" width="150">
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="llistat_incidencia_grid.php" class="btn btn-primary btn-lg px-4 mx-3">Llistat incidències</a>
        <a href="informe_tecnics.php" class="btn btn-success btn-lg px-4 mx-3">Informe de tècnics</a>
        <a href="consum_departaments.php" class="btn btn-primary btn-lg px-4 mx-3">Consum per departaments</a>
      </div>
    </div>
</div>

<?php include("footer.php")?>
</body>
</html>