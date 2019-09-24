<?php
include("sesion.php");
$pagina='registroPedidosPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
$idComprobante = $_REQUEST['idComprobante'];
  $fech = Date("Y-m-d");
  $Fecha = Date("Y-m-d H:i:s");
  while($rowPago = $pedidoPago->fetch(PDO::FETCH_ASSOC)) {
    $nroComprobante = $rowPago['nroComprobante'];
    $importe = $rowPago['totalcomprado'];

  }
?>
<!DOCTYPE html>
<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */

</style>

<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-3 col col-md-11">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Forma de pago</h3>
        <div class="card-body">
        <form name="pago" id="pago" method="post">
          <div class="card">
            <div class="card-header bg-light">Datos del Pedido</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input type="number" id="form3" class="form-control" name="pedido"  value="<?php echo $nroComprobante; ?>" disabled>
                      <label for="form3" class="">Nro Pedido</label>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input  class="form-control"  type="number" id="importe" name="importe"  value="<?php echo $importe; ?>"  disabled>
                      <label for="form3" class="">Importe</label>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input  class="form-control" type="text" id="efectivo" name="efectivo" oninput="calcularCheque(this);" min="0" required>
                      <label>Pago en efectivo $</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input class="form-control" type="number" id="cheque"  name="cheque" oninput="calcularCheque(this);" value="0" disabled>
                      <label>Importe a pagar con cheques</label>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <br>
          <br>
          <div class="row">
            <div class="col-md-3 mb-3">
              <div class="text-left header">
                <h5>Listado de Cheques</h5>
              </div>
            </div>
            <div class="col-md-2 mb-2">
              <button type="button" class="btn btn-primary btn-md" onclick="agregarCheque();" id="resetear">Ingresar Cheque</button>
            </div>

          </div>

          <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover table-striped text-left " cellspacing="0" width="100%" id="item_table">
              <thead>
               <tr>
                 <th class="th-sm" style="width:65px;">Pago</th>
                 <th class="th-sm" style="width:65px;">Banco</th>
                 <th class="th-sm" style="width:65px;">Numero</th>
                 <th class="th-sm" style="width:65px;">Importe</th>
                 <th class="th-sm" style="width:35px;">Plazo</th>
                 <th class="th-sm" style="width:65px;">Acciones<!--<button type="button" name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#basicExampleModal"><i class="fas fa-plus fa-l"></i></button>--></th>
               </tr>
             </thead>
             <tbody id="lista">
             </tbody>
             <!--<tfoot>
               <tr>
               <td colspan="4"></td>
                <td>Resto a pagar</td>
                <td>
                  <input class="form-control" type="number" id="totalImporte"  name="importebruto"  value="2" readonly>
                </td>
                <td></td>
               </tr>
               <tr>
                 <td colspan="4"></td>
                 <td>Pago con cheques</td>
                 <td><input class="form-control" type="number" id="iva"  name="iva" value="2"readonly></td>
                 <td></td>
               </tr>
               <tr>
                 <td colspan="4"></td>
                 <td>Total Pagado</td>
                 <td><input class="form-control" type="number" id="totalfac"  name="totalfacturado" value="2" readonly></td>
                 <td></td>
               </tr>
             </tfoot>  -->
           </table>
          </div>

          <div class="row">
            <div class="col-md-8 mb-8"> </div>
            <div class="col-md-4 mb-4">
              <input type="submit" name="insertar" value="Guardar" class="btn btn-success">
              <input type="reset" name="" value="Cancelar" class="btn btn-info">
            </div>
          </div>
      </form>
      <?php
      $activo = 0;
      if (isset($_POST['insertar'])) {


          for($count = 0; $count < count($_POST["sele"]);$count++)
          {
            $queryItems = "INSERT INTO Pagos(modoPago, banco, importe, numero, plazo, idComprobante, activo) VALUES (:modoPago, :banco, :importe, :numero, :plazo, :idComprobante, :activo)";
            $iItems = $conexiones->prepare($queryItems);
            $iItems->execute(
              array(
                ':modoPago'  => 'Cheque',
                ':banco'  => $_POST["banco"][$count],
                ':importe'  => $_POST["importe"][$count],
                ':numero'  => $_POST["numero"][$count],
                ':plazo'  => $_POST["plazo"][$count],
                ':idComprobante'   => $idComprobante,
                ':activo'   => $activo
              )
            );
          }

          $sql = insertPagos('efectivo','-',$_POST['efectivo'],'-','-',$idComprobante,0);
          $conexiones->exec($sql);




          echo "<script language='javascript'>";
          echo "alert('El pedido fue realizado correctamente');";
          echo "window.location='comprasBuscar.php?';";
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
var ps = new PerfectScrollbar(sideNavScrollbar);

  $(document).ready(function() {
    $('.mdb-select').materialSelect();
  });

  function calcularCheque(ele) {
  var importe2 = document.getElementById("importe").value;
  let efectivo = document.getElementById('efectivo');
  efectivo.addEventListener("keyup", function(){
  var efectivo = this.value;
  var cheque = importe2-efectivo;
  var cheque2 = cheque.toFixed(2);
  document.getElementById('cheque').value = cheque2;
  });
}

/*function cantidadCheques(ele) {
let cantCheque = document.getElementById('cantCheque');
cantCheque.addEventListener("keyup", function(){
var cantCheque= this.value;
document.getElementById('filas').value = cantCheque;
});
} */
function agregarCheque() {

  var sel = "Cheque";

  var item = '<tr>';
  item = item +'<td>'+sel+'<input hidden class="form-control" type="number" id="sele[]" name="sele[]" value="'+sel+'"></td>';
  item = item +'<td><input class="form-control" type="text" id="banco[]"  name="banco[]" required></td>';
  item = item +'<td><input class="form-control" type="number" id="numero[]"  name="numero[]" required></td>';
  item = item +'<td><input class="form-control" type="text" id="importe[]"  name="importe[]" min="0" required></td>';
  item = item +'<td><input class="form-control" type="number" id="plazo[]"  name="plazo[]" min="0" required></td>';
  item = item +'<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></div></td></tr>';
  if (sel !='') {
    $("#lista").append(item);
  }
  }



</script>
</body>
</html>
