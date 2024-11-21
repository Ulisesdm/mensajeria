<!-- Parte de la navegacion  -->
<style>
  #colorDiv {
    width:2.2rem;
    height: 1.8rem;
    border:1px solid;
    text-align:center;
  }
  #colorDiv > p {
    font-family: sans-serif;
    color: white;
    font-size: 1rem;
    font-weight: bold;
  }
</style>
<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">   
    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="usuario"><!-- <i class="fa fa-user-circle-o fa-lg"></i> --><i class="fas fa-user-circle fa-lg"></i></span>&nbsp;
        <span class="usuario" class="mr-2 d-none d-lg-inline  small"><?= $_SESSION["fa_nombre"]; ?>&nbsp;<i class="fas fa-caret-down"></i></span>  
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;&nbsp;Cerrar Sesión
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- End of Topba -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Cerrar Sesión</h5>
			</div>
      <div class="modal-body">¿Está seguro de que desea salir de su sesión?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times-circle"></i> CANCELAR</button>
        <a class="btn btn-red btn-sm" href="<?= URL;?>logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;SALIR</a>
      </div>
    </div>
  </div>
</div>