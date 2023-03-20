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
        <h1 class="display-5 fw-bold">Gestionar Incidència Tècnic</h1>
        <div class="col-lg-6 mx-auto">
            <?php 
            if(isset($_GET["id"])) { ?>
                <div class="mb-3">
                    <label for="floatingInput" class="form-label">Identificador</label>
                    <input type="text" class="form-control rounded-3" id="floatingInput" disabled value="<?php echo $incidencia["idInc"]?>">
                </div>
                <div class="mb-3">
                    <label for="floatingInput" class="form-label">Prioritat</label>
                    <input type="text" class="form-control rounded-3" id="floatingInput" disabled value="<?php echo $incidencia["prioritat"]?>">
                </div>
                <div class="mb-3">
                    <label for="floatingInput" class="form-label">Departament</label>
                    <input type="text" class="form-control rounded-3" id="floatingInput" disabled value="<?php echo $incidencia["aula"]?>">
                </div>
                <div class="mb-3">
                    <label for="floatingInput" class="form-label">Descripció</label>
                    <textarea type="text" class="form-control rounded-3" id="floatingInput" rows="6" disabled><?php echo $incidencia["descripcio"]?></textarea>
                </div>
                <div class="mb-3">
                    <label for="floatingInput" class="form-label">Data creació</label>
                    <input type="text" class="form-control rounded-3" id="floatingInput" disabled value="<?php echo $incidencia["dataIni"]?>">
                </div>
                <div class="mb-3">
                    <label for="floatingInput" class="form-label">Tipologia</label>
                    <input type="text" class="form-control rounded-3" id="floatingInput" disabled value="<?php echo $incidencia["tipologia"]?>">
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actuacioModal">
                            Registrar actuació
                        </button>

                        <div class="modal fade" id="actuacioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar actuació</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="insertar_actuacio.php" method="POST">
                                    <div class="modal-body">
                                    
                                        <p><label for="descripcio">Descripció: </label>
                                        <input type="text" name="descripcio" id="descripcio"></p>

                                        <p><label for="temps">Temps trigat (m): </label>
                                        <input type="number" name="temps" id="temps"></p>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="visible">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                                        </div>

                                        <input type="hidden" name="incidencia" value="<?php echo $_GET["id"] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="Enviar" class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } 
            ?>
        </div>
    </div>

    <?php include("footer.php")?>
</body>
</html>