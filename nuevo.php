<?php
include("sesion.php");
$pagina='nombrePaginaPHP';
include("encabezado.php");
include("sql/conexion.php");
//include("segguridad.php");
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
              <div class="col-md-4 mb-4">
        <div class="md-form">
          <input type="text" id="form1" class="form-control">
          <label for="form1" class="">Basic example</label>
        </div>
              </div>

              <div class="col-md-4 mb-4">
        <div class="md-form form-sm">
          <input type="text" id="form2" class="form-control form-control-sm">
          <label for="form2" class="">Small input</label>
        </div>
              </div>

              <div class="col-md-4 mb-4">
        <div class="md-form">
          <input placeholder="Placeholder" type="text" id="form3" class="form-control">
          <label for="form3" class="active">Example label</label>
        </div>
              </div>
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
