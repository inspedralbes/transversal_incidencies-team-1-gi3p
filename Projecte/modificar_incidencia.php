<?php
$mysqli = include_once "connexio.php";
$id = $_GET["id"];
$sentencia = $mysqli->prepare("SELECT idInc, aula, descripcio, dataIni FROM INCIDENCIA WHERE idInc = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();

$incidencia = $resultado->fetch_assoc();
if (!$incidencia) {
    exit("No hay resultados para ese ID");
}

$resultatTecnic = $mysqli->query("SELECT idTecn, nom FROM TECNIC");
$tecnics = $resultatTecnic->fetch_all(MYSQLI_ASSOC);

$resultatTipus = $mysqli->query("SELECT idTipo, nom FROM TIPOLOGIA");
$tipus = $resultatTipus->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes.php")?>
    <title>Modificar incidència</title>
</head>
<body>
<?php include("header.php")?>
    <h1>Modificar incidència</h1>

    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $incidencia["idInc"]?>">
        <div class="aula">
            <h3>Aula</h3>
            <input type="text" name="aula" id="aula" value="<?php echo $incidencia["aula"]?>" readonly>
        </div>
        <div class="descripcio">
            <h3>Descripció</h3>
            <textarea name="desc" id="desc" cols="30" rows="10" readonly><?php echo $incidencia["descripcio"]?></textarea>
        </div>
        <div class="tecnic">
            <h3>Tècnic</h3>
            <?php foreach ($tecnics as $untecnic) {?>
            <p><input type="radio" name="tecnic" id="<?php echo $untecnic["nom"]?>" value="<?php echo $untecnic["idTecn"]?>"><label for="<?php echo $untecnic["nom"]?>"><?php echo $untecnic["nom"]?></label></p>
            <?php } ?>

        </div>
        
        <div class="prioritat">
            <h3>Prioritat</h3>
            <input type="range" name="prioritat" id="prioritat" min="1" max="4" value="1">
        </div>

        <div class="tipus">
            <label for="tipus"><h3>Tipus: </h3></label>
                <select name="tipus" id="tipus">
                <?php foreach ($tipus as $untipus) {?>
                    <option value="<?php echo $untipus["idTipo"]?>"><?php echo $untipus["nom"]?></option>
                    <?php } ?>
                </select>
        </div>
        <input type="submit" value="Guardar">
    </form>
    <?php include("footer.php")?>
</body>
</html>