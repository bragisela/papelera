<?php
include("sesion.php");
$pagina='registroPedidosPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");



$idComprobante = $_REQUEST['idComprobante'];
$pedidoPago2 = $conexiones->query("SELECT nroComprobante, totalcomprado FROM comprobantes where idComprobante='$idComprobante'")
or die ('No se puede traer listado Total'.mysqli_error($conexiones));
  $fech = Date("Y-m-d");
  $Fecha = Date("Y-m-d H:i:s");
  while($rowPago = $pedidoPago2->fetch(PDO::FETCH_ASSOC)) {
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
                      <input  class="form-control" type="number" id="efectivo" name="efectivo" step="any" min="0" required>
                      <label>Pago en efectivo $</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input class="form-control" type="number" id="cheque"  name="cheque"  value="0" disabled>
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
                 <th class="th-sm" >Pago</th>
                 <th class="th-sm" >Banco</th>
                 <th class="th-sm" >Numero</th>
                 <th class="th-sm" >Importe</th>
                 <th class="th-sm" >Plazo</th>
                 <th class="th-sm" >Total</th>
                 <th class="th-sm" >Acciones</th>
               </tr>
             </thead>
             <tbody id="lista">
             </tbody>
             <tfoot>
               <tr>
                 <td colspan="4"></td>
                 <td style="font-size: 18px;">Resto a pagar</td>
                 <td><input class="form-control" type="number" id="restoCheque"  name="restoCheque" value="0" readonly></td>
                 <td></td>
               </tr>
               <tr>
                 <td colspan="4"></td>
                 <td style="font-size: 18px;">Pagado con cheque</td>
                 <td><input class="form-control" type="number" id="totalCheque"  name="totalCheque" value="0" readonly></td>
                 <td></td>
               </tr>
               <tr>
                 <td colspan="4"></td>
                 <td style="font-size: 18px;">Total pagado</td>
                 <td><input class="form-control" type="number" id="totalPagado"  name="totalPagado" value="0" readonly></td>
                 <td></td>
               </tr>
             </tfoot>
           </table>
          </div>



          <div class="row">
            <div class="col-md-8 mb-8"> </div>
            <div class="col-md-4 mb-4">
              <input type="submit" name="insertar" value="Guardar" class="btn btn-success">
              <input type="reset" name="Cancelar" value="Volver" class="btn btn-info" onClick="location.href='pedidosBuscar.php'">
            </div>
          </div>
      </form>
      <?php
      $activo = 0;
      if (isset($_POST['insertar'])) {
        $totalPagado=$_POST['totalPagado'];
        $sqlCaja = insertCajaIngreso($fech,"I"," ",$idComprobante,$nroComprobante,$totalPagado,"0");
        $conexiones->exec($sqlCaja);

          for($count = 0; $count < count($_POST["sele"]);$count++)
          {
            $queryItems = "INSERT INTO pagos(modoPago, banco, importe, numero, plazo, idComprobante, activo) VALUES (:modoPago, :banco, :importe, :numero, :plazo, :idComprobante, :activo)";
            $iItems = $conexiones->prepare($queryItems);
            $iItems->execute(
              array(
                ':modoPago'  => 'Cheque',
                ':banco'  => $_POST["banco"][$count],
                ':importe'  => $_POST["importe"][$count],
                ':numero'  => $_POST["numero"][$count],
                ':plazo'  => $_POST["plazo"][$count],
                ':idComprobante'   => $idComprobante,
                ':activo'   => 0
              )
            );


            $queryComprobantes = "UPDATE comprobantes SET activo =  (:activo) WHERE idComprobante=(:idComprobante)";
            $iComprobante = $conexiones->prepare($queryComprobantes);
            $iComprobante->execute(
              array(
               ':idComprobante'   => $idComprobante,
               ':activo'  => 1

             )
            );
          }


          $queryComprobantes2 = "UPDATE comprobantes SET activo =  (:activo) WHERE idComprobante=(:idComprobante)";
          $iComprobante2 = $conexiones->prepare($queryComprobantes2);
          $iComprobante2->execute(
            array(
             ':idComprobante'   => $idComprobante,
             ':activo'  => 1

           )
          );
          $sql = insertPagos('efectivo','-',$_POST['efectivo'],'-','1000-01-01 00:00:00.000000',$idComprobante,1);
          $conexiones->exec($sql);




          echo "<script language='javascript'>";
          echo "alert('El pedido fue realizado correctamente');";
          echo "window.location='pedidosBuscar.php';";
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

//calcular resto a pagar con cheque
$(document).on('input', '#efectivo', function(){
  var newID = this.id;
  var importe = document.getElementById("importe").value;
  var totalCheque = document.getElementById("totalCheque").value;
  var restoCheque = document.getElementById("restoCheque").value;

  importe = isNaN(parseFloat(importe)) ? 0 : parseFloat(importe);
  totalCheque = isNaN(parseFloat(totalCheque)) ? 0 : parseFloat(totalCheque);
  var efec = isNaN(parseFloat(this.value)) ? 0 : parseFloat(this.value); //pagado efec
  var resto = importe - this.value; // importe - efectivo
  var pagado = efec + totalCheque; // efectivo + total cheques
  var restoPagar = importe - pagado; // resto pagar = importe - efec + cheques

  document.getElementById("cheque").value = resto.toFixed(2);
  document.getElementById("restoCheque").value = restoPagar.toFixed(2);
  document.getElementById("totalPagado").value = pagado.toFixed(2);
});

function agregarCheque() {

  var sel = "Cheque";

  var item = '<tr>';
  item = item +'<td>'+sel+'<input hidden class="form-control" type="number" id="sele[]" name="sele[]" value="'+sel+'"></td>';
  item = item +'<td><input class="form-control" type="text" id="banco[]"  name="banco[]" required></td>';
  item = item +'<td><input class="form-control" type="number" id="numero[]"  name="numero[]" required></td>';
  item = item +'<td><input class="form-control" type="text" id="importe[]"  name="importe[]" oninput="calcularCantidad(this);" min="0" required></td>';
  item = item +'<td><input class="form-control" type="date" id="plazo[]"  name="plazo[]" min="0" required></td>';
  item = item +'<td><input class="form-control" type="number" id="total[]"  name="total[]" min="0" readonly></td>';
  item = item +'<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">X</div></td></tr>';
  if (sel !='') {
    $("#lista").append(item);
  }
  }


  //funcion eliminar
  //restoCheque totalCheque totalPagado
  $(document).on('click', '.remove', function(){
    var totalEli = this.parentNode.parentNode.childNodes[5].childNodes[0].value;
    var totalPagado= document.getElementById("totalPagado");
    var pag = parseFloat(totalPagado.value) - (parseFloat(totalEli));
    console.log(totalEli);
    var totafac = isNaN(parseFloat(pag)) ? 0 : parseFloat(pag);
    var totalCheque = document.getElementById("totalCheque");
    totalCheque.value = parseFloat(totalCheque.value) - parseFloat(totalEli);
    totalPagado= document.getElementById("totalPagado");
    totalPagado.value = pag.toFixed(2);
    var restoCheque= document.getElementById("restoCheque");
    restoCheque.value = parseFloat(restoCheque.value) + parseFloat(totalEli);
    $(this).closest('tr').remove();
  });

  function calcularCantidad(ele) {
    var importe = 0, resto = 0, resto2= 0;
    var tr = ele.parentNode.parentNode;
    var nodes = tr.childNodes;

    for (var x = 0; x<nodes.length;x++) {
      if (nodes[x].firstChild.id == 'importe[]') {
        importe = parseFloat(nodes[x].firstChild.value,10);
        var imp = isNaN(parseFloat(importe)) ? 0 : parseFloat(importe);
      }
      if (nodes[x].firstChild.id == 'total[]') {
        anterior = nodes[x].firstChild.value;
        total = parseFloat(imp,10);
        var tot= isNaN(parseFloat(total)) ? 0 : parseFloat(total);
        var bb = tot.toFixed(2);
        nodes[x].firstChild.value = bb;
      }
    }

    // calcular pagado con cheque
    var totalCheque = document.getElementById("totalCheque").value;
    totalCheque= isNaN(parseFloat(totalCheque)) ? 0 : parseFloat(totalCheque);
    var h = totalCheque + tot - anterior;
    totalCheque = h.toFixed(2);
    document.getElementById("totalCheque").value = totalCheque;

    //calcular resto pagar cheque
    var cheque = document.getElementById("cheque").value;
    resto2 = cheque-totalCheque;
    resto2 = resto2.toFixed(2);
    document.getElementById("restoCheque").value = resto2;

    //calcular total pagado
    var efect = 0;
    efect= document.getElementById("efectivo").value;
    var efect2= isNaN(parseFloat(efect)) ? 0 : parseFloat(efect);
    var totalCheque2 = isNaN(parseFloat(totalCheque)) ? 0 : parseFloat(totalCheque);
    var totalPagado = totalCheque2+efect2;
    document.getElementById("totalPagado").value = totalPagado;

  }



</script>
</body>
</html>
