<?php
include("sesion.php");
$pagina='precioModificarPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
$idProducto = $_REQUEST['idProducto'];
$idPrecio = $_REQUEST['idPrecio'];
include('sql/mostrarProductoPrecio.php');
include('sql/update.php');
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
        <h3 class="card-header primary-color white-text">Modificar Precio</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="codProducto" value="<?php echo $peCodProducto; ?>" disabled>
                  <label for="form1" class="">Cod Producto</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form5" class="form-control" name="descripcion" value="<?php echo $peDescripcion; ?>" disabled>
                  <label for="form5" class="">Descripcion</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="costo" value="$ <?php echo ($peImporte-(($pePorcDesc*$peImporte)/100)); ?>" disabled>
                  <label for="form2" class="">Costo</label>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="utilidad" value="<?php echo $pePorcUtil; ?>">
                  <label for="form3" class="">% Utilidad</label>
                </div>
              </div>
            </div>

            <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-success">
            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='productos.php'">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Actualizar'])){
                $sqlMPrecio = updatePreciosInd($idPrecio,$_POST['utilidad']);
                $conexiones->exec($sqlMPrecio);

                echo "<script language='javascript'>";
                echo "alert('El precio del producto fue modificado exitosamente');";
                echo "window.location='historialPrecio.php?idProducto=$idProducto';";
               echo "</script>";

              }
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

  function pDelete(element) {
    if(confirm('Esta seguro que quiere eliminar el producto?'))
      window.location.href = "sql/productosBorrar.php? idProducto=" + element.id;
  }
</script>
</body>
</html>
