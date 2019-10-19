<?php
include("sesion.php");
$pagina='modificarPedidoPHP';
include("encabezado.php");
include("sql/conexion.php");
include("seguridad.php");
$idPedido = $_REQUEST['idPedido'];
include("sql/detallePedidos.php");
$totalCompra=0;
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
          <h2 class="text-center">Modificacion de Pedido Nro: <?php echo "$idPedido"; ?></h2>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <form class=""  method="post">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Codigo Producto</th>
                      <th class="th-sm">Descripcion</th>
                      <th class="th-sm">Cantidad</th>
                      <th class="th-sm">Importe</th>
                      <th class="th-sm">PorcUtil</th>
                      <th class="th-sm">Subtotal</th>
                      <th class="th-sm"></th>
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
                            $cant=$rowPedidos['cant'];
                            $importe=$rowPedidos['importe'];
                            $porcUtil=$rowPedidos ['porcUtil'];
                            $importeUtil=$importe+(($porcUtil*$importe)/100);
                            $idItems=$rowPedidos ['idItems'];
                            ?>
                            <input type="hidden" name="idItems[]" value="<?php echo $idItems; ?>">
                            <input type="hidden" id="imp<?php echo $idItems; ?>" value="<?php echo $importeUtil; ?>">
                            <td><?php echo $rowPedidos ['codProducto'];  ?></td>
                            <td><?php echo $rowPedidos ['descripcion']; ?></td>
                            <td> <input id="cant<?php echo $idItems; ?>" class="plzChange" name="cant[]" class="form-control" value="<?php echo $cant;?>"></td>
                            <td>$ <?php echo $rowPedidos ['importe']; ?></td>
                            <!--<td> <input name="importe[]" class="form-control" value="<?php //echo $importe; ?>"></td> -->
                            <td>% <?php echo $porcUtil; ?></td>
                            <td id="total<?php echo $idItems; ?>">$ <?php echo $importeUtil*$cant ?></td>
                            <td><?php echo "
                            <a onClick='pDelete(this);' id='$idItems'><i class='far fa-trash-alt'></i></a>";?></td>
                          </tr>
                          <?php
                          /*$totalCompra=$totalCompra+($importeUtil*$cant);
                          $totalCompra = bcdiv($totalCompra, '1', 2);
                          $justi  = $rowPedidos['justificante'];

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
                          $Totalfacturado = bcdiv($Totalfacturado, '1', 2); */
                        }
                    ?>
                  </tbody>
                <!--  <tfoot>
                    <tr>
                      <td colspan="4"></td>
                      <td style="font-weight: bold; font-size:16px;">Importe</td>
                      <td style="font-weight: bold; font-size:16px;"> $    <?php echo $totalCompra; ?></td>
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
                  </tfoot> -->
                </table>
                <input type="submit" name="actualizar" value="Modificar Pedido"   aria-hidden="true" class="btn btn-success  col-md-offset-10.9"> </input>
                <a href="pedidosBuscar.php" class="btn btn-info"><i class="fas fa-undo">Volver</i></a>

                <?php
                if(isset($_POST['actualizar'])){

                  for($count = 0; $count < $total; $count++)
                  {
                    $queryItems = "UPDATE items SET cant=:cant where idItems=:idItems";
                    $iItems = $conexiones->prepare($queryItems);
                    $iItems->execute(
                      array(
                        ':idItems'  => $_POST["idItems"][$count],
                        ':cant'  => $_POST["cant"][$count]
                      )
                    );
                  }


                  echo "<script language='javascript'>";
                  echo "alert('El pedido fue modificado exitosamente');";
                  echo "window.location='modificarPedido.php?idPedido=$idPedido';";
                 echo "</script>";

                 }


                ?>
                </form>
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
//Ps.initialize(sideNavScrollbar);
const ps = new PerfectScrollbar(sideNavScrollbar);

function pDelete(element) {
  if(confirm('Esta seguro que quiere eliminar el producto?'))
    window.location.href = "sql/DetallePedidosBorrar.php? idItems=" + element.id;
}

$(document).on('input', '.plzChange', function(){
  var newID = this.id.replace("cant", "");
  var total = document.getElementById("total" + newID);
  var imp = document.getElementById("imp" + newID).value;
  total.innerHTML = this.value * imp;
});


</script>

</body>
</html>
