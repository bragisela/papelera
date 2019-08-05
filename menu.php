  <!--Double navigation-->
  <header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4">
      <ul class="custom-scrollbar">
        <!-- Logo -->
        <li>
          <div class="logo-wrapper waves-light">
            <a href="inicioAdmin.php"><img src="img/logonatbra.png" class="img-fluid flex-center"></a>
          </div>
        </li>
        <!--/. Logo -->

        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion">
            <li>
              <a href="clientes.php" class="collapsible-header waves-effect"><i class="fas fa-user-friends"></i>Clientes</a>
            </li>
            <li>
              <a href="proveedores.php" class="collapsible-header waves-effect"><i class="fas fa-user-tie"></i>Proveedores</a>
            </li>
            <li>
              <a href="productos.php" class="collapsible-header waves-effect"><i class="fas fa-industry"></i>Productos</a>
            </li>
            <li>
              <a href="comprasBuscar.php" class="collapsible-header waves-effect"><i class="fas fa-shopping-basket"></i>Compras</a>
            </li>
            <!-- <li>
              <a href="" class="collapsible-header waves-effect"><i class="fas fa-cart-arrow-down"></i>Ventas</a>
            </li> -->
             <li>
              <a href="pedidosBuscar.php" class="collapsible-header waves-effect"><i class="fas fa-cart-plus"></i>Pedidos</a>
            </li>
            <li>
              <a href="caja.php" class="collapsible-header waves-effect"><i class="fas fa-calculator"></i>Caja</a>
            </li>
             <li>
               <a class="collapsible-header waves-effect arrow-r">
                 <i class="fas fa-chart-line"></i>
                 Reportes
                 <i class="fas fa-angle-down rotate-icon"></i>
               </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <a href="reporteCompras.php" class="waves-effect"> <i class="fas fa-money-bill"></i>IVA Compras</a>
                  </li>
                  <li>
                    <a href="reporteVentas.php" class="waves-effect"><i class="fas fa-money-bill"></i>IVA Ventas</a>
                  </li>
                  <li>
                    <a href="reportesCaja.php" class="waves-effect"><i class="fas fa-cash-register"></i>Caja</a>
                  </li>
                  <li>
                    <a href="reportesUtilidad.php" class="waves-effect"><i class="fas fa-cash-register"></i>Utilidad</a>
                  </li>
                </ul>
              </div>
            </li>
            <!--
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-hand-pointer-o"></i>
                Instruction<i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">For bloggers</a>
                  </li>
                  <li><a href="#" class="waves-effect">For authors</a>
                  </li>
                </ul>
              </div>
            </li>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> About<i class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">Introduction</a>
                  </li>
                  <li><a href="#" class="waves-effect">Monthly meetings</a>
                  </li>
                </ul>
              </div>
            </li>
            <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-envelope-o"></i> Contact me<i
                  class="fas fa-angle-down rotate-icon"></i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                  <li><a href="#" class="waves-effect">FAQ</a>
                  </li>
                  <li><a href="#" class="waves-effect">Write a message</a>
                  </li>
                </ul>
              </div>
            </li> -->
          </ul>
        </li>
        <!--/. Side navigation links -->
      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>
      <!-- Breadcrumb-->
      <div class="breadcrumb-dn mr-auto">
        <p>Menu</p>
      </div>
      <ul class="nav navbar-nav nav-flex-icons ml-auto">

        <li class="nav-item">
          <a class="nav-link"><i class=" icon-question-sign"></i><span class="clearfix d-none d-sm-inline-block">Ayuda</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            	<?php echo $_SESSION['usuario']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="logout.php">Salir</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.Navbar -->
  </header>
  <!--/.Double navigation-->
