    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-clipboard-check"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Sistema de control</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
          Módulos
        </div>
        <!-- Nav Item - Dashboard -->
        <li @click="menu=0" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tablero</span></a>
        </li>
                <!-- Nav Item - Usuarios -->
        <li @click="menu=1" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Alumnos</span>
          </a>
        </li>
             <!-- Nav Item - Usuarios -->
        <li @click="menu=2" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Colegiaturas</span>
          </a>
        </li>
      
            <!-- Nav Item - Usuarios -->
        <li @click="menu=3" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Pago Colegiaturas</span>
          </a>
        </li>
              <li @click="menu=4" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Compras</span>
          </a>
        </li>
             <!-- Nav Item - Usuarios -->
        <li @click="menu=5" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Rentas</span>
          </a>
        </li>
 
             <!-- Nav Item - Usuarios -->
        <li @click="menu=6" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Servcios</span>
          </a>
        </li>
      
 
             <!-- Nav Item - Usuarios -->
        <li @click="menu=7" class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span>Estado de cuenta</span>
          </a>
        </li>
   
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->
