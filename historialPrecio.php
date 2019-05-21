<?php
include("sesion.php");
$pagina='historialPrecioPHP';
include("encabezado.php");
include("sql/conexion.php");
$idProducto = $_REQUEST['idProducto'];

include('sql/mostrarProductos.php');
include('sql/mostrarPrecio.php');
include('sql/update.php');
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
    <section class="pb-5 col-md-12">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Precio</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="codProducto" value="<?php echo $PcodProdcuto; ?>" readonly>
                  <label for="form1" class="">Cod Producto</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form5" class="form-control" name="descripcion" value="<?php echo $PDescripcion; ?>" readonly>
                  <label for="form5" class="">Descripcion</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="number" id="form5" class="form-control" name="porcUtil" value="<?php echo $porcUtil; ?>">
                  <label for="form5" class="">% Utilidad</label>
                </div>
              </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Importe</th>
                    <th class="th-sm">% Descuento</th>
                    <th class="th-sm">% Utilidad</th>
                    <th class="th-sm">Fecha</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($rowMPrecio = $mostrarPrecios->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $rowMPrecio['importe']; ?></td>
                    <td><?php echo $rowMPrecio['porcDesc']; ?></td>
                    <td><?php echo $rowMPrecio['porcUtil']; ?></td>
                    <td><?php $date = new DateTime($rowMPrecio['fecha']);
                      echo $date->format('d/m/Y H:i:s');?></td>
                  </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-success">
            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='productos.php'">
          </form>
            <!--FIN -->
            <?php
              // if (isset($_POST['Actualizar'])){
              //   $sqlMProducto = updateProductos($_POST['codProducto'],$_POST['descripcion'],$_POST['material'],$_POST['unidadEmbalaje'],$_POST['medidas'],$_POST['unidadMedida'],$idProducto);
              //   $conexiones->exec($sqlMProducto);
              //
              //   echo "<script language='javascript'>";
              //   echo "alert('El Producto se Actualizo correctamente');";
              //   echo "window.location='productos.php';";
              //   echo "</script>";
              //
              // }
            ?>
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
