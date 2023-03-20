<?php
$mysqli = include_once "connexio.php";
$id = $_GET["id"];
$sentencia = $mysqli->prepare("SELECT idInc, aula, descripcio, dataIni, tecnic, tipologia, prioritat FROM INCIDENCIA WHERE idInc = ?");
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
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <?php include("includes.php")?>
    <title>Modificar incidència</title>
</head>
<body>
<?php include("header.php")?>

<div class="px-4 py-5 my-5 mx-5 text-center">
    <div class=" col-lg-6 mx-auto">
        <h1 class="display-5 fw-bold">Modificar incidència</h1>
        <form action="update.php" method="POST" class="row g-3">
            <input type="hidden" name="id" value="<?php echo $incidencia["idInc"]?>">
            
            <label class="form-label">Departament</label>
            <input type="text" name="aula" id="aula" value="<?php echo $incidencia["aula"]?>" readonly>
            
            <label class="form-label">Descripció</label>
            <input class="form-control" name="desc" type="text" value="<?php echo $incidencia["descripcio"]?>" aria-label="readonly input example" readonly>
        
            <label class="form-label">Tècnic</label>
                <div class="btn-group">
                    <?php foreach ($tecnics as $untecnic) {

                            ?>
                            <input class="btn-check" type="radio" name="tecnic" id="<?php echo $untecnic["nom"]?>" value="<?php echo $untecnic["idTecn"]?>" <?php if($untecnic["idTecn"] == $incidencia["tecnic"]){ echo "checked";}?>>
                            <label class="btn btn-outline-primary" for="<?php echo $untecnic["nom"]?>">
                            <?php echo $untecnic["nom"]?>
                            </label>

                    <?php
                    }?>
                </div>

            <label class="form-label">Prioritat</label>
            <input class="form-range" type="range" name="prioritat" id="prioritat" min="1" max="4" value="<?php echo $incidencia["prioritat"]?>">
            <label class="form-label">Tècnic</label>
                <div class="btn-group">
                    <?php foreach ($tipus as $untipus) {
                        
                            ?>
                            <input class="btn-check" type="radio" name="tipus" id="<?php echo $untipus["nom"]?>" value="<?php echo $untipus["idTipo"]?>" <?php if($untipus["idTipo"] == $incidencia["tipologia"]){ echo "checked";}?>>
                            <label class="btn btn-outline-primary" for="<?php echo $untipus["nom"]?>">
                            <?php echo $untipus["nom"]?>
                            </label>


                    <?php } ?>
                </div>
            <input class="btn btn-primary" type="submit" value="Guardar">
        </form>
    </div>
</div>
<?php include("footer.php")?>
</body>
</html>
