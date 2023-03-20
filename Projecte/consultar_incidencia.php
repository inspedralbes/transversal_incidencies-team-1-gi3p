<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <?php include("includes.php")?>
    <link rel="stylesheet" href="stylegrid.css">
    <title>GI3Pedralbes</title>
</head>
    <body>
        <?php
            $mysqli = include "connexio.php";
            if(isset($_GET["id"])) {
                $id = $_GET["id"];
                $sentencia = $mysqli->prepare("SELECT * FROM INCIDENCIA WHERE idInc = ?");
                $sentencia->bind_param("i", $id);
                $sentencia->execute();
                $resultado = $sentencia->get_result();
                $incidencia = $resultado->fetch_assoc();

                $resultatActuacio = $mysqli->query("SELECT descripcio, DATE(data) as data, temps FROM ACTUACIO WHERE incidencia = 1 AND visible = 1;
                ");
                $actuacions = $resultatActuacio->fetch_all(MYSQLI_ASSOC);
            }
        ?> 

        <?php include("header.php")?>

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Consultar Incidència</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Busca una incidència per ID</p>
                <form action="" method="GET">
                    <div class="form-floating mb-3">
                        <?php 
                            if(isset($_GET["id"])) { ?>
                                <input type="text" class="form-control" id="floatingInput" placeholder="1" name="id" value="<?php echo $id ?>"> 
                                
                                <?php } else { ?>
                                    <input type="text" class="form-control" id="floatingInput" placeholder="1" name="id">
                                <?php }
                        ?>
                        <label for="floatingInput">Id</label>
                    </div>
                </form>
                <?php 
                if(isset($_GET["id"])) { 
                    if(!$incidencia) { ?>
                        <p class="blockquote my-5">No existeix una incidència amb aquest ID!</p>
                    <?php } else { ?>
                        <form action="tancar_incidencia_BBDD.php?id=<?php echo $id ?>" method="POST">
                            <div class="card my-5">
                                <div class="card-header bg-success-subtle">
                                    <h3>Descripció:</h3> <?php echo $incidencia["descripcio"]?>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control text-center" value="Departament: <?php echo $incidencia["aula"]?>" disabled >
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control text-center" value="Prioritat: <?php echo $incidencia["prioritat"]?>" disabled>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-2 mx-5">
                                        <input type="text" class="form-control text-center" value="Data inici: <?php echo $incidencia["dataIni"]?>" disabled >
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php 
                        if(!$actuacions) { ?>
                                <p class="blockquote my-5">No existeix cap actuacio en aquesta incidència</p>
                                <?php } else { ?>
                        <?php foreach ($actuacions as $actuacion) { ?>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Temps</th>
                                        <th scope="col">Descripció</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><p><?php echo $actuacion["temps"]?> minuts</p></td>
                                        <td><p><?php echo $actuacion["descripcio"]?></p></td>
                                        <td><p><?php echo $actuacion["data"] ?></p></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php include("footer.php")?>
                <?php }}}}?>
            </div>
        </div>
        <?php include("footer.php")?>
    </body>
</html>