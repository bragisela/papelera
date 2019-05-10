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
        <h3 class="card-header primary-color-dark white-text">Pedidos</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <div class="col-lg-2">
              <a href="registroPedidos.php" id="huggibuton"><button type="button" class="btn btn-success btn-sm" ><i class="fas fa-plus"></i></button></a>

              </div>
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Nro</th>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm">Nombre Cliente</th>
                    <th class="th-sm">Domicilio</th>
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
                      <td><?php echo "
                      <a href='proveedoresModificar.php?idProveedor=$idProveedor' title='Editar'><i class='far fa-edit'></i></a>
                      <a onClick='pDelete(this);' id='$idProveedor' title='Imprimir'><i class='fas fa-print'></i></a>
                      <a href='proveedoresModificar.php?idProveedor=$idProveedor' title='Eliminar'><i class='far fa-trash-alt'></i></a>
                      <a onClick='pDelete(this);' id='$idProveedor' title='Remito'><i class='fas fa-sticky-note'></i></a>
                      <a href='proveedoresModificar.php?idProveedor=$idProveedor' title='Factura'><i class='fas fa-file-invoice-dollar'></i></a>
                      <a onClick='pDelete(this);' id='$idProveedor' title='Historial'><i class='fas fa-history'></i></a>"; ?></td>
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
