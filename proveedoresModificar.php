<?php
include("sesion.php");
$pagina='proveedoresModificarPHP';
include("encabezado.php");
include("sql/conexion.php");
include("sql/insert.php");
//include("seguridad.php");
include('sql/consultas.php');
include('sql/update.php');
$idProveedor = $_REQUEST['idProveedor'];
include('sql/mostrarProveedor.php');
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
        <h3 class="card-header primary-color white-text">Modificar Proveedor</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="Nombre" value="<?php echo $ProNombre; ?>">
                  <label for="form1" class="">Nombre</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="Cuit" value="<?php echo $ProCuit; ?>">
                  <label for="form2" class="">CUIT</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="CondicionIVA" value="<?php echo $ProCondicionIva; ?>">
                  <label for="form3" class="">Condicion IVA</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="Domicilio" value="<?php echo $ProDomicilio; ?>">
                  <label for="form3" class="">Domicilio</label>
                </div>
              </div>
            </div>
            <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-success">
            <input type="reset" name="" value="Cancelar" class="btn btn-info" onClick="location.href='proveedores.php'">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Actualizar'])){
                $sqlMProveedor = updateProveedores($_POST['Nombre'],$_POST['Cuit'],$_POST['CondicionIVA'],$_POST['Domicilio'],$idProveedor);
                $conexiones->exec($sqlMProveedor);
                echo "<script language='javascript'>";
                echo "alert('El Proveedor se actualizo');";
                echo "window.location='proveedores.php';";
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
    window.location.href = "sql/proveedorBorrar.php?idProveedor=" + element.id;
}
</script>
</body>
</html>
