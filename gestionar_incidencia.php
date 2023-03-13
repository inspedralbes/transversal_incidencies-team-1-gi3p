<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("includes.php")?>
    <title>Document</title>
</head>
<body>
    <?php include("header.php")?>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Gestionar Incidència</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Busca una incidència per ID</p>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="1">
                <label for="floatingInput">Id</label>
            </div>
        </div>
    </div>

    <?php include("footer.php")?>
</body>
</html>