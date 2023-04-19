<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesgrid.css">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <title>Gestió incidències</title>
</head>
<body>
    <header>
        <div class="header-title"><a href="/">Gestió Incidències</a></div>
        <div class="header-list">
            <div><a href="log_out.php">Tancar Sessió</a></div>
            <div><a href="index.php">Inici</a></div>
        </div>
    </header>

    <?php 
        $mysqli = include_once "connexio.php";
        $resultat = $mysqli->query("SELECT idInc, DEPARTAMENT.nom as aula, descripcio, DATE(dataIni) as dataIni, prioritat FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.IdDept = INCIDENCIA.aula WHERE dataFi IS NULL ORDER BY prioritat DESC");
        $incidencies = $resultat->fetch_all(MYSQLI_ASSOC);
    ?>

    <div class="llegenda">
        <span><span class="prioritat-urgent">█</span>  Urgent</span>
        <span><span class="prioritat-alta">█</span>  Alta</span>
        <span><span class="prioritat-mitja">█</span>  Mitja</span>
        <span><span class="prioritat-baixa">█</span>  Baixa</span>
    </div>

    <div class="container">
        <div class="titulos">
            <div class="id"><h3>@ID</h3></div>
            <div class="aula"><h3>Dept.</h3></div>
            <div class="descripcion"><h3>Descripció</h3></div>
            <div class="fecha"><h3>Data inici</h3></div>
        </div>
        <div class="cajaIncidencias">
            <?php foreach ($incidencies as $unaIncidencia) { ?>
                <div class="editar">
                <a href="modificar_incidencia.php?id=<?php echo $unaIncidencia["idInc"] ?>">
                    <div class="incidencia prioritat<?php echo $unaIncidencia["prioritat"] ?>">
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
    
    <footer>
        <a href="index.php">Inici</a>
        <a href="insertar_incidencia.php">Insertar Incidència</a>
        <a href="consultar_incidencia.php">Consultar Incidència</a>
    </footer>
</body>
</html>


