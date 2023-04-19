<?php session_start(); ?>

<?php $mysqli = include_once "connexio.php";

$resultat = $mysqli->query("SELECT idDept, nom FROM DEPARTAMENT");
$departaments = $resultat->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ca">
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
        <form action="insertar_BDD.php" method="POST" class="row g-3 needs-validation" novalidate>
            <div>
                <label class="form-label">Departament</label>
                <select class="form-select" name="aula" id="aula" required>
                    <option value="">Escull l'aula</option>
                        <?php foreach ($departaments as $unDepartament) { ?>
                        <option value="<?php echo $unDepartament["idDept"]?>"><?php echo $unDepartament["nom"] ?></option>
                        <?php } ?>
                </select>
                <div class="invalid-feedback">
                    Selecciona una aula.
                </div>
            </div>
            <div>
                <label for="descripcio" class="form-label">Descripció</label>
                <textarea class="form-control" id="descripcio" rows="3" placeholder="Escriu la descripció aquí" name="descripcio" required></textarea>
                <div class="invalid-feedback">
                    Emplena el camp
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Envia">
        </form>
        </div>        
    </div>
<?php include("footer.php")?>

<script>
    (() => {
        let form = document.querySelector(".needs-validation")
        console.log(form)

        form.addEventListener("submit", e => {
            if(!form.checkValidity()) {
                e.preventDefault()
                e.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })()
</script>
</body>
</html>
