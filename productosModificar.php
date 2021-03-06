<?php
include("sesion.php");
$pagina='productosModificarPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
$idProducto = $_REQUEST['idProducto'];
include('sql/mostrarProductos.php');
include('sql/update.php');
$resultadoprove = $conexiones->query("SELECT * FROM proveedores ORDER BY nombre")
or die ('No se puede traer listado de revendedoras'.mysqli_error($conexiones));
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
        <h3 class="card-header primary-color white-text">Modificacion de Productos</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="codProducto" value="<?php echo $PcodProdcuto; ?>">
                  <label for="form1" class="">Cod Producto</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form5" class="form-control" name="descripcion" value="<?php echo $PDescripcion; ?>">
                  <label for="form5" class="">Descripcion</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="material" value="<?php echo $PMaterial; ?>">
                  <label for="form2" class="">Material</label>
                </div>
              </div>


            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="unidadEmbalaje" value="<?php echo $PunidadEmbalaje; ?>">
                  <label for="form3" class="">Unidad Embalaje</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="medidas" value="<?php echo $PMedidas; ?>">
                  <label for="form3" class="">Medidas</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="unidadMedida" value="<?php echo $PunidadMedida; ?>">
                  <label for="form3" class="">Unidad Medida</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <select name="proveedor" class="mdb-select">
                  <option value="<?php echo $Pprov ?>"><?php echo$Pnom?></option>
                  <?php
                  while($rowRol = $resultadoprove->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <option value="<?php echo $rowRol['idProveedor']; ?>"><?php echo  $rowRol['nombre']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-success">
            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='productos.php'">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Actualizar'])){
                $sqlMProducto = updateProductos($_POST['codProducto'],$_POST['descripcion'],$_POST['material'],$_POST['unidadEmbalaje'],$_POST['medidas'],$_POST['unidadMedida'],$idProducto,$_POST['proveedor']);
                $conexiones->exec($sqlMProducto);

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
$(document).ready(function() {
$('.mdb-select').materialSelect();
});

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
