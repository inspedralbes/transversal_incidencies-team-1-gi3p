<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes.php")?>
    <link rel="stylesheet" href="stylesgrid.css">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <title>Gestió incidències</title>
</head>
<body>
<?php include("header.php")?>

    <?php $incidencies = include_once "select_incidencia.php"; ?>

    <div class="container">
        <div class="titulos">
            <div class="id"><h3>@ID</h3></div>
            <div class="aula"><h3>Aula</h3></div>
            <div class="descripcion"><h3>Descripció</h3></div>
            <div class="fecha"><h3>Data inici</h3></div>
        </div>
        <div class="cajaIncidencias">
            <?php foreach ($incidencies as $unaIncidencia) { ?>
                <div class="editar">
                <a href="modificar_incidencia.php?id=<?php echo $unaIncidencia["idInc"] ?>">
                    <div class="incidencia">
                        <div class="id"><p><?php echo $unaIncidencia["idInc"] ?></p></div>
                        <div class="aula"><p><?php echo $unaIncidencia["aula"] ?></p></div>
                        <div class="descripcion"><p><?php echo $unaIncidencia["descripcio"] ?></p></div>
                        <div class="fecha"><p><?php echo $unaIncidencia["dataIni"] ?></p></div>
                    </div>
                </a>
                </div>
            <?php } ?>                            
        </div>
    </div>
<?php include("footer.php")?>
</body>
</html>


