<?php
include("sesion.php");
$pagina='nombrePaginaPHP';
include("encabezado.php");
include("sql/conexion.php");
//include("seguridad.php");
include("menu.php");
?>
<!DOCTYPE html>
<html lang="es">
<style>
<!-- ACA IRIA EL CSS -->
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
<div class="container-fluid mt-5">
<section class="pb-5">
<div class="card text-center">
<h3 class="card-header primary-color white-text">Fromulario de cliente</h3>
<div class="card-body">
<div class="row">




</div>

</div>
</div>
</section>
</div>


</main>

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
