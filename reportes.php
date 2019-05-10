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
/* <!-- ACA IRIA EL CSS --> */
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Reportes Compras</h3>
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
          <h3 class="card-header primary-color-dark white-text">Libro IVA Compras</h3>
            <div class="card-body">
              <h4 class="text-left">Periodo &nbsp;&nbsp;<?php ?></h4>
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Fecha</th>
                      <th class="th-sm">Comprobante</th>
                      <th class="th-sm">Proveedores</th>
                      <th class="th-sm">Cuit</th>
                      <th class="th-sm">Importe Bruto</th>
                      <th class="th-sm">Desc</th>
                      <th class="th-sm">Neto Gravad</th>
                      <th class="th-sm">No Grav Exentos</th>
                      <th class="th-sm">Ret. IB</th>
                      <th class="th-sm">IVA</th>
                      <th class="th-sm">Total Facturado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <?php
                    while($rowProductos = $resultadoProductos->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php $idProducto = $rowProductos['idProducto']; echo $rowProductos['codProducto']; ?></td>
                        <td><?php echo $rowProductos['descripcion']; ?></td>
                        <td><?php echo $rowProductos['material']; ?></td>
                        <td><?php echo $rowProductos['unidadEmbalaje']; ?></td>
                        <td><?php echo $rowProductos['medidas']; ?></td>
                        <td><?php echo $rowProductos['unidadMedida']; ?></td>
                        <td><?php echo "
                        <a href='productosModificar.php?idProducto=$idProducto'><i class='far fa-edit'></i></i></a>
                        <a onClick='pDelete(this);' id='$idProducto'><i class='far fa-trash-alt'></i></a>"; ?></td>
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
