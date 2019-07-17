<?php
include("sesion.php");
$pagina='historialPrecioPHP';
include("encabezado.php");
include("sql/conexion.php");
include("seguridad.php");
$idProducto = $_REQUEST['idProducto'];
include('sql/mostrarProductos.php');
include('sql/mostrarPrecio.php');
include('sql/update.php');

$fech = Date("Y-m-d");
$Fecha = Date("Y-m-d H:i:s");
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
    <section class="pb-5 col-md-12">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Precio</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-6 mb-6">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="codProducto" value="<?php echo $PcodProdcuto; ?>" readonly>
                  <label for="form1" class="">Cod Producto</label>
                </div>
              </div>
              <div class="col-md-6 mb-6">
                <div class="md-form">
                  <input type="text" id="form5" class="form-control" name="descripcion" value="<?php echo $PDescripcion; ?>" readonly>
                  <label for="form5" class="">Descripcion</label>
                </div>
              </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Costo</th>
                    <th class="th-sm">% Utilidad</th>
                    <th class="th-sm">Venta</th>
                    <th class="th-sm">Ganancia</th>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm" style="width: 20px;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($rowMPrecio = $mostrarPrecios->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <?php  $rowMPrecio['idPrecio']; $idPrecio = $rowMPrecio['idPrecio'];
                    $desc=$rowMPrecio['porcDesc'];
                    $util=$rowMPrecio['porcUtil'];
                    $importe=$rowMPrecio['importe'];
                    $costo=$importe-(($desc*$importe)/100);
                    $venta=(($util/100)*$costo)+$costo; ?>

                    <td>$ <?php echo $costo; ?></td>
                    <td>% <?php  echo  $util; ?></td>
                    <td>$<?php echo $venta ?></td>
                    <td>$<?php echo $venta=($util/100)*$costo; ?></td>
                    <td><?php $date = new DateTime($rowMPrecio['fecha']);
                      echo $date->format('d/m/Y H:i:s');?></td>
                    <td><?php echo " <a href='precioModificar.php?idPrecio=$idPrecio&idProducto=$idProducto' ><i class='far fa-edit'></i></a>"; ?></td>
                  </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='productos.php'">
          </form>

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
