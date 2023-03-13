<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes.php")?>
    <title>GI3Pedralbes PHP</title>
</head>
<body>
    <?php
        $mysqli = include "connexio.php";
        if(isset($_GET["id"])) {
            $id = $_GET["id"];
            $sentencia = $mysqli->prepare("SELECT idInc, aula, descripcio FROM INCIDENCIA WHERE idInc = ?");
            $sentencia->bind_param("i", $id);
            $sentencia->execute();
            $resultado = $sentencia->get_result();
            $incidencia = $resultado->fetch_assoc();
        }
    ?> 

    <?php include("header.php")?>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Gestionar Incidència</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Busca una incidència per ID</p>
            <form action="" method="GET">
                <div class="form-floating mb-3">
                    <!-- Si el id està definit, mostrar-ho al value del input-->
                    <?php 
                        if(isset($_GET["id"])) { ?>
                            <input type="text" class="form-control" id="floatingInput" placeholder="1" name="id" value="<?php echo $id ?>"> 
                            
                            <?php } else { ?>
                                <input type="text" class="form-control" id="floatingInput" placeholder="1" name="id">
                            <?php }
                    ?>
                    <label for="floatingInput">Id</label>
                </div>
            </form>
            <?php 
            if(isset($_GET["id"])) { ?>
                <form action="tancar_incidencia_BBDD.php?id=<?php echo $id ?>" method="POST">
                    <div class="mb-3">
                        <label for="floatingInput" class="form-label">aula</label>
                        <input type="text" class="form-control rounded-3" id="floatingInput" disabled value="<?php echo $incidencia["aula"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="floatingInput" class="form-label">descripcio</label>
                        <textarea type="text" class="form-control rounded-3" id="floatingInput" rows="6" disabled><?php echo $incidencia["descripcio"]?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            <?php } 
            ?>
        </div>
    </div>

    <?php include("footer.php")?>
</body>
</html>