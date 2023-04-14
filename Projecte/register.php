<?php session_start();?>
<?php
$err = "";
if(isset($_POST["usuari"])){
    $usuari = $_POST["usuari"];



    $mysqli = include "connexio.php";
    $sentencia = $mysqli->prepare("SELECT contrasenya, permisos FROM USUARI WHERE usuari = ?");
    $sentencia->bind_param("s", $usuari);
    $sentencia->execute();
    
    $resultat = $sentencia->get_result();
    $comprovarUsuari = $resultat->fetch_assoc();
    if(is_null($comprovarUsuari)){
        $sentencia2 = $mysqli->prepare("INSERT INTO USUARI (usuari, contrasenya, permisos) VALUES (?,?,3)");
        $sentencia2->bind_param("ss", $usuari, $contrasenya);

        $contrasenya = md5($_POST["contrasenya"],false);

        $sentencia2->execute();

        $_SESSION["permisos"] = 3;
        $_SESSION["nom"] = $usuari;

        header("Location: index.php");
        
    }else {
        $err = "Aquest usuari ja existeix";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="insti icon" href="https://www.institutpedralbes.cat/wp-content/uploads/2021/05/logo.jpg">
    <?php include("includes.php")?>
    <title>Document</title>
    <form action=""></form>
</head>
<body>

<?php include("header.php")?>
    <h1>Registrar-se</h1>
    <h2><?php echo $err?></h2>
    <div class="px-4 py-5 mb-5 text-center">
        <form id="registrar" action="register.php" method="POST">
            <p>Usuari</p>
            <input type="text" name="usuari" id="usuari" required>
            <p>Contrasenya</p>
            <input type="password" name="contrasenya" id="contrasenya" required>
            <p>Confirmar contrasenya</p>
            <input type="password" name="confirmarContrasenya" id="confirmarContrasenya" required>
            <p id="valid"></p>       
        </form>
    </div>
    <div class="px-4 mb-5 text-center">
        <button type="button" id="submit" class="btn btn-primary">Enviar</button>
    </div>
</body>
</html>

<script> 
function contrasenyaValida() {
  
    const contra1 = document.getElementById("contrasenya").value;
    const contra2 = document.getElementById("confirmarContrasenya").value;

    if(contra1 == contra2) {
        document.getElementById("registrar").submit();
    }else {
        document.getElementById("valid").textContent="La contrasenya no coincideix";
    }
    
}

const submit = document.getElementById("submit");

submit.addEventListener(
    "click",
    function () {
        contrasenyaValida();
    },
    false);

</script>