<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <?php include("includes.php")?>
    <title>GI3Pedralbes</title>
</head>
    <body>
        <?php
            $mysqli = include "connexio.php";
            if(isset($_GET["id"])) {
                $id = $_GET["id"];
                $sentencia = $mysqli->prepare("SELECT IdInc, descripcio, DATE(dataIni) as dataIni, DEPARTAMENT.nom, tecnic, tipologia, dataFI, prioritat FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.IdDept = INCIDENCIA.aula WHERE idInc = ?");
                $sentencia->bind_param("i", $id);
                $sentencia->execute();
                $resultado = $sentencia->get_result();
                $incidencia = $resultado->fetch_assoc();

                $resultatActuacio = $mysqli->query("SELECT descripcio, DATE(data) as data, temps FROM ACTUACIO WHERE incidencia = $id;
                ");
                $actuacions = $resultatActuacio->fetch_all(MYSQLI_ASSOC);
            }
        ?> 

        <?php include("header.php")?>

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Consultar Incidència</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Busca una incidència per ID</p>
                <form action="" method="GET" onSubmit="checkForm(event)" name="consultar">
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
                        <form action="tancar_incidencia_BBDD.php?id=<?php echo $id ?>" method="POST" id="resultat-incidencia">
                            <div class="card my-5">
                                <div class="card-header bg-success-subtle">
                                    <h3>Descripció:</h3> <?php echo $incidencia["descripcio"]?>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control text-center" value="Departament: <?php echo $incidencia["nom"]?>" disabled >
                                    </div>
                                    <div class="col">
                                        <?php
                                            if($incidencia["prioritat"] == 1) {
                                                ?><input type="text" class="form-control text-center" style="background-color: #d9f99d" value="Prioritat: Baixa" disabled><?php
                                            } else if ($incidencia["prioritat"] == 2) {
                                                ?><input type="text" class="form-control text-center" style="background-color: #fef08a" value="Prioritat: Mitja" disabled><?php
                                            } else if ($incidencia["prioritat"] == 3) {
                                                ?><input type="text" class="form-control text-center" style="background-color: #fed7aa" value="Prioritat: Alta" disabled><?php
                                            } else if ($incidencia["prioritat"] == 4) {
                                                ?><input type="text" class="form-control text-center" style="background-color: #fecaca" value="Prioritat: Urgent" disabled><?php
                                            } else {
                                                ?><input type="text" class="form-control text-center" value="Prioritat: N/A" disabled><?php
                                            }
                                        ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-3 mx-5">
                                        <input type="text" class="form-control text-center" value="Data inici: <?php echo $incidencia["dataIni"]?>" disabled >
                                    </div>
                                </div>
                            </div>
                            <?php
                                if(!$actuacions) { ?>
                                <p class="blockquote my-5">No existeix cap actuació per aquesta incidència!</p>
                                <?php } else { ?>
                                    <h3>Informe d'actuacions</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Temps</th>
                                            <th scope="col">Descripció</th>
                                            <th scope="col">Data</th>
                                        </tr>  
                                    </thead>
                                    <?php foreach ($actuacions as $actuacion) { ?> 
                                    <tbody>                                  
                                        <tr>                      
                                            <td><p><?php echo $actuacion["temps"]?> minuts</p></td>
                                            <td><p><?php echo $actuacion["descripcio"]?></p></td>
                                            <td><p><?php echo $actuacion["data"] ?></p></td>
                                        </tr>
                                    </tbody>
                                    <?php }}}}?>
                                </table>
                        </form>
            </div>
        </div>
        <?php include("footer.php")?>

        <script>
            function checkForm(e) {
                e.preventDefault()

                let value = document.getElementById("floatingInput").value

                if(!isNaN(value)) {
                    document.forms["consultar"].submit()
                } else {
                    document.getElementById("floatingInput").value = 0
                    document.forms["consultar"].submit()
                }
            }
        </script>
    </body>
</html>
