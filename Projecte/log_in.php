<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

$login_err = "";

if(isset($_POST["username"])) {
    $usuari = $_POST["username"];
    $contrasenya = $_POST["password"];    
    $mysqli = include "connexio.php";

    /*$sentencia = $mysqli->prepare("SELECT contrasenya, permisos FROM USUARI WHERE usuari = ?");
    $sentencia->bind_param("s", $usuari);
    $resultat = $sentencia->execute();*/

    if($resultat = $mysqli->query("SELECT contrasenya, permisos, idUsu FROM USUARI WHERE usuari = '$usuari'")){
        $comprovarUsuari = $resultat->fetch_assoc();
        
        if(isset($comprovarUsuari)){
            
            $contrasenyaHash = md5($contrasenya, false);
            $contrasenyaBDD = $comprovarUsuari["contrasenya"];

            if($contrasenyaHash === $contrasenyaBDD){
                $permisos = $comprovarUsuari["permisos"];
                $_SESSION["permisos"] = $permisos;
                $_SESSION["nom"] = $usuari;
                $_SESSION["loggedin"] = true;
                $_SESSION["idUsu"] = $comprovarUsuari["idUsu"];                
                header("Location: index.php");
            }else{
                $login_err = "Usuari o contrasenya equivocats";
            }
        }
        else{
            $login_err = "Usuari inexistent";
            $usuari = "";
        }
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
<body class="text-center">
<?php include("header.php")?>

<section class="vh-100">
  <div class="px-4 py-5 my-5 mx-5 text-center">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form class="px-4 py-5 mb-5 text-center needs-validation" action="log_in.php" method="POST" novalidate>      

            <div class="divider d-flex align-items-center my-4">
              <h4 class="text-danger"><?php echo $login_err ?></h4>
              <h2 class="text-center fw-bold mx-3 mb-5">Iniciar Sessió</h2>
            </div>

            <!-- User input -->
            <div class="form-outline mb-4">
              <input type="text" name="username" id="form3Example3" class="form-control form-control-lg"
                placeholder="Afegeix el teu usuari" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                placeholder="Afegeix la contrasenya" />
              <div class="invalid-feedback"> Insereix una contrasenya </div>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Iniciar Sessió</button>
              <p class="small fw-bold mt-4 pt-1 mb-0">Encara no tens compte? <a href="register.php"
                  class="link-danger">Registrar-se</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("footer.php")?>
</body>
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
</html>
