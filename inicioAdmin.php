<?php
include("sesion.php");
$pagina='inicioAdminPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");

?>
<!DOCTYPE html>
<html lang="es">
<body class="hidden-sn mdb-skin">
<main>
  <div class="container-fluid  mt-5">
    <img style="margin-left: 120px; margin-top: -50px;"src="0extras/logo.jpg" class="img-fluid" alt="Responsive image">
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