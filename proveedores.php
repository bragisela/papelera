<?php
include("sesion.php");
$pagina='ProveedoresPHP';
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
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Formulario de Proveedores</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form1" class="form-control" name="Nombre">
                  <label for="form1" class="">Nombre</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form2" class="form-control" name="Cuit">
                  <label for="form2" class="">CUIT</label>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="CondicionIVA">
                  <label for="form3" class="">Condicion IVA</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="text" id="form3" class="form-control" name="Domicilio">
                  <label for="form3" class="">Domicilio</label>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="rete">
                    <label class="custom-control-label" for="defaultUnchecked">¿ Agente retensor ?</label>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" name="Guardar" value="Guardar" class="btn btn-success">
            <input type="reset" name="Guardar" value="Cancelar" class="btn btn-info">
          </form>
            <!--FIN -->
            <?php
              $rete = filter_input(INPUT_POST, 'rete', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
              if($rete){
                $rete = 1;
              } else {
                $rete = 0;
              }
              if (isset($_POST['Guardar'])){

                $sqlProveedor = insertProveedores($_POST['Nombre'],$_POST['Cuit'],$_POST['CondicionIVA'],$_POST['Domicilio'],$rete);
                $conexiones->exec($sqlProveedor);
                echo "<script language='javascript'>";
                echo "alert('El Proveedor se ingreso correctamente');";
                echo "window.location='proveedores.php';";
                echo "</script>";
              }
            ?>
        </div>
      </div>
      <br>
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Busqueda de Proveedores</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">domicilio</th>
                    <th class="th-sm">cuit</th>
                    <th class="th-sm">condicionIVA</th>
                    <th class="th-sm">Retensor </th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($rowProveedores = $resultadoProveedor->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>

                      <td><?php echo $rowProveedores['nombre'];  $idProveedor = $rowProveedores['idProveedor']; ?></td>
                      <td><?php echo $rowProveedores['domicilio']; ?></td>
                      <td><?php echo $rowProveedores['cuit']; ?></td>
                      <td><?php echo $rowProveedores['condicionIVA']; ?></td>
                      <td><?php if($rowProveedores['rete'] == 1){
                        echo "Si";
                      } else {
                        echo "No";}  ?></td>
                      <td><?php echo "
                      <a href='proveedoresModificar.php?idProveedor=$idProveedor'><i class='far fa-edit'></i></i></a>
                      <a onClick='pDelete(this);' id='$idProveedor'><i class='far fa-trash-alt'></i></a>"; ?></td>
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
    window.location.href = "sql/proveedorBorrar.php?idProveedor=" + element.id;
}
</script>
</body>
</html>
