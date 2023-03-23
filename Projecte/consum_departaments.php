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
<?php include("header.php");
$mysqli = include_once "connexio.php";
$resultat = $mysqli->query("SELECT nom, temps, numInc FROM consumDepartaments");
$departaments = $resultat->fetch_all(MYSQLI_ASSOC);
?>

<div class="px-4 py-5 my-5 mx-5 text-center">   
    <h1 class="display-5 fw-bold py-5">Consum per departaments</h1>
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered border-warning my-0">
                <thead>
                    <tr>
                    <th class="table-warning" scope="col">Nom Dept.</th>
                    <th class="table-warning" scope="col">Temps</th>
                    <th class="table-warning" scope="col">Nombre D'incidències</th>
                    </tr>
                </thead>
                <?php foreach ($departaments as $unDepartament) { ?>
                <tbody>
                    <tr>
                    <th scope="row"><?php echo $unDepartament["nom"] ?></th>
                    <td><?php echo $unDepartament["temps"] ?></td>
                    <td><?php echo $unDepartament["numInc"] ?></td>
                    </tr>
                </tbody>
                <?php } ?>
                </table>
            </div>
        </div>
        <div class="my-5">
        <a href="perfil_administrador.php" class="btn btn-outline-primary">Tornar al menú</a>
        </div>
    </div>
</div>

<?php include("footer.php")?>
</body>
</html>