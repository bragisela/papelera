<?php
include("sesion.php");
$pagina='detalleComprasPHP';
include("encabezado.php");
include("sql/conexion.php");
include("seguridad.php");
$idCompra = $_REQUEST['idCompra'];
include("sql/detalleCompras.php");
$totalCompra=0;
?>
<!DOCTYPE html>
<html lang="es">
<style>

</style>
<body class="hidden-sn mdb-skin">
  <main>
    <div class="container-fluid mt-5">
      <button class="btn btn-rounded btn-deep-purple" role="link" onclick="window.location='comprasBuscar.php'"><i class="fas fa-undo" aria-hidden="true">Volver</i></button>
      <section class="pb-5">
        <div class="card text-center">
          <h3 class="card-header primary-color-dark white-text">Compras</h3>
          <br>
          <h2 class="text-center">Los detalles de tu compra Numero <?php echo "$idCompra"; ?></h2>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Codigo Producto</th>
                      <th class="th-sm">Descripcion</th>
                      <th class="th-sm">Cantidad</th>
                      <th class="th-sm">Importe</th>
                      <th class="th-sm">PorcDescuento</th>
                      <th class="th-sm">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($rowCompras = $detalleCompras->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <?php
                        $cant=$rowCompras['cant'];$importe=$rowCompras['importe']; $porcDesc=$rowCompras['porcDesc'];
                        $importeDesc=$importe-(($porcDesc*$importe)/100);
                        ?>
                        <td><?php echo $rowCompras['codProducto']; ?></td>
                        <td><?php echo $rowCompras['descripcion']; ?></td>
                        <td><?php echo $cant; ?></td>
                        <td><?php echo $importe; ?></td>
                        <td>% <?php echo $porcDesc; ?></td>
                        <td>$ <?php echo $importeDesc*$cant ?></td>
                      </tr>
                      <?php
                      $retib=((2.5*$totalCompra)/100);
                      $retib = bcdiv($retib, '1', 2);
                      $totalCompra=$totalCompra+($importeDesc*$cant);
                      $totalCompra = bcdiv($totalCompra, '1', 2);
                      $iva=((21*$totalCompra)/100);
                      $iva = bcdiv($iva, '1', 2);
                      $Totalfacturado=$iva+$totalCompra+$retib;
                      $Totalfacturado = bcdiv($Totalfacturado, '1', 2);
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4"></td>
                      <td style="font-weight: bold; font-size:16px;">Importe</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $totalCompra; ?></td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td style="font-weight: bold; font-size:16px;">RETENCION IBB</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $retib; ?></td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td style="font-weight: bold; font-size:16px;">IVA </td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $iva; ?></td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td style="font-weight: bold; font-size:16px;">Total Facturado</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $Totalfacturado; ?></td>
                    </tr>
                  </tfoot>
                </table>

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
