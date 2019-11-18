<?php
include("sesion.php");
$pagina='proveedoresPagosPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
$idProveedor = $_REQUEST['idProveedor'];
include('sql/proveedoresComprobantes.php');
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
                      <input type="text" id="form1" class="form-control" name="Nombre" value="<?php echo $nombre; ?>" disabled>
                      <label for="form1" class="">Nombre</label>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input type="text" id="form2" class="form-control" name="Cuit" value="<?php echo $cuit; ?>" disabled>
                      <label for="form2" class="">CUIT</label>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input type="text" id="form3" class="form-control" name="CondicionIVA" value="<?php echo $condicioniva; ?>" disabled>
                      <label for="form3" class="">Condicion IVA</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input type="text" id="form3" class="form-control" name="Domicilio" value="<?php echo $domicilio; ?>" disabled>
                      <label for="form3" class="">Domicilio</label>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input type="text" id="pagar" class="form-control" name="pagar" value="<?php echo $saldo; ?>" disabled>
                      <label  class="">Saldo a pagar</label>
                    </div>
                  </div>
                </div>

                <br>
                <div class="text-left header">
                     <h5>Listado de Cheques</h5>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-6">
                    <select class="mdb-select md-form" searchable="Buscar.." data-width="auto" id="producto">
                      <option value="" disabled selected="selected">Buscar Cheques</option>
                      <?php
                        while($rowCheq = $cheques->fetch(PDO::FETCH_ASSOC)) {
                        $pplazo  = substr($rowCheq['plazo'], 0, -15);
                      ?>
                      <option value="<?php echo $rowCheq ['idPago']; ?>"><?php echo $rowCheq ['modoPago']; echo " - "; echo $rowCheq ['banco']; echo " - ";echo $rowCheq ['numero']; echo " - "; echo $rowCheq ['importe']; echo " - "; echo $pplazo; ; ?></option>
                      <?php
                      }
                        while($rowCheq2 = $cheques2->fetch(PDO::FETCH_ASSOC)) {
                        $pplazo  = substr($rowCheq2['plazo'], 0, -15);
                      ?>
                      <option value="<?php echo $rowCheq2 ['idCheque']; ?>"><?php echo $rowCheq2 ['modoPago']; echo " - "; echo $rowCheq2 ['banco']; echo " - ";echo $rowCheq2 ['numero']; echo " - "; echo $rowCheq2 ['importe']; echo " - "; echo $pplazo; ; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <button type="button" class="btn btn-primary btn-md" onclick="agregarCheque();" id="resetear">Ingresar Cheque</button>
                  </div>
                </div>

                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered table-hover table-striped text-left " cellspacing="0" width="100%" id="item_table">
                    <thead>
                     <tr>
                       <th class="th-sm" >Id Cheque</th>
                       <th class="th-sm" >Pago</th>
                       <th class="th-sm" >Banco</th>
                       <th class="th-sm" >Numero</th>
                       <th class="th-sm" >Plazo</th>
                       <th class="th-sm" >Importe</th>
                       <th class="th-sm" >Acciones</th>
                     </tr>
                   </thead>
                   <tbody id="lista">
                   </tbody>
                   <tfoot>
                     <tr>
                       <td colspan="3"></td>
                       <td style="font-size: 18px;">Resto a pagar en efectivo</td>
                       <td><input class="form-control" type="number" id="totalResto"  name="totalResto" value="0" readonly></td>
                       <td></td>
                     </tr>
                     <tr>
                       <td colspan="3"></td>
                       <td style="font-size: 18px;">Cheques</td>
                       <td><input class="form-control" type="number" id="totalCheque"  name="totalCheque" value="0" readonly></td>
                       <td></td>
                     </tr>
                     <tr>
                       <td colspan="3"></td>
                       <td style="font-size: 18px;">Efectivo</td>
                       <td><input class="form-control" type="text" id="totalEfectivo"  name="totalEfectivo" oninput="calcularTotal(this);" value="0" required></td>
                       <td></td>
                     </tr>
                     <tr>
                       <td colspan="3"></td>
                       <td style="font-size: 18px;">Total Cancelado</td>
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


            for($count = 0; $count < count($_POST["sele"]); $count++)
            {
              $tempPago = 0;
              $tempPago2 = 1;
              $activo = 1;
              $queryComprobantes = "UPDATE comprobantes SET  activo = (:activo) , tempPago =  (:tempPago) WHERE tempPago=(:tempPago2)";
              $iComprobante = $conexiones->prepare($queryComprobantes);
              $iComprobante->execute(
                array(
                 ':tempPago2'   => $tempPago2,
                 ':activo'  => $activo,
                 ':tempPago'  => $tempPago

               )
              );

              $activo = 1;
              $queryPagos = "UPDATE pagos SET  activo = (:activo)  WHERE idPago=(:idPago) AND modoPago=(:modoPago) ";
              $iPagos = $conexiones->prepare($queryPagos);
              $iPagos->execute(
                array(
                 ':modoPago'   => $_POST["codi"][$count],
                 ':idPago'   => $_POST["sele"][$count],
                 ':activo'  => $activo

               )
              );

              $queryCheque = "UPDATE cheques SET  activo = (:activo2)  WHERE idCheque=(:idCheque) AND modoPago=(:modoPago) ";
              $iChe = $conexiones->prepare($queryCheque );
              $iChe->execute(
                array(
                 ':modoPago'   => $_POST["codi"][$count],
                 ':idCheque'   => $_POST["sele"][$count],
                 ':activo2'  => $activo
               )
              );

            }

            $sql = insertPagos('efectivo','-',$_POST['totalEfectivo'],'-','-',$idCom,1);
            $conexiones->exec($sql);

              echo "<script language='javascript'>";
              echo "alert('El pedido fue realizado correctamente');";
              echo "window.location='pagoProveedores.php';";
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


function agregarCheque() {
  var sel = $('#producto').find(':selected').val();
  var text = $('#producto').find(':selected').text();
  var separador = "-";
  var limite = 1;
  var cod = text.split(separador, limite);
  var banco = text.split(separador)[1];
  var numero = text.split(separador)[2];
  var importe = text.split(separador)[3];
  var f1 = text.split(separador)[4];
  var f2 = text.split(separador)[5];
  var f3 = text.split(separador)[6];
  var fecha = f3+'-'+f2+'-'+f1;
  importe = isNaN(parseFloat(importe)) ? 0 : parseFloat(importe);

  var item = '<tr id="' + sel + '">';
  item = item +'<td>'+sel+'<input hidden class="form-control" type="text" id="codi[]" name="codi[]" value="'+cod+'" readonly></td>';
  item = item +'<td>'+cod+'<input hidden class="form-control" type="number" id="sele[]" name="sele[]" value="'+sel+'" readonly></td>';
  item = item +'<td><input class="form-control" type="text" id="banco[]"  name="banco[]" value="'+banco+'" readonly></td>';
  item = item +'<td><input class="form-control" type="text" id="numero[]"  name="numero[]" value="'+numero+'" readonly></td>';
  item = item +'<td><input class="form-control" type="text" id="plazo[]"  name="plazo[]" min="0" value="'+fecha+'" readonly></td>';
  item = item +'<td><input class="form-control" type="text" id="importe[]"  name="importe[]"  value="'+importe+'" readonly></td>';
  item = item +'<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">X</div></td></tr>';
  if (sel !='') {
    $("#lista").append(item);
    calcularCantidad(document.getElementById(sel));
  }
  }

  $(document).on('click', '.remove', function(){
    var totalEli = this.parentNode.parentNode.childNodes[5].childNodes[0].value;
    console.log(totalEli);
    var saldoAcumulado= document.getElementById("totalPagado");
    var totalResto= document.getElementById("totalResto");
    var totalCheque= document.getElementById("totalCheque");
    var efect = document.getElementById("totalEfectivo").value;
    var efec2= isNaN(parseFloat(efect)) ? 0 : parseFloat(efect);
    var fac = parseFloat(saldoAcumulado.value) - (parseFloat(totalEli));
    var fac2 = parseFloat(totalResto.value) + (parseFloat(totalEli)) - (parseFloat(efec2));
    var fac3 = parseFloat(totalCheque.value) - (parseFloat(totalEli));
    var totafac = isNaN(parseFloat(fac)) ? 0 : parseFloat(fac);
    var totafac2 = isNaN(parseFloat(fac2)) ? 0 : parseFloat(fac2);
    var totafac3 = isNaN(parseFloat(fac3)) ? 0 : parseFloat(fac3);
    document.getElementById("totalPagado").value = totafac.toFixed(2);
    document.getElementById("totalResto").value = totafac2.toFixed(2);
    document.getElementById("totalCheque").value = totafac3.toFixed(2);

    $(this).closest('tr').remove();
  });

  function calcularCantidad(ele) {
    var tr = ele;
    var nodes = tr.childNodes;

    for (var x = 0; x<nodes.length;x++) {
      if (nodes[x].firstChild.id == 'importe[]') {
        precio = parseFloat(nodes[x].firstChild.value,10);
        var preci= isNaN(parseFloat(precio)) ? 0 : parseFloat(precio);
      }
    }
    var saldoPagar = document.getElementById("pagar").value;
    saldoPagar = isNaN(parseFloat(saldoPagar)) ? 0 : parseFloat(saldoPagar);
    var totalCheque = document.getElementById("totalCheque").value;
    totalCheque  = isNaN(parseFloat(totalCheque )) ? 0 : parseFloat(totalCheque);
    totalCheque = totalCheque + preci;
    document.getElementById("totalCheque").value = totalCheque;
    var restoPagar = saldoPagar-totalCheque;
    document.getElementById("totalResto").value = restoPagar;
    document.getElementById("totalPagado").value = totalCheque;
  }


  function calcularTotal(ele) {

    var totalCheque = document.getElementById("totalCheque").value;
    totalCheque  = isNaN(parseFloat(totalCheque )) ? 0 : parseFloat(totalCheque);
    var efect = document.getElementById("totalEfectivo").value;
    efect = isNaN(parseFloat(efect)) ? 0 : parseFloat(efect);
    var totalPagado = efect + totalCheque;
    document.getElementById("totalPagado").value = totalPagado;
    var totalResto= document.getElementById("totalResto").value;
    totalResto  = isNaN(parseFloat(totalResto)) ? 0 : parseFloat(totalResto);
    var saldoPagar = document.getElementById("pagar").value;
    saldoPagar = isNaN(parseFloat(saldoPagar)) ? 0 : parseFloat(saldoPagar);
    if (totalCheque==0){
        totalResto = saldoPagar-efect;
        document.getElementById("totalResto").value = totalResto;
    } else if (totalCheque!=0){
      var totalResto = totalResto;
      document.getElementById("totalResto").value = totalResto;
    }
  }



</script>
</body>
</html>
