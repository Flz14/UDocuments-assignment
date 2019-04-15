<!-- Control de sesion -->
  <?php include 'back/sessionController.php'?>
<!-- End of Control de sesion -->

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center py-5" href="index.php">
      <div class="sidebar-brand-icon">
       <img src="img/varias/logo_ujap_peq.png" width="40%" height="20%" class="d-inline-block align-items-center"
        alt="">
      </div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
      <a class="nav-link" href="page-dashboard.php">
       <i class="fas fa-fw fa-tachometer-alt"></i>
       <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Students -->
     <div class="sidebar-heading">
      Alumnos
     </div>

     <!-- Nav Item - Datos -->
     <li class="nav-item">
      <a id="datos" class="nav-link" href="page-datos.php">
       <i class="fas fa-file-alt"></i>
       <span>Datos</span></a>
     </li>

     <!-- Nav Item - Documentos -->
     <li class="nav-item">
      <a id="documentos" class="nav-link" href="page-documentos.php">
       <i class="far fa-folder-open"></i>
       <span>Documentos</span></a>
     </li>

     <!-- Nav Item - Docs Preview -->
     <li class="nav-item">
      <a id="docs" class="nav-link" href="page-docs.php">
       <i class="far fa-folder-open"></i>
       <span>Docs</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">


     <!-- Heading -->
     <div class="sidebar-heading">
      Interface
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
       aria-controls="collapseTwo">
       <i class="fas fa-fw fa-cog"></i>
       <span>Components</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Components:</h6>
        <a class="collapse-item" href="page-buttons.php">Buttons</a>
        <a class="collapse-item" href="page-cards.php">Cards</a>
       </div>
      </div>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
       aria-expanded="true" aria-controls="collapseUtilities">
       <i class="fas fa-fw fa-wrench"></i>
       <span>Utilities</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Utilities:</h6>
        <a class="collapse-item" href="page-utilities-border.php">Borders</a>
        <a class="collapse-item" href="page-utilities-animation.php">Animations</a>
       </div>
      </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
      Addons
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
       aria-controls="collapsePages">
       <i class="fas fa-fw fa-folder"></i>
       <span>Pages</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="page-404.php">404 Page</a>
        <a class="collapse-item" href="page-blank.php">Blank Page</a>
       </div>
      </div>
     </li>

     <!-- Nav Item - Charts -->
     <li class="nav-item">
      <a class="nav-link" href="page-charts.php">
       <i class="fas fa-fw fa-chart-area"></i>
       <span>Charts</span></a>
     </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
      <a id="table" class="nav-link" href="page-table.php">
       <i class="fas fa-fw fa-table"></i>
       <span>Tables</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Logout -->
     <li class="nav-item">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
       <i class="fas fa-sign-out-alt"></i>
       <span>Cerrar Sesión</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

    </ul>
    <!-- End of Sidebar -->


