<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <?php include("includes.php")?>
    <title>GI3Pedralbes</title>
</head>
<body>
    <?php
        $mysqli = include "connexio.php";
        if(isset($_GET["id"])) {
            $id = $_GET["id"];
            $sentencia = $mysqli->prepare("SELECT idInc, DEPARTAMENT.nom, descripcio, DATE(dataIni) as dataIni, TIPOLOGIA.nom as tipologia, prioritat FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.IdDept = INCIDENCIA.aula JOIN TIPOLOGIA ON TIPOLOGIA.idTipo = INCIDENCIA.tipologia WHERE idInc = ?");

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
                        <h3>Informe d'incidència </h3>
                    </div>
                    <div class="card-body">
                    <div class="row my-3">
                        <div class="col">
                            <input type="text" class="form-control text-center" value="Identificador: <?php echo $incidencia["idInc"]?>" disabled >
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" value="Departament: <?php echo $incidencia["nom"]?>" disabled >
                        </div>
                    </div>
                    <div class="row my-3">
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
                        <h3>Informe d'actuacions</h3>
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
                        <form action="tancar_incidencia_BBDD.php?id=<?php echo $id ?>" method="POST" id="borrar">
                            <button type="button" class="btn btn-success" onclick="alertaTancar()">Tancar Incidència</button>
                        </form>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actuacioModal">
                            Registrar actuació
                        </button>
                    </div>
                    <div class="modal fade" id="actuacioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Registrar actuació</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form name="actuacio" id="nerModalForm" action="insertar_actuacio.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-floating mb-1">
                                            <input type="text" name="descripcio" id="descripcio" class="form-control" placeholder="Descripcio">
                                            <label for="descripcio">Descripció</label>
                                        </div>
                                        <p id="errDesc" style="text-align: start" class="text-danger"></p>
                                        <div class="form-floating mb-1">
                                            <input type="number" name="temps" id="temps" class="form-control" placeholder="15">
                                            <label for="temps">Temps trigat (min)</label>
                                        </div>
                                        <p id="errTemps" style="text-align: start" class="text-danger"></p>
                                        <div class="form-check form-switch" style="margin: 0 120px">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="visible" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Visibilitat per a externs</label>
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
            <?php } 
            ?>
        </div>
    </div>

    <?php include("footer.php")?>
    <script>
        function validarLlargada(){
            
            const desc = document.getElementById('descripcio');
            const temps = document.getElementById('temps');
            let errorDesc = document.getElementById("errDesc"); 
            let errorTemps = document.getElementById("errTemps"); 

            if (desc.value.length < 20){
                desc.classList.add("is-invalid")
                errorDesc.innerHTML = "La descripció ha de tenir com a mínim 20 caràcters";
            } else {
                desc.classList.remove("is-invalid")
                desc.classList.add("is-valid")
                errorDesc.innerHTML = ""
            }

            if (temps.value == "" || parseInt(temps.value) <= 0) {
                temps.classList.add("is-invalid")
                errorTemps.innerHTML = "Introdueix el temps que va trigar l'actuació";
            }else{
                temps.classList.remove("is-invalid")
                temps.classList.add("is-valid")
                errorTemps.innerHTML = ""
            }
            if (desc.value.length >= 20 && temps.value != "" && parseInt(temps.value) > 0) {
                document.actuacio.submit();
            }
        } 
        
        function alertaTancar(){
                Swal.fire({
                    title: 'Segur/a que vols tancar-la?',
                    text: "No ho pots revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elimina-ho!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("borrar").submit();
                    }
                })
        }
    </script>

</body>
</html>
