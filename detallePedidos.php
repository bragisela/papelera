<?php
include("sesion.php");
$pagina='detallePedidosPHP';
include("encabezado.php");
include("sql/conexion.php");
include("seguridad.php");
$idPedido = $_REQUEST['idPedido'];
include("sql/detallePedidos.php");
$totalCompra=0;
$totalUtil=0;
?>
<!DOCTYPE html>
<html lang="es">
<style>

</style>
<body class="hidden-sn mdb-skin">
  <main>
    <div class="container-fluid mt-5">
      <section class="pb-5">
        <div class="card text-center">
          <h3 class="card-header primary-color-dark white-text">Pedidos</h3>
          <br>
          <h2 class="text-center">Los detalles de tu venta Numero <?php echo "$idPedido"; ?></h2>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Cantidad</th>
                      <th class="th-sm">Codigo Producto</th>
                      <th class="th-sm">Descripcion</th>
                      <th class="th-sm">P. Unitario</th>
                      <!--<th class="th-sm">PorcUtil</th>-->
                      <th class="th-sm">Subtotal</th>
                      <th class="th-sm">Precio con descuento</th>
                      <th class="th-sm">C. Unitario</th>
                      <th class="th-sm">Util. Unitaria</th>
                      <th class="th-sm">Util. Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $iva=0;
                    $Totalfacturado=0;
                    while($rowPedidos = $detallePedidos->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <?php
                        $totalcomprado=$rowPedidos ['totalcomprado'];
                        $cant=$rowPedidos ['cant'];$importe=$rowPedidos ['importe']; $impDesc=($importe-($importe*($rowPedidos ['porcDesc'])/100));$porcUtil=$rowPedidos ['porcUtil'];
                        $importeUtil=$importe+(($porcUtil*$importe)/100);
                        ?>
                        <td><?php echo $cant; ?></td>
                        <td><?php echo $rowPedidos ['codProducto']; ?></td>
                        <td><?php echo $rowPedidos ['descripcion']; ?></td>
                        <td>$ <?php echo $importe; ?></td>
                        <!--<td>% <?php echo $porcUtil; ?></td>-->
                        <td>$ <?php echo $importeUtil*$cant ?></td>
                        <td>$ <?php echo $impDesc; ?></td>
                        <td>$ <?php echo $rowPedidos ['costoUni']; ?></td>
                        <td>$ <?php echo $impDesc-($rowPedidos ['costoUni']); ?></td>
                        <td>$ <?php echo ($impDesc-($rowPedidos ['costoUni']))*$cant; ?></td>
                      </tr>
                      <?php
                      $totalCompra=$totalCompra+($importeUtil*$cant);
                      $totalCompra = bcdiv($totalCompra, '1', 2);
                      $justi  = $rowPedidos['justificante'];
                      $totalUtil=$totalUtil+(($impDesc-($rowPedidos ['costoUni']))*$cant);
                      $totalUtil = bcdiv($totalUtil, '1', 2);
                      switch ($justi) {
                            case 'R':
                                $iva=0;
                                break;
                            case 'F':
                                $iva=((21*$totalCompra)/100);
                                break;
                      }

                      $iva = bcdiv($iva, '1', 2);
                      $Totalfacturado=$iva+$totalCompra;
                      $Totalfacturado = bcdiv($Totalfacturado, '1', 2);
                      $desc = $Totalfacturado - $totalcomprado;
}
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3"></td>
                      <td style="font-weight: bold; font-size:16px;">Importe</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $totalCompra; ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                      <td style="font-weight: bold; font-size:16px;">Descuentos aplicados</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $desc; ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                      <td style="font-weight: bold; font-size:16px;">IVA </td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $iva; ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                      <td style="font-weight: bold; font-size:16px;">Total Facturado</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $Totalfacturado-$desc; ?></td>
                    </tr>

                    <tr>
                      <td colspan="7"></td>
                      <td style="font-weight: bold; font-size:16px;">Utilidad Total</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $totalUtil; ?></td>
                    </tr>
                  </tfoot>

                </table>
                <button class="btn btn-rounded btn-deep-purple" role="link" onclick="window.location='pedidosbuscar.php'"><i class="fas fa-undo" aria-hidden="true">Volver</i></button>


              </div>
            </div>
        </div>
      </section>
    </div>
  </main>
<!--Main Layout-->

<?php
include("pie.php");
?>
<script>
// SideNav Button Initialization
$(".button-collapse").sideNav();
// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);




</script>

</body>
</html>
