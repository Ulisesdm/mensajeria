<!-- Menu De la izquierda -->
<style>
  #colorDiv2 {
    width:2.5rem;
    height: 2.3rem;
    display: flex;
    justify-content: center;
    text-align: center;
  }
  #colorDiv2 > p {
    font-family: sans-serif;
    color: white;
    font-size: 1rem;
    font-weight: bold;
  }
        
</style>
<!-- Sidebar -->
<ul class="navbar-nav sidebar accordion menu" id="accordionSidebar" >
  <!-- Sidebar - Brand -->
  <a class="d-flex align-items-center justify-content-center" href='<?= URL;?>Vistas/index.php' >
    <div class="sidebar-brand-icon ">
      <img src="../img/.png " width="180px;" >
    </div>
    <div class="sidebar-brand-text mx-3">
      <!-- <img src="" class="logoimg"> -->
    </div>
  </a><br>


  <li class="nav-item" >
    <a class="nav-link" href="<?= URL;?>Vistas/clientes.php">
    <i class="fa fa-envelope" style="font-size: 15px;"></i>&nbsp;
      <span class="titulo">MENSAJERIA</span>
    </a>
  </li>
  <?php if($_SESSION['fa_perfil'] != '2') { ?>
  <li class="nav-item" >
    <a class="nav-link" href="<?= URL;?>Vistas/usuarios.php">
      <i class="fa fa-user" style="font-size: 15px;"></i>&nbsp;
      <span class="titulo">USUARIOS</span>
    </a>
  </li>
  <?php } ?>
 


  <!-- Footer de Los derechos -->
  <li class="nav-item" style="color: #ffffff8c;position: absolute;bottom: 5px;z-index: 0;text-align: center;">
    <a class="nav-link" href="#">
      <span>&copy; Mensajeria <?=date('Y');?></span>
    </a>
  </li>
  <!-- Divider -->
     
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline" >
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
