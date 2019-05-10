<?php
include("sesion.php");
$pagina='ProveedoresPHP';
include("encabezado.php");
include("sql/conexion.php");
include("sql/insert.php");
//include("segguridad.php");
include('sql/consultas.php');
include("menu.php");
?>
<!DOCTYPE html>
<html lang="es">
<style type="text/css">
  @media only screen and (min-width: 1200px) {
    #huggibuton{
      position: absolute;
      margin-left: 390%;
      z-index: 3;
    }
  }
  @media only screen and (min-width: 1000px) and (max-width: 1199px){
    #huggibuton{
      position: absolute;
      margin-left: 43%;
      z-index: 3;
    }
  }
  @media only screen and (min-width: 980px) and (max-width: 999px){
    #huggibuton{
      position: absolute;
      margin-left: 43%;
      z-index: 3;
    }
  }
  @media only screen and (min-width: 900px) and (max-width: 980px){
    #huggibuton{
      position: absolute;
      margin-left: 40%;
      z-index: 3;
    }
  }
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Compras</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <div class="col-lg-2">
              <a href="registroCompras.php" id="huggibuton"><button type="button" class="btn btn-success btn-sm" ><i class="fas fa-plus"></i></button></a>

              </div>
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Nro</th>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm">Nombre Proveedor</th>
                    <th class="th-sm">Domicilio</th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($rowCompras = $resultadoCompras->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                      <td><?php echo $rowCompras['nroComprobante'];  $idProveedor = $rowCompras['nroComprobante']; ?></td>
                      <td><?php $date = new DateTime($rowCompras['fecha']); echo $date->format('d/m/Y'); ?></td>
                      <td><?php echo $rowCompras['nombre']; ?></td>
                      <td><?php echo $rowCompras['domicilio']; ?></td>
                      <td><?php echo "
                      <a href='' title='Editar' class='btn-primary btn-sm'><i class='far fa-edit'></i></a>

                      <a onClick='' id='$idProveedor' title='Eliminar' class='btn-primary btn-sm'><i class='far fa-trash-alt'></i></a>
                      "; ?></td>
                    </tr>
                    <?php
                  }
                  // <a href='pdf/PDFcompra.php?idProveedor=$idProveedor' title='Imprimir' class='btn-primary btn-sm'><i class='fas fa-print'></i></a>
                  // <a href='proveedoresModificar.php?idProveedor=$idProveedor' title='Remito' class='btn-primary btn-sm'><i class='fas fa-sticky-note'></i></a>
                  // <a href='proveedoresModificar.php?idProveedor=$idProveedor' title='Factura' class='btn-primary btn-sm'><i class='fas fa-file-invoice-dollar'></i></a>
                  // <a href='proveedoresModificar.php?idProveedor=$idProveedor' title='Historial' class='btn-primary btn-sm'><i class='fas fa-history'></i></a>
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
