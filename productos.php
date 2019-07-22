<?php
include("sesion.php");
$pagina='productosPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
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
        <h3 class="card-header primary-color white-text">Formulario de Productos</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="codProducto">
                  <label for="form1" class="">Cod Producto</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="descripcion">
                  <label for="form2" class="">Descripcion</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="material">
                  <label for="form3" class="">Material</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form4" class="form-control" name="unidadEmbalaje">
                  <label for="form4" class="">Unidad Embalaje</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form5" class="form-control" name="medidas">
                  <label for="form5" class="">Medidas</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form6" class="form-control" name="unidadMedida">
                  <label for="form6" class="">Unidad Medida</label>
                </div>
              </div>
              
            </div>
            <input type="submit" name="Guardar" value="Guardar" class="btn btn-success">
            <input type="reset" name="Guardar" value="Cancelar" class="btn btn-info">
          </form>
            <!--FIN -->
            <?php
              if (isset($_POST['Guardar'])){
                $sqlProducto = insertProductos($_POST['codProducto'],$_POST['descripcion'],$_POST['material'],$_POST['unidadEmbalaje'],$_POST['medidas'],$_POST['unidadMedida']);
                $conexiones->exec($sqlProducto);

                echo "<script language='javascript'>";
                echo "alert('El Producto se ingreso correctamente');";
                echo "window.location='productos.php';";
                echo "</script>";

              }
            ?>

        </div>
      </div>
      <br>
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Busqueda de Productos</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Cod de Producto</th>
                    <th class="th-sm">Descripcion</th>
                    <th class="th-sm">Material</th>
                    <th class="th-sm">Unidad de Embalaje</th>
                    <th class="th-sm">Medidas</th>
                    <th class="th-sm">Unidad de Medida</th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
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
                      <a href='productosModificar.php?idProducto=$idProducto'><i class='far fa-edit'></i></a>
                      <a onClick='pDelete(this);' id='$idProducto'><i class='far fa-trash-alt'></i></a>
                      <a href='historialPrecio.php?idProducto=$idProducto'><i class='fas fa-history'></i></a>";?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
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

  function pDelete(element) {
    if(confirm('Esta seguro que quiere eliminar el producto?'))
      window.location.href = "sql/productosBorrar.php? idProducto=" + element.id;
  }

  // Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>
</body>
</html>
