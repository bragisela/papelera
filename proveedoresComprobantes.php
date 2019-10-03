<?php
include("sesion.php");
$pagina='proveedoresComprobantesPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
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
          <h3 class="card-header primary-color white-text">Datos del proveedor</h3>
          <div class="card-body">
            <form method="post">
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
              </div>
              <br>
              <div class="text-left header">
                   <h5>Listado de Comprobantes</h5>
              </div>

              <div class="row">
                <div class="col-md-6 mb-6">
                  <select class="mdb-select md-form" searchable="Buscar.." data-width="auto" id="producto">
                    <option value="" disabled selected="selected">Buscar Comprobantes</option>
                    <?php
                      while($rowC = $comprobantes->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                    <option value="<?php echo $rowC ['idComprobante']; ?>"><?php echo $rowC ['tipo']; echo " - ";echo $rowC ['nroComprobante']; echo " - "; echo $rowC ['fecha']; echo " - ";echo $rowC ['totalcomprado'];; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-2 mb-2">
                <br>
                  <button type="button" class="btn btn-primary btn-sm" onclick="agregarProducto();" id="resetear">Seleccionar</button>
                </div>
              </div>

              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped text-left " cellspacing="0" width="100%" id="item_table">
                  <thead>
                    <tr>
                      <th class="th-sm">Tipo comprobante</th>
                      <th class="th-sm">Nro Comprobante</th>
                      <th class="th-sm">Fecha</th>
                      <th class="th-sm">totalComprado</th>
                      <th class="th-sm">Acciones<!--<button type="button" name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#basicExampleModal"><i class="fas fa-plus fa-l"></i></button>--></th>
                    </tr>
                  </thead>
                  <tbody id="lista">

                  </tbody>
                  <tfoot>
                    <tr>
                    <td colspan="2"></td>
                     <td>Saldo acumulado</td>
                     <td>
                       <input class="form-control" type="number" id="saldoAcumulado"  name="saldoAcumulado"  value="0" readonly>
                     </td>
                     <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
          </div>
        </div>
      </form>
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

  function agregarProducto() {
    var sel = $('#producto').find(':selected').val();
    var text = $('#producto').find(':selected').text();
    var separador = "-";
    var limite = 1;
    var cod = text.split(separador, limite);
    var nro = text.split(separador)[1];
    var f1 = text.split(separador)[2];
    var f2 = text.split(separador)[3];
    var f3 = text.split(separador)[4];
    var f4 = text.split(separador)[5];
    var fecha = f1+'-'+f2+'-'+f3;
    var totalComprado= isNaN(parseFloat(f4)) ? 0 : parseFloat(f4);

    var item = '<tr>';

    item = item +'<td>'+cod+'<input hidden class="form-control" type="number" name="sele[]" value="'+sel+'"></td>';
    item = item +'<td><input class="form-control" type="text"    value="'+nro+'"  readonly></td>';
    item = item +'<td><input class="form-control" type="text"    value="'+fecha+'"  readonly></td>';
    item = item +'<td><input class="form-control" type="number" id="importe[]"  name="importe[]"   value="'+totalComprado+'" min="0" readonly></td>';
    item = item +'<th><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></div></td></tr>';
    if (sel !='') {
      $("#lista").append(item);
      $('#producto').val($('#producto > option:first').val());
    }
    }

    function calcularCantidad(ele) {
      var cantidad = 0 ,precio = 0, descuento = 0, total = 0;
      var tr = ele.parentNode.parentNode;
      var nodes = tr.childNodes;

      for (var x = 0; x<nodes.length;x++) {
        if (nodes[x].firstChild.id == 'importe[]') {
          precio = parseFloat(nodes[x].firstChild.value,10);
          var preci= isNaN(parseFloat(precio)) ? 0 : parseFloat(precio);
        }
      }

      var efect = 0;
      var saldoAcumulado = document.getElementById("saldoAcumulado").value;
      saldoAcumulado= isNaN(parseFloat(saldoAcumulado)) ? 0 : parseFloat(saldoAcumulado);
      var efect2= isNaN(parseFloat(efect)) ? 0 : parseFloat(efect);
      var totalCheque2 = isNaN(parseFloat(preci)) ? 0 : parseFloat(preci);
      var totalPagado = totalCheque2+saldoAcumulado;
      document.getElementById("saldoAcumulado").value = totalPagado;


    }

</script>
</body>
</html>
