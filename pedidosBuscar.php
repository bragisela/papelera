<?php
include("sesion.php");
$pagina='pedidosBuscarPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');

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
                  if ($codRol==1) {
                  while($rowComprobante= $resultadoPedidos->fetch(PDO::FETCH_ASSOC)) {
                    $activo = $rowComprobante['activo'];
                    ?>
                    <tr>
                      <td><?php $idComprobante = $rowComprobante['idComprobante']; echo $rowComprobante['nroComprobante']; ?></td>
                    <td><?php $date = new DateTime($rowComprobante['fecha']); echo $date->format('d/m/Y'); ?></td>
                      <td><?php echo $rowComprobante['nombre']; ?></td>
                      <td><?php echo $rowComprobante['domicilioComercio']; ?></td>
                      <td><?php
                      if ($activo == 0) {
                       echo "<a href='pedidoPago.php?idComprobante=$idComprobante' title='Pagar'><i class='far fa-credit-card fa-lg'></i></a>";
                     }
                      echo "
                      <a href='modificarPedido.php?idPedido=$idComprobante' title='Editar'><i class='far fa-edit fa-lg'></i></a>
                      <a href='detallePedidos.php?idPedido=$idComprobante' title='Ver Detalles'><i class='fas fa-asterisk'></i></a>
                      <a target='_blank' href='imprimir.php?idComprobante=$idComprobante' title='Pedido'><i class='fas fa-print fa-lg'></i></a>
                      <a target='_blank' href='imprimirRemito.php?idComprobante=$idComprobante' title='Remito'><i class='fas fa-sticky-note fa-lg'></i></a>
                      <a onClick='pDelete(this);' id='$idComprobante'><i class='far fa-trash-alt fa-lg'></i></a>
                      " ;

                      ?></td>

                    </tr>
                    <?php
                  }
                  }
                  if ($codRol==2) {
                    while($rowComprobante= $resultadoPedidosAdmin->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php $idComprobante = $rowComprobante['idComprobante']; echo $rowComprobante['nroComprobante']; ?></td>
                      <td><?php $date = new DateTime($rowComprobante['fecha']); echo $date->format('d/m/Y'); ?></td>
                        <td><?php echo $rowComprobante['nombre']; ?></td>
                        <td><?php echo $rowComprobante['domicilioComercio']; ?></td>
                        <td><?php echo "
                        <a href='modificarPedido.php?idPedido=$idComprobante' title='Editar'><i class='far fa-edit fa-lg'></i></a>
                        <a href='detallePedidos.php?idPedido=$idComprobante' title='Ver Detalles'><i class='fas fa-asterisk'></i></a>
                        <a target='_blank' href='imprimir.php?idComprobante=$idComprobante' title='Pedido'><i class='fas fa-print fa-lg'></i></a>
                        <a target='_blank' href='imprimirRemito.php?idComprobante=$idComprobante' title='Remito'><i class='fas fa-sticky-note fa-lg'></i></a>
                        <a onClick='pDelete(this);' id='$idComprobante'><i class='far fa-trash-alt'></i></a>
                        " ; ?></td>

                      </tr>
                      <?php
                    }
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
  if(confirm('Esta seguro que quiere eliminar la venta?'))
    window.location.href = "sql/VentaBorrar.php?idComprobante=" + element.id;
}
</script>
</body>
</html>
