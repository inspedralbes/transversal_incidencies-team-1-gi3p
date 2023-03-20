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
            <?php 
                if(!$actuaciones) { ?>
                    <p class="blockquote my-5">No existeix cap actuació amb aquest ID!</p>
                    <?php } else { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Temps</th>
                                <th scope="col">Descripció</th>
                                <th scope="col">Data</th>
                            </tr>  
                        </thead>
                        <?php foreach ($actuaciones as $actuacion) { ?> 
                        <tbody>                                  
                            <tr>                      
                                <td><p><?php echo $actuacion["temps"]?> minuts</p></td>
                                <td><p><?php echo $actuacion["descripcio"]?></p></td>
                                <td><p><?php echo $actuacion["data"] ?></p></td>
                            </tr>
                        </tbody>
                        <?php }}?>
                    </table>
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
                                <form name="actuacio" id="nerModalForm" action="insertar_actuacio.php" method="POST">
                                    <div class="modal-body">
                                    
                                        <p><label for="descripcio">Descripció: </label>
                                        <input type="text" name="descripcio" id="descripcio"></p>

                                        <p id="errDesc"></p>

                                        <p><label for="temps">Temps trigat (m): </label>
                                        <input type="number" name="temps" id="temps"></p>

                                        <p id="errTemps"></p>

                                        <div class="form-check form-switch">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">visible?</label>
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="visible">
                                            
                                        </div>

                                        

                                        <input type="hidden" name="incidencia" value="<?php echo $_GET["id"] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-secondary" onclick="validarLlargada()">Enviar</button>
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
    <script>
        function validarLlargada(){
            
            const desc = document.getElementById('descripcio').value;
            const temps = document.getElementById('temps').value;
            if (desc.length < 20){
                document.getElementById("errDesc").innerHTML = "La descripció ha de tenir com a mínim 20 caràcters";
            } else {
                document.getElementById("errDesc").innerHTML = ""
            }
            if (temps == "") {
                document.getElementById("errTemps").innerHTML = "Introdueix el temps que va trigar l'actuació";
            }else{
                document.getElementById("errTemps").innerHTML = ""
            }
            if (desc.length >= 20 && temps != "") {
                document.actuacio.submit();
            }
        }

    </script>

</body>
</html>