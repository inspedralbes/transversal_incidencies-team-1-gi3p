<?php
$mysqli = include_once "connexio.php";
$id = $_GET["id"];
$sentencia = $mysqli->prepare("SELECT idInc, DEPARTAMENT.nom, descripcio, dataIni, tecnic, tipologia, prioritat FROM INCIDENCIA JOIN DEPARTAMENT ON DEPARTAMENT.IdDept = INCIDENCIA.aula WHERE idInc = ?");
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

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
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
        <h1 class="display-5 fw-bold my-4">Modificar incidència</h1>
        <form action="update.php" method="POST" class="row g-3">
            <input type="hidden" name="id" value="<?php echo $incidencia["idInc"]?>">

            <div class="row mx-auto my-4">
                <span class="col mx-1 input-group-text bg-success-subtle" name="aula" id="aula" value="<?php echo $incidencia["nom"]?>"> <strong>Departament: &#160;</strong><?php echo $incidencia["nom"]?></span>
                <span class="col mx-1 input-group-text bg-success-subtle" name="desc" id="desc" value="<?php echo $incidencia["descripcio"]?>"> <strong>Descripció: &#160;</strong><?php echo $incidencia["descripcio"]?></span>
            </div>
            
            <label class="form-label">Tècnic</label>
            <div class="btn-group">
                <?php foreach ($tecnics as $untecnic) {
                        ?>
                        <input class="btn-check" type="radio" name="tecnic" id="<?php echo $untecnic["nom"]?>" value="<?php echo $untecnic["idTecn"]?>" <?php if($untecnic["idTecn"] == $incidencia["tecnic"]){ echo "checked";}?> required>
                        <label class="btn btn-outline-primary" for="<?php echo $untecnic["nom"]?>">
                        <?php echo $untecnic["nom"]?>
                        </label>
                <?php
                }?>
            </div>

            <div>
                <label class="form-label">Prioritat: <span id="valorPrioritat"></span></label>
                <input class="form-range" type="range" name="prioritat" id="prioritat" min="1" max="4" value="<?php if(isset($incidencia["prioritat"])) { echo $incidencia["prioritat"]; }else { echo "0";}?>" onchange="mostrarPrioritat(this.value)" oninput="mostrarPrioritat(this.value)" required>
            </div>
           
            <label class="form-label">Tipologia</label>
                <div class="btn-group">
                    <?php foreach ($tipus as $untipus) {
                            ?>
                            <input class="btn-check" type="radio" name="tipus" id="<?php echo $untipus["nom"]?>" value="<?php echo $untipus["idTipo"]?>" <?php if($untipus["idTipo"] == $incidencia["tipologia"]){ echo "checked";}?> required>
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

<script>
    let range = document.getElementById("valorPrioritat")
    let valor = document.getElementById("prioritat")
    range.innerHTML = valor.value;

    function mostrarPrioritat(valor) {
        range.innerHTML = valor;
    }
    
    
</script>

</body>
</html>