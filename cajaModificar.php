<?php
include("sesion.php");
$pagina='cajaModificarPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
include('sql/mostrarCaja.php');
include('sql/update.php');
$idCaja = $_REQUEST['idCaja'];

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
        <h3 class="card-header primary-color white-text">Modificacion de Caja</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
               <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="date" class="form-control" name="fecha" value="<?php echo $fech; ?>">
                </div>
              </div>
            <div class="col-md-4 mb-4">
              <div class="md-form">
                <input type="text" id="form1" class="form-control" name="descripcion" value="<?php echo $PDescripcion; ?>">
                <label for="form1" class="">Descripcion</label>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="md-form">
                <input type="text" id="form5" class="form-control" name="importe" value="<?php echo $PImporte; ?>">
                <label for="form5" class="">Importe</label>
              </div>
            </div>
            <input type="submit" name="GuardarIngreso" value="Guardar" class="btn btn-success">
            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='caja.php'">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['GuardarIngreso'])){
                $sqlMCaja = updateCajaIngreso($idCaja,$_POST['descripcion'],$_POST['importe']);
                $conexiones->exec($sqlMCaja);

                echo "<script language='javascript'>";
                echo "alert('El Ingreso se actualizó correctamente');";
                echo "window.location='caja.php';";
                echo "</script>";

              }
            ?>

            <!--FIN -->
            <?php
              if (isset($_POST['GuardarEgreso'])){
                $sqlMCaja = updateCajaEgreso($idCaja,$_POST['descripcion'],$_POST['importe']);
                $conexiones->exec($sqlMCaja);

                echo "<script language='javascript'>";
                echo "alert('El Producto se Actualizo correctamente');";
                echo "window.location='productos.php';";
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
      window.location.href = "sql/productosBorrar.php? idCaja=" + element.id;
  }
</script>
</body>
</html>
