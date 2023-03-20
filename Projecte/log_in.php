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
    <main class="form-signin w-100 m-auto">
      <form class="px-4 py-5 my-5 text-center">
        <img class="mb-4" src="https://www.iconpacks.net/icons/1/free-user-login-icon-305-thumb.png" alt="" width="110" height="100">
        <h1 class="h3 mb-3 fw-normal">Inici de sessió</h1>
        <div class="col-lg-6 mx-auto">
            <div class="form-floating my-2">
            <input type="email" class="form-control" placeholder="name@example.com">
            <label for="floatingInput">Correu electrònic</label>
            </div>
            <div class="form-floating my-2">
            <input type="password" class="form-control" placeholder="Password">
            <label for="floatingPassword">Contrasenya</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Accedir</button>
        </div>
      </form>
    </main>
<?php include("footer.php")?>
</body>
</html>