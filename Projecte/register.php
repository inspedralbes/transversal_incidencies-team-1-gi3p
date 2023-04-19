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
        $_SESSION["idUsu"] = $mysqli->insert_id;

        header("Location: index.php");
        
    }else {
        $err = "Aquest usuari ja existeix";
    }
}
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
<body>
<?php include("header.php")?>

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Crear un compte</h2>
              <h4 class="text-uppercase text-center mb-5"><?php echo $err?></h4>
              <form id="registrar" action="register.php" method="POST">

                <div class="form-outline mb-4">
                  <label class="form-label" for="usuari">Crea el teu nom d'usuari</label>
                  <input type="text" name="usuari" id="usuari" class="form-control form-control-lg" required/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="contrasenya">Afegeix una contrasenya</label>
                  <input type="password" name="contrasenya" id="contrasenya" class="form-control form-control-lg" required />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="confirmarContrasenya">Confirma la contrasenya</label>
                  <input type="password" name="confirmarContrasenya" id="confirmarContrasenya" class="form-control form-control-lg" required/>
                </div>
                <p id="valid"></p>  
                
              </form>

                <div class="d-flex justify-content-center">
                  <button type="button" id="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body-white">Registrar-se</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Ja tens un compte? <a href="log_in.php"
                    class="fw-bold text-body"><u>Accedeix aquí</u></a>
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.php")?>
</body>
<script> 
    function contrasenyaValida() {  
        const contra1 = document.getElementById("contrasenya").value;
        const contra2 = document.getElementById("confirmarContrasenya").value;
        if(document.getElementById("usuari").value.length >= 5){
            if(contra1.length >= 5){
                if(contra1 == contra2) {
                    document.getElementById("registrar").submit();
                }else {
                    document.getElementById("valid").textContent="La contrasenya no coincideix";
                }
            }else {
                document.getElementById("valid").textContent="La contrasenya ha de mesurar com a mínim 5 caràcters";
            }
        }else {
            document.getElementById("valid").textContent="L'usuari i la contrasenya han de mesurar com a mínim 5 caràcters";
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
</html>


