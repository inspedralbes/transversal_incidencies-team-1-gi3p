<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="llistat_incidencia_grid.css">
    <title>LlistatGrid</title>
</head>
<body>
    <header>
        <h1>
            <span>I</span>NCIDÈNCIES
        </h1>
    </header>
    <h2><a href="index.php">Index</a></h2>

    <?php $incidencies = include_once "select_incidencia.php"; ?>

    <div class="llistat">
        <div class="capçal">
            <div class="identificador"><p>ID</p></div>
            <div class="aula"><p>Aula</p></div>
            <div class="descripcio"><p>Descripció</p></div>
            <div class="inici"><p>Data Inici</p></div>
        </div>
        <div class="incidencies">
            <?php foreach ($incidencies as $unaIncidencia) { ?>
                <a href="modificar_incidencia.php?id=<?php echo $unaIncidencia["idInc"] ?>">
                    <div class="incidencia">
                        <div class="identificador"><p><?php echo $unaIncidencia["idInc"] ?></p></div>
                        <div class="aula"><p><?php echo $unaIncidencia["aula"] ?></p></div>
                        <div class="descripcio"><p><?php echo $unaIncidencia["descripcio"] ?></p></div>
                        <div class="inici"><p><?php echo $unaIncidencia["dataIni"] ?></p></div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</body>
</html>