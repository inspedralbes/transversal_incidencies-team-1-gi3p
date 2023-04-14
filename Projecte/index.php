<?php session_start();
if(isset($_SESSION["permisos"])){
            
    if($_SESSION["permisos"] == 1){
        header("Location: perfil_administrador.php");

    }else if($_SESSION["permisos"] == 2){
        header("Location: llistat_tecnics.php");
        
    }else if($_SESSION["permisos"] == 3){
        header("Location: perfil_professor.php");
    }
}

$mysqli = include "connexio.php";

$sequencia = $mysqli->query("SELECT idDept, nom, incidenciasObertes, incidenciasTotals FROM numIncidenciesPerDepartament");
$resultat = $sequencia->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
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
        <h1 class="display-5 fw-bold py-5">G1 GI3Pedralbes</h1>
        <h2>Incidències de cada departament</h2>

        <div class="container text-center">
            <div class="row row-col-1 row-cols-md-2 g-4 my-5">
            <?php foreach($resultat as $unDepartament){ ?>
                <div class="card my-2 col-lg-6 mx-auto" style="width: 18rem;padding: 0;">
                    <img src="./imatges/<?php echo $unDepartament['idDept'] ?>.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $unDepartament['nom'] ?></h5>
                        <p class="card-text"><?php echo $unDepartament['incidenciasObertes'] ?>/<?php echo $unDepartament['incidenciasTotals'] ?></p>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <a href="insertar_incidencia.php" class="btn btn-primary btn-lg px-4 mx-2 my-2">Insertar incidència</a>
        <a href="consultar_incidencia.php" class="btn btn-primary btn-lg px-4 mx-2 my-2">Consultar incidencia per ID</a>
    </div>
<?php include("footer.php")?>
</body>
</html>
