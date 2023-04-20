<?php session_start();
if(isset($_SESSION["permisos"])){
            
    if($_SESSION["permisos"] == 1){
        header("Location: perfil_administrador.php");

    }else if($_SESSION["permisos"] == 2){
        header("Location: llistat_tecnics.php");
    }
}

$mysqli = include "connexio.php";

$sequencia = $mysqli->query("SELECT idDept, nom, incidenciasObertes, incidenciasTotals FROM numIncidenciesPerDepartament");
$resultat = $sequencia->fetch_all(MYSQLI_ASSOC);
?>

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
<body class="h-100">
<?php include("header.php")?>
    <div class="p-5 text-center" style="margin: 3rem 10rem">
        <h1 class="display-5 fw-bold py-3">G1 GI3Pedralbes</h1>
        <h2 class="py-2">Incidències de cada departament</h2>

        <div class="container text-center">
            <div class="row row-col-1 row-cols-md-2 g-4 my-5">
            <?php foreach($resultat as $unDepartament){ ?>
                <div class="card my-2 col-lg-6 mx-auto" style="width: 18rem;padding: 0;">
                    <img src="./imatges/<?php echo $unDepartament['idDept'] ?>.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $unDepartament['nom'] ?></h5>
                        <p class="card-text"><strong><?php echo $unDepartament['incidenciasObertes'] ?></strong> <?php echo ($unDepartament['incidenciasObertes'] == 1)?"oberta":"obertes" ?> de <strong><?php echo $unDepartament['incidenciasTotals'] ?></strong> <?php echo ($unDepartament['incidenciasTotals'] == 1)?"total":"totals" ?> </p>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <?php 
            if (isset($_SESSION['idUsu'])) {
                $professor = $_SESSION['idUsu'];
                $agafarIncidencies = $mysqli->prepare("SELECT idInc, descripcio, DEPARTAMENT.nom as aula, prioritat FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.idDept = INCIDENCIA.aula WHERE professor = ? AND dataFi IS NULL ORDER BY prioritat DESC;"); 
                $agafarIncidencies->bind_param("i", $professor);
                $agafarIncidencies->execute();
    
                $resultat = $agafarIncidencies->get_result();
                $incidencies = $resultat->fetch_all(MYSQLI_ASSOC);?>

                

                <?php if (!empty($incidencies)) {?>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#taulaProfessor" aria-expanded="false" aria-controls="collapseOne">
                            <h4><?php echo "Les meves incidències" ?></h4>
                        </button>
                        </h2>
                        <div id="taulaProfessor" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="list-group">
                                    <div class="row my-2">
                                        <div class="col"><strong>#</strong></div>
                                        <div class="col"><strong>Departament</strong></div>
                                        <div class="col"><strong>Descripció</strong></div>   
                                        <div class="col"><strong>Prioritat</strong></div>        
                                    </div>
                                    
                                    <?php
                                    foreach ($incidencies as $unaIncidencia) { 
                                        ?>
                                        <a style="text-decoration: none; color: black; " href="consultar_incidencia.php?id=<?php echo $unaIncidencia["idInc"]?>">
                                            <div class="row my-2">
                                                <div class="col"><p class="my-4"><?php echo $unaIncidencia["idInc"] ?></p></div>
                                                <div class="col"><p class="my-4"><?php echo $unaIncidencia["aula"] ?></p></div>
                                                <div class="col"><p class="my-4"><?php echo $unaIncidencia["descripcio"] ?></p></div>

                                                <?php
                                                if(empty($unaIncidencia["prioritat"])){
                                                    ?><div class="col"><p class="my-4">No assignat</p></div><?php
                                                } 
                                                if ($unaIncidencia["prioritat"] == 1) {
                                                    ?><div class="col" style="background-color: #d9f99d"><p class="my-4">Baixa</p></div><?php
                                                } else if ($unaIncidencia["prioritat"] == 2) {
                                                    ?><div class="col" style="background-color: #fef08a"><p class="my-4">Mitja</p></div><?php
                                                } else if ($unaIncidencia["prioritat"] == 3) {
                                                    ?><div class="col" style="background-color: #fed7aa"><p class="my-4">Alta</p></div><?php
                                                } else if ($unaIncidencia["prioritat"] == 4) {
                                                    ?><div class="col" style="background-color: #fecaca"><p class="my-4">Urgent</p></div><?php
                                                } ?>
                                            </div>
                                        </a><?php     
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div> 
                    <?php
                } else {
                    echo "<h2>No tens cap incidència oberta!</h2>";
                }  ?>
            
                <?php          
            }
        ?>
        <div class="px-4 py-5 my-5 mx-5 text-center">
            <a href="insertar_incidencia.php" class="btn btn-primary btn-lg px-4 mx-2 my-2">Insertar incidència</a>
            <a href="consultar_incidencia.php" class="btn btn-primary btn-lg px-4 mx-2 my-2">Consultar incidencia per ID</a>
        </div>
    </div>
<?php include("footer.php")?>
</body>
</html>
