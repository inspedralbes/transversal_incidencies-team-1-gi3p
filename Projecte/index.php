<?php session_start();
 if(isset($_SESSION["permisos"])){
            
    if($_SESSION["permisos"] == 1){
        header("Location: perfil_administrador.php");

    }else if($_SESSION["permisos"] == 2){
        header("Location: llistat_tecnics.php");
        
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
    <title>GI3Pedralbes</title>
</head>
<body class="h-100">
<?php include("header.php")?>
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold py-5">G1 GI3Pedralbes</h1>
       
        <a href="insertar_incidencia.php" class="btn btn-primary btn-lg px-4">Insertar incidència</a>
        <a href="consultar_incidencia.php" class="btn btn-primary btn-lg px-4">Consultar incidencia per ID</a>
        <a href="log_out.php" class="btn btn-primary btn-lg px-4">Log out</a>
    </div>
<?php include("footer.php")?>
</body>
</html>