<?php $mysqli = include_once "connexio.php";

$resultat = $mysqli->query("SELECT idDept, nom FROM DEPARTAMENT");
$departaments = $resultat->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <?php include("includes.php")?>
    <title>Insertar incidència</title>
</head>

<body>
<?php include("header.php")?>
    <div class="px-4 py-5 my-5 mx-5 text-center">
        <div class=" col-lg-6 mx-auto">
        <h1 class="display-5 fw-bold">Insertar</h1>
        <form action="insertar_BDD.php" method="POST"  class="row g-3">
            <label>Departament</label>
                <select class="form-select" name="aula" id="aula" required>
                    <option value="">Escull l'aula</option>
                     <?php foreach ($departaments as $unDepartament) { ?>
                     <option value="<?php echo $unDepartament["idDept"]?>"><?php echo $unDepartament["nom"] ?></option>
                     <?php } ?>
                </select>
            <label for="descripcio">Descripció</label>
            <input class="form-control" id="descripcio" placeholder="Escriu la descripció aquí" type="text" name="descripcio" required>
            <input class="btn btn-primary" type="submit" value="Envia">
        </form>
        </div>        
    </div>
<?php include("footer.php")?>
</body>
</html>