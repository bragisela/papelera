<?php
include("sesion.php");
$pagina='inicioSuperAdminPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");

?>
<!DOCTYPE html>
<html lang="es">
<body class="hidden-sn mdb-skin">
<main>
  <div class="container-fluid">
    <center><img style=" width:300px;" src="img/logo.jpg" class="img-fluid" alt="Responsive image"></center>
  </div>
</main>
<!--Main Layout-->

<?php
include("pie.php");
?>
<script>
// SideNav Button Initialization
$(".button-collapse").sideNav();
// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);
</script>
</body>
</html>
