<?php
//Una vez que se registro una compra, se llega a esta pagina para dar valor de utilidad a todos los productos comprados en ese pedidos
// Tambien hay una opcion de poder modificar una fila cualquiera sea redirigiendose a la pagina precioUltimaCompraModificar.php
include("sesion.php");
$pagina='precioUltimaCompraPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
$idComprobante = $_REQUEST['idComprobante'];
include('sql/mostrarUltimaCompra.php');
include('sql/update.php');
$fech = Date("Y-m-d");
$Fecha = Date("Y-m-d H:i:s");

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
        <h3 class="card-header primary-color white-text">Precio</h3>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="md-form" align="left">
                  <p>Insertar valor de Utilidad para los ultimos productos comprados</p>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="md-form">
                  <input type="number" step="0.01" id="form5" class="form-control" name="porcUtil" value="">
                  <label for="form5" class="">% Utilidad</label>
                </div>
              </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Costo</th>
                    <th class="th-sm">% Utilidad</th>
                    <th class="th-sm">Venta</th>
                    <th class="th-sm">Ganancia</th>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm" style="width: 20px;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($rowMPrecio = $MostrarUltCompra->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <?php  $rowMPrecio['idPrecio']; $idPrecio = $rowMPrecio['idPrecio'];
                    $rowMPrecio['idProducto']; $idProducto = $rowMPrecio['idProducto'];
                    $desc=$rowMPrecio['porcDesc'];
                    $util=$rowMPrecio['porcUtil'];
                    $importe=$rowMPrecio['importe'];
                    $costo=$importe-(($desc*$importe)/100);
                    $venta=(($util/100)*$costo)+$costo;
                    $venta = bcdiv($venta, '1', 2);
                    $ganancia2=($util/100)*$costo;
                    $ganancia2 = bcdiv($ganancia2, '1', 2);?>


                    <td>$ <?php echo $costo; ?></td>
                    <td>% <?php  echo  $util; ?></td>
                    <td>$<?php echo $venta ?></td>
                    <td>$<?php echo $ganancia2; ?></td>
                    <td><?php $date = new DateTime($rowMPrecio['fecha']);
                      echo $date->format('d/m/Y H:i:s');?></td>
                    <td><?php echo " <a href='precioUltimaCompraModificar.php?idPrecio=$idPrecio&idComprobante=$idComprobante&idProducto=$idProducto' ><i class='far fa-edit'></i></a>"; ?></td>
                  </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-success">
            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='comprasBuscar.php'">
          </form>
            <!--FIN -->
            <?php
               if (isset($_POST['Actualizar'])){
                 $sqlPrec = updatePrecios($_POST['porcUtil'],$idComprobante);
                 $conexiones->exec($sqlPrec);

                 echo "<script language='javascript'>";
                 echo "alert('El precio del producto fue modificado exitosamente');";
                 echo "window.location='precioUltimaCompra.php?idComprobante=$idComprobante';";
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
  // SideNav Button Initialization
  $(".button-collapse").sideNav();
  // SideNav Scrollbar Initialization
  var sideNavScrollbar = document.querySelector('.custom-scrollbar');
  Ps.initialize(sideNavScrollbar);
</script>
</body>
</html>
