<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

$login_err4 = "";

$usuari = $_POST["username"];

if(isset($usuari)) {

    $contrasenya = $_POST["password"];
    
    $mysqli = include "connexio.php";

    /*$sentencia = $mysqli->prepare("SELECT contrasenya, permisos FROM USUARI WHERE usuari = ?");
    $sentencia->bind_param("s", $usuari);
    $resultat = $sentencia->execute();*/

    if($resultat = $mysqli->query("SELECT contrasenya, permisos FROM USUARI WHERE usuari = '$usuari'")){
        $comprovarUsuari = $resultat->fetch_assoc();

        
        if(isset($comprovarUsuari)){
            
            $contrasenyaHash = md5($contrasenya, false);
            $contrasenyaBDD = $comprovarUsuari["contrasenya"];

            if($contrasenyaHash === $contrasenyaBDD){
                $permisos = $comprovarUsuari["permisos"];
                $_SESSION["permisos"] = $permisos;
                $_SESSION["nom"] = $usuari;
                $_SESSION["loggedin"] = true;
                
                header("Location: index.php");
            }else{
                $login_err4 = "Contrasenya equivocada";
            }
        }
        else{
            $login_err4 = "Usuari inexistent";
            $usuari = "";
        }
    }
}else{

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
    <title>GI3Pedralbes</title>
</head>
<body class="text-center">
<?php include("header.php")?>
    <main class="form-signin w-100 m-auto my-5">
        <img class="mb-4" src="https://www.iconpacks.net/icons/1/free-user-login-icon-305-thumb.png" alt="" width="110" height="100">
        <h1 class="h3 mb-3 fw-normal">Inici de sessió</h1>
        <h2><?php echo $login_err4 ?></h2>
        <form class="px-4 py-5 my-5 text-center" action="log_in.php" method="POST">
            <div class="col-lg-6 mx-auto">
                <div class="form-floating my-2">
                    <input type="text" name="username" id="floatingInput" class="form-control" placeholder="Usuari" value="<?php echo $usuari?>" required>
                    <label for="floatingInput">Usuari</label>
                    <div class="invalid-feedback">
                        Insereix un usuari
                    </div>
                </div>

                <div class="form-floating my-2">
                    <input type="password" id="floatingPassword" name="password" class="form-control" placeholder="Password" required>
                    <label for="floatingPassword">Contrasenya</label>
                    <div class="invalid-feedback">
                        Insereix una contrasenya
                    </div>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Accedir</button>
            </div>
        </form>
    </main>
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
