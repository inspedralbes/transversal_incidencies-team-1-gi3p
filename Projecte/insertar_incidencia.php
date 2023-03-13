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
    <h1>Insertar</h1>

    <form action="insertar_BDD.php" method="POST">
        <div class="aula">
            <h3>aula</h3>
                <select name="aula" id="aula" required>
                    <?php foreach ($departaments as $unDepartament) { ?>
                    <option value="<?php echo $unDepartament["idDept"]?>"><?php echo $unDepartament["nom"] ?></option>
                    <?php } ?>
                </select>
        </div>
        <div class="descripcio">
            <label for="descripcio">Descripció: </label>
            <input placeholder="Escriu la descripció aquí" type="text" name="descripcio" required>
        </div>
        
        <input type="submit" value="Envia" class="submit">
    </form>
    <?php include("footer.php")?>
</body>
</html>