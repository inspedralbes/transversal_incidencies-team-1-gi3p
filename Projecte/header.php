<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom fixed-top bg-dark">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    <span class="fs-4 text-white">Gestió d'incidències</span>
  </a> 
      

  <ul class="nav nav-pills">
  <?php if(isset($_SESSION["permisos"])){
                if($_SESSION["permisos"] == 1){ ?>
                        <li class="nav-item"><a href="log_out.php" class="nav-link active bg-danger text-white" aria-current="page">Tancar sessió</a></li>
                        <li class="nav-item"><a href="perfil_administrador.php" class="nav-link text-white">Inici</a></li>                        
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opcions 
                          </a>
                          <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="llistat_incidencia_grid.php" class="nav-link">Llistat d'incidències</a></li>
                            <li class="dropdown-item"><a href="informe_tecnics.php" class="nav-link">Informe tècnics</a></li>
                            <li class="dropdown-item"><a href="consum_departaments.php" class="nav-link">Consum per departaments</a></li>
                          </ul>
                        </li>
                <?php } else if($_SESSION["permisos"] == 2){ ?>
                      <li class="nav-item"><a href="log_out.php" class="nav-link active bg-danger" aria-current="page">Tancar sessió</a></li>
                      <li class="nav-item"><a href="llistat_tecnics.php" class="nav-link text-white">Inici</a></li>
                <?php } else if($_SESSION["permisos"] == 3){ ?>
                      <li class="nav-item"><a href="log_out.php" class="nav-link active bg-danger" aria-current="page">Tancar sessió</a></li>
                      <li class="nav-item"><a href="index.php" class="nav-link text-white">Inici</a></li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opcions 
                          </a>
                          <ul class="dropdown-menu">
                            <li class="nav-item"><a href="insertar_incidencia.php" class="nav-link">Insertar incidència</a></li>
                            <li class="nav-item"><a href="consultar_incidencia.php" class="nav-link">Consultar incidència</a></li>                            
                          </ul>
                        </li>
                <?php }
    } else { ?>
            <li class="nav-item"><a href="log_in.php" class="nav-link active btn-primary" aria-current="page">Iniciar sessió</a></li>
            <li class="nav-item"><a href="register.php" class="btn btn-info mx-3" aria-current="page">Registrar-se</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link text-white">Inici</a></li>
            <li class="nav-item"><a href="insertar_incidencia.php" class="nav-link text-white">Insertar incidència</a></li>
            <li class="nav-item"><a href="consultar_incidencia.php" class="nav-link text-white">Consultar incidència</a></li>
  <?php }
      ?>
</ul>
</header>