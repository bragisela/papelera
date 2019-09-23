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
                      <input  class="form-control" type="number" id="efectivo" name="efectivo" oninput="calcularCheque(this);" min="0" required>
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
                  <div class="col-md-4 mb-4">
                    <div class="md-form">
                      <input type="number" id="form3" class="form-control" name="cantCheque" required>
                      <label for="form3" class="">Cantidad de cheques</label>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <br>
   </form>
    <?php


     ?>
   </div>
 </div>
</section>
</div>
</main>
<?php
include("pie.php");
?>
<script type="text/javascript" src="scripts/getCliente.js"></script>
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



</script>
</body>
</html>
