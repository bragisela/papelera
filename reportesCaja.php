<?php
include("sesion.php");
$pagina='reportesCajaPHP';
include("encabezado.php");
include("sql/conexion.php");
include("sql/consultas.php");
//include("segguridad.php");
include("menu.php");
?>
<!DOCTYPE html>
<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Reportes de Caja</h3>
        <div class="card-body">
          <!-- Horizontal material form -->
          <form method="POST">
            <!-- Grid row -->
            <div class="form-group row">
              <!-- Material input -->
              <label for="input3MD" class="col-sm-2 col-form-label">Fecha Desde</label>
              <div class="col-sm-4">
                <div class="md-form mt-0">
                  <input type="date" class="form-control" id="input3MD" name="fechaD" value="<?php if (isset($fechaD)){echo $fechaD;}?>" >
                </div>
              </div>
            </div>
            <!-- Grid row -->
            <!-- Grid row -->
            <div class="form-group row">
              <!-- Material input -->
              <label for="inputMD" class="col-sm-2 col-form-label">Fecha Hasta</label>
              <div class="col-sm-4">
                <div class="md-form mt-0">
                  <input type="date" class="form-control" id="inputMD" name="fechaH" value="<?php if (isset($fechaH)){echo $fechaH;}?>" >
                </div>
              </div>
            </div>
            <!-- Grid row -->
            <!-- Grid row -->
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" name="buscar" class="btn btn-primary btn-md">Buscar</button>
              </div>
            </div>
            <!-- Grid row -->
          </form>
          <!-- Horizontal material form -->
        </div>
        <br>
        <?php

         if (isset($_POST['buscar']) && ($_POST['fechaD'] !='') && ($_POST['fechaH']!='')) {
           ?>

        <div class="card text-center">
          <h3 class="card-header primary-color-dark white-text">Resporte de Caja</h3>
            <div class="card-body">
              <h4 class="text-left">Periodo &nbsp;&nbsp;<?php ?></h4>
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Fecha</th>
                      <th class="th-sm">NroCaja</th>
                      <th class="th-sm">Descripcion</th>
                      <th class="th-sm">Importe</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($rowCaja = $resultadoCaja->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php $idCaja = $rowCaja['idCaja'];?></td>
                        <td><?php echo $rowCaja['fecha']; ?></td>
                        <td><?php echo $rowCaja['nroCaja']; ?></td>
                        <td><?php echo $rowCaja['descripcion']; ?></td>
                        <td><?php echo $rowCaja['importe']; ?></td>
                        <td><?php echo $rowCaja['unidadMedida']; ?></td>
                        <td><?php echo "
                        <a href='cajaModificar.php?idCaja=$idCaja'><i class='far fa-edit'></i></i></a>
                        <a onClick='pDelete(this);' id='$idCaja'><i class='far fa-trash-alt'></i></a>"; ?></td>
                      </tr>
                      <?php
                    }
                    ?> -->
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      <?php } ?>
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
