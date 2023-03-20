<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes.php")?>
    <title>GI3Pedralbes PHP</title>
</head>
<body>
    <?php
        $mysqli = include "connexio.php";
        if(isset($_GET["id"])) {
            $id = $_GET["id"];
            $sentencia = $mysqli->prepare("SELECT idInc, aula, descripcio, dataIni, tipologia, prioritat FROM INCIDENCIA WHERE idInc = ?");
            $sentencia->bind_param("i", $id);
            $sentencia->execute();
            $resultado = $sentencia->get_result();
            $incidencia = $resultado->fetch_assoc();

            $resultadoAct = $mysqli->query("SELECT idAct, descripcio, DATE(data) as data, temps FROM ACTUACIO WHERE incidencia = $id");
            $actuaciones = $resultadoAct->fetch_all(MYSQLI_ASSOC);
        }
    ?> 
    <?php include("header.php")?>

    <div class="px-4 py-5 my-5 text-center">
        <div class="col-lg-6 mx-auto">
            <?php 
            if(isset($_GET["id"])) { ?>

            <form>
                <div class="card my-5">
                    <div class="card-header bg-success-subtle">
                        <h3>Registre d'actuacions </h3>
                    </div>
                    <div class="card-body">
                    <div class="row my-3">
                        <div class="col">
                            <input type="text" class="form-control text-center" value="Identificador: <?php echo $incidencia["idInc"]?>" disabled >
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" value="Departament: <?php echo $incidencia["aula"]?>" disabled >
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <input type="text" class="form-control text-center" value="Prioritat: <?php echo $incidencia["prioritat"]?>" disabled>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" value="Tipologia: <?php echo $incidencia["tipologia"]?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col my-2 mx-5">
                            <input type="text" class="form-control text-center" value="Descripció: <?php echo $incidencia["descripcio"]?>" disabled >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col my-2 mx-5">
                            <input type="text" class="form-control text-center" value="Data inici: <?php echo $incidencia["dataIni"]?>" disabled >
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
            <div class="accordion mb-4">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#actuacions" aria-expanded="false" aria-controls="collapseOne">
                                Actuacions
                            </button>
                        </h2>
                        <div id="actuacions" class="accordion-collapse collapse" aria-labelledby="headingOne">
                            <div class="accordion-body">
                                <?php foreach ($actuaciones as $actuacion) { ?>
                                    <div class="card text-center mb-3">
                                        <div class="card-header">
                                            Temps: <?php echo $actuacion["temps"]?> minuts
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $actuacion["descripcio"]?></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <?php echo $actuacion["data"]?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="tancar_incidencia_BBDD.php?id=<?php echo $id ?>" method="POST" >
                            <button type="submit" class="btn btn-success">Tancar Incidència</button>
                        </form>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Registrar actuació
                        </button>
                    </div>
                </div>
            <?php } 
            ?>
        </div>
    </div>

    <?php include("footer.php")?>
</body>
</html>