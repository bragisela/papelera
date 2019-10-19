<?php
include("sesion.php");
$pagina='pagoProveedoresPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include('sql/pagoProveedores.php');

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
        <h3 class="card-header primary-color-dark white-text">Pago de Proveedores</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Domicilio</th>
                    <th class="th-sm">Deuda</th>
                    <th class="th-sm">Ultimo pago</th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                    
                  while($rowProveedores = $resultadoDeuda->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                      <td><?php echo $rowProveedores['nombre'];  $idProveedor = $rowProveedores['idProveedor']; ?></td>
                      <td><?php echo $rowProveedores['domicilio']; ?></td>
                      <td> <?php
                      if ($rowProveedores['deuda']!=0){
                        echo $rowProveedores['deuda'];
                      } else {
                        echo "Sin deuda";
                      }?></td>
                      <td><?php echo $rowProveedores['fecha'];  ?></td>
                      <td><?php echo "
                      <a href='proveedoresComprobantes.php?idProveedor=$idProveedor' title='Ver comprobantes'><i class='fas fa-asterisk'></i></a>
                      "; ?></td>
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
