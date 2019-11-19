<?php
include("sesion.php");
$pagina='registroComprasPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
include('sql/selectProductos.php');
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
          <h3 class="card-header primary-color white-text">Registro de Compras</h3>
          <div class="card-body">
            <form method="post" id="total">
              <div class="card">
                <div class="card-header bg-light">Datos del Proveedor</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <select class="mdb-select md-form" searchable="Buscar.." id="proveedor" name="proveedor">
                        <option value="" disabled selected>Razon Social</option>
                        <?php
                        while($rowProveedores = $resultadoProveedor->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                          <option value="<?php echo $rowProveedores['idProveedor']; ?>"><?php echo  $rowProveedores['nombre']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4 mb-4">
                      <div class="md-form">
                        <input type="date" class="form-control" name="fecha" value="<?php echo $fech; ?>">
                      </div>
                    </div>

                    <?php
                    if($codRol==1) { ?>
                      <div class="col-md-2 mb-2">
                        <select class="mdb-select md-form" searchable="Buscar.."  name="justificante" id="justificante" required>
                          <option value="" disabled selected>Tipo</option>
                          <option value="C1">Compra Iva 10.5</option>
                          <option value="C2">Compra Sin Iva</option>
                          <option value="F">Factura</option>
                        </select>
                      </div>
                    <?php }  ?>

                    <?php
                    if($codRol==2) { ?>
                      <div class="col-md-1 mb-2">
                        <select class="mdb-select md-form" searchable="Buscar.."  name="justificante" id="justificante" required>
                          <option value="" disabled selected>Tipo</option>
                          <option value="F">Factura</option>
                        </select>
                      </div>
                    <?php }  ?>

                    <div class="col-md-2 mb-2">
                      <div class="md-form">
                        <input type="text" id="form3" class="form-control" name="Nro">
                        <label for="form3" class="">Nro Comprobante</label>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <div class="md-form">
                        <input type="text" class="form-control" name="Domicilio" value="" id="domicilio" placeholder=" " readonly>
                        <label for="form3" class="">Domicilio</label>
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <div class="md-form">
                        <input type="text" class="form-control" id="cuit" placeholder=" " readonly>
                        <label for="">CUIT</label>
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <div class="md-form">
                        <input type="text" class="form-control" name="CondicionIVA" id="condiIVA" placeholder=" " readonly>
                        <label for="form3" class="">Condicion IVA</label>
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <div class="md-form">
                        <input type="hidden" class="form-control" name="rete" id="rete2" placeholder=" " readonly>
                        <label for="form3" class="">Retensor</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="text-left header">
                <h5>Listado de Productos</h5>
              </div>
              <div class="row">

                <div class="col-md-6 mb-6">
                  <select class="mdb-select md-form" searchable="Buscar.." data-width="auto" id="producto">
                    <option value="" disabled selected="selected">Buscar Productos</option>
                    <?php
                    while($rowProductos = $resultadoProductos->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <option value="<?php echo $rowProductos['idProducto']; ?>"><?php echo $rowProductos['codProducto']; echo " - ";echo $rowProductos['descripcion'];; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-2 mb-2">
                  <br>
                  <button type="button" class="btn btn-primary btn-sm" onclick="agregarProducto();" id="resetear">Agregar</button>
                </div>
              </div>

              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped text-left " cellspacing="0" width="100%" id="item_table">
                  <thead>
                    <tr>
                      <th class="th-sm">cod Producto</th>
                      <th class="th-sm">Producto</th>
                      <th class="th-sm">Cantidad</th>
                      <th class="th-sm">Precio</th>
                      <th class="th-sm">% Desc</th>
                      <th class="th-sm">Importe</th>
                      <th class="th-sm">Total</th>
                      <th class="th-sm">Acciones<!--<button type="button" name="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#basicExampleModal"><i class="fas fa-plus fa-l"></i></button>--></th>
                    </tr>
                  </thead>
                  <tbody id="lista">

                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                      <td>Importe Bruto</td>
                      <td>
                        <input class="form-control" type="number" id="totalImporte"  name="importebruto"  value="" readonly>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="5"></td>
                      <td>Retencion IIBB</td>
                      <td><input class="form-control" type="number" id="retencion"  name="retencion" readonly></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="5"></td>
                      <td>IVA</td>
                      <td><input class="form-control" type="number" id="iva"  name="iva" readonly></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="5"></td>
                      <td>Total Facturado</td>
                      <td><input class="form-control" type="number" id="totalfac"  name="totalfacturado" readonly></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="row">
                <div class="col-md-8 mb-8"> </div>
                <div class="col-md-4 mb-4">
                  <input type="submit" name="insertar" value="Guardar" class="btn btn-success">
                  <input type="reset" name="Cancelar" value="Volver" class="btn btn-info" onClick="location.href='comprasBuscar.php'">

                </div>
              </div>
            </form>
            <?php


            if (isset($_POST['insertar'])) {

              $proveedor = $_POST['proveedor'];
              $fecha = $_POST['fecha'];
              $nro = $_POST['Nro'];
              $justificante = $_POST['justificante'];
              $totalComprado = $_POST['importebruto'];
              $tipo = "C";
              $sqlCompro = insertComprobantes($nro,$proveedor,$fecha,$tipo,$justificante,$totalComprado,0,0);
              $conexiones->exec($sqlCompro);
              $idComprobante = $conexiones->lastInsertId();
              $sqlCaja = insertCajaEgreso ($fecha,"E",$justificante,$nro,$totalComprado,"0"); //Migrar total comprado a cajatemporal.
              $conexiones->exec($sqlCaja);
              //insert pago porque da error al relacionar pagos con comprobantes para calcular deudas
              $pagos = $conexiones->query("INSERT INTO pagos (modoPago,banco,importe,numero,plazo,idComprobante,activo)
              VALUES ('-','-',0,'-','-',$idComprobante,0)");
              for($count = 0; $count < count($_POST["sele"]); $count++)
              {
                $queryItems = "INSERT INTO items(idComprobante, idProducto, fecha, cant) VALUES (:idComprobante, :idProducto, :fecha, :cant)";
                $iItems = $conexiones->prepare($queryItems);
                $iItems->execute(
                  array(
                    ':idComprobante'   => $idComprobante,
                    ':idProducto'  => $_POST["sele"][$count],
                    ':fecha' => $Fecha,
                    ':cant'  => $_POST["cantidad"][$count]
                  )
                );

                $queryPrecio = "INSERT INTO precios(idProducto, importe, porcDesc, fecha) VALUES (:idProducto, :importe, :porcDesc, :fecha)";
                $iPrecio = $conexiones->prepare($queryPrecio);
                $iPrecio->execute(
                  array(
                    ':idProducto'   => $_POST["sele"][$count],
                    ':importe'  => $_POST["precio"][$count],
                    ':porcDesc' => $_POST["desc"][$count],
                    ':fecha'  => $Fecha
                  )
                );

                $queryProducto = "UPDATE productos SET costoUni =  (:importe) WHERE idProducto=(:idProducto)";
                $iProducto = $conexiones->prepare($queryProducto);
                $iProducto->execute(
                  array(
                   ':idProducto'   => $_POST["sele"][$count],
                   ':importe'  => $_POST["importe"][$count]

                 )
                );

                $queryStock = "INSERT INTO inventario(idProducto,fecha,totalComprado,idComprobante) VALUES (:idProducto, :fecha, :totalComprado, :idComprobante)";
                $iStock = $conexiones->prepare($queryStock);
                $iStock->execute(
                  array(
                    ':idProducto'  => $_POST["sele"][$count],
                    ':fecha' => $Fecha,
                    ':totalComprado'  => $_POST["cantidad"][$count],
                    ':idComprobante'   => $idComprobante
                  )
                );


              }

              echo "<script language='javascript'>";
              echo "alert('El Producto se ingreso correctamente');";
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
  <script type="text/javascript" src="scripts/getProveedores.js"></script>
  <script>

  function esRetensor(){
    var retensorr= document.getElementById("rete2").value;
    return retensorr;
  }



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
    var cadena = text.split(separador)[1];
    var item = '<tr>';
    item = item +'<td>'+cod+'<input hidden class="form-control" type="number" name="sele[]" value="'+sel+'"></td>';
    item = item +'<td>'+cadena+'</td>';
    item = item +'<td><input class="form-control" type="number" id="cantidad[]" name="cantidad[]" oninput="calcularCantidad(this);" min="0"></td>';
    item = item +'<td><input class="form-control" type="number" step="any" id="precio[]"  name="precio[]" oninput="Calcular(this);calcularCantidad(this);" min="0"></td>';
    item = item +'<td><input class="form-control" type="number" id="descuento[]" name="desc[]" oninput="Calcular(this);calcularCantidad(this);" value="0" min="0" max="100"></td>';
    item = item +'<td><input class="form-control" type="number" id="importe[]"  name="importe[]" readonly></td>';
    item = item +'<td><input class="form-control" type="number" id="total[]"  name="total[]" readonly></td>';
    item = item +'<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">X</div></td></tr>';
    if (sel !='') {
      $("#lista").append(item);
      $('#producto').val($('#producto > option:first').val());
    }
    var retensor = esRetensor();
  }

  //eliminar
  $(document).on('click', '.remove', function(){
    var totalEli = this.parentNode.parentNode.childNodes[6].childNodes[0].value;
    var iva = document.getElementById("iva");
    var soyiva= isNaN(parseFloat(iva)) ? 0 : parseFloat(iva);
    console.log(soyiva);
    var condi = condicion; //
    switch (condi) {
      case 'C1':
          var iv = 0;
          break;
      case 'C2':
          var iv = 0;
          break;
      case 'F':
          var iv = parseFloat(iva.value) - parseFloat(((totalEli * 21)/100));
          break;
      default:
          var iv = 0;
          break;
        }

    var retensor = esRetensor();
    if(retensor==0){
      var retencion = document.getElementById("retencion");
      var rete = 0;
    }else{
      var retencion = document.getElementById("retencion");
      var rete =  parseFloat(retencion.value) - parseFloat(((totalEli * 2.5)/100));
    }
    if (iv.toFixed(2)<=0) {
      iva.value = 0;
    }else{
      iva.value =  iv.toFixed(2);
    }
    if (rete.toFixed(2)<=0) {
      retencion.value = 0;
    }else{
      retencion.value =  rete.toFixed(2);
    }

    switch (condi) {
      case 'C1':
          var totalFac= document.getElementById("totalfac");
          var fac = parseFloat(totalFac.value) - (parseFloat(totalEli));

          break;
      case 'C2':
          var totalFac= document.getElementById("totalfac");
          var fac = parseFloat(totalFac.value) - (parseFloat(totalEli));
          break;
      case 'F':
              var totalFac= document.getElementById("totalfac");
              var fac = parseFloat(totalFac.value) - (parseFloat(totalEli)  + parseFloat(((totalEli * 21)/100)));
          break;
      default:
          var totafac = 0;
          break;
        }

        if(retensor==0){
          var totafac = isNaN(parseFloat(fac)) ? 0 : parseFloat(fac);
        }else{
          var fac = fac -  parseFloat(((totalEli * 2.5)/100));
          var totafac = isNaN(parseFloat(fac)) ? 0 : parseFloat(fac);
        }


    if (totafac.toFixed(2)<=0) {
      totalFac.value = 0;
    }else{
      totalFac.value =  totafac.toFixed(2);
    }
    var totalImporte = document.getElementById("totalImporte");
    totalImporte.value = parseFloat(totalImporte.value) - parseFloat(totalEli);
    $(this).closest('tr').remove();
  });
  //fin eliminar

  function Calcular(ele) {
    var retensor = esRetensor();
    var precio = 0, descuento = 0, importe = 0 ;
    var tr = ele.parentNode.parentNode;
    var nodes = tr.childNodes;
    for (var x = 0; x<nodes.length;x++) {
      if (nodes[x].firstChild.id == 'precio[]') {
        precio = parseFloat(nodes[x].firstChild.value,10);
        var preci= isNaN(parseFloat(precio)) ? 0 : parseFloat(precio);
      }
      if (nodes[x].firstChild.id == 'descuento[]') {
        descuento = parseFloat(nodes[x].firstChild.value,10);
        var desc= isNaN(parseFloat(descuento)) ? 0 : parseFloat(descuento);
      }
      if (nodes[x].firstChild.id == 'importe[]') {
        anterior = nodes[x].firstChild.value;
        importe = parseFloat((preci-((preci*desc)/100)),10);
        var importa= isNaN(parseFloat(importe)) ? 0 : parseFloat(importe);
        var aa = importa.toFixed(2);
        nodes[x].firstChild.value = aa;
      }
    }
  }



  // comienzo iva segun select
  var condicion;
  var select = document.getElementById('justificante');
  select.addEventListener('change',
  function condicionIva2 (){
    var selectedOption = this.options[select.selectedIndex];
    var opcion = selectedOption.value;
    condicion=opcion;
    recalcular();
    var retensor = esRetensor();
  });
  //fin select



  function calcularCantidad(ele) {
    var cantidad = 0 ,precio = 0, descuento = 0, total = 0;
    var tr = ele.parentNode.parentNode;
    var nodes = tr.childNodes;

    for (var x = 0; x<nodes.length;x++) {
      if (nodes[x].firstChild.id == 'cantidad[]') {
        cantidad = parseFloat(nodes[x].firstChild.value,10);
        var cant= isNaN(parseFloat(cantidad)) ? 0 : parseFloat(cantidad);
      }
      if (nodes[x].firstChild.id == 'precio[]') {
        precio = parseFloat(nodes[x].firstChild.value,10);
        var preci= isNaN(parseFloat(precio)) ? 0 : parseFloat(precio);
      }
      if (nodes[x].firstChild.id == 'descuento[]') {
        descuento = parseFloat(nodes[x].firstChild.value,10);
        var desc= isNaN(parseFloat(descuento)) ? 0 : parseFloat(descuento);
      }
      if (nodes[x].firstChild.id == 'total[]') {
        anterior = nodes[x].firstChild.value;
        total = parseFloat(cant*(preci-((preci*desc)/100)),10);
        var tot= isNaN(parseFloat(total)) ? 0 : parseFloat(total);
        var bb = tot.toFixed(2);
        nodes[x].firstChild.value = bb;
      }

    }

    var totalI = document.getElementById("totalImporte").value;
    totalI= isNaN(parseFloat(totalI)) ? 0 : parseFloat(totalI);
    var h = totalI +tot - anterior;
    totalI = h.toFixed(2);
    document.getElementById("totalImporte").value = totalI;

    switch (condicion) {
      case 'C1':
        var iva = 0;
        break;
      case 'C2':
        var iva = 0;
        break;
      case 'F':
        var iva = (totalI*21)/100;
        break;
      default:
        var iva = 0;
        break;
    }

    //traer retensor de la base de dato por proveedor

    var retensor = esRetensor();
    if (retensor==0){
      var retencion = 0;
    } else {
        var retencion = (totalI*2.5)/100;
        retencion = isNaN(parseFloat(retencion)) ? 0 : parseFloat(retencion);
      }
    document.getElementById("retencion").value = retencion.toFixed(2);

    iva =  isNaN(parseFloat(iva)) ? 0 : parseFloat(iva);
    document.getElementById("iva").value = iva.toFixed(2);

    var totalfactu = parseFloat(totalI) + parseFloat(retencion) + parseFloat(iva);
    totalfactu = isNaN(parseFloat(totalfactu)) ? 0 : parseFloat(totalfactu);
    document.getElementById("totalfac").value = totalfactu.toFixed(2);
  }

  function recalcular() {
    var totalI = document.getElementById("totalImporte").value;

    switch (condicion) {
      case 'C1':
        var iva = 0;
        break;
      case 'C2':
        var iva = 0;
        break;
      case 'F':
        var iva = (totalI*21)/100;
        break;
      default:
        var iva = 0;
        break;
    }

    var retensor = esRetensor();
    if (retensor==0){
      var retencion = 0;
    } else {
        var retencion = (totalI*2.5)/100;
        retencion = isNaN(parseFloat(retencion)) ? 0 : parseFloat(retencion);
      }
    document.getElementById("retencion").value = retencion.toFixed(2);

    iva =  isNaN(parseFloat(iva)) ? 0 : parseFloat(iva);
    document.getElementById("iva").value = iva.toFixed(2);

    var totalfactu = parseFloat(totalI) + parseFloat(retencion) + parseFloat(iva);
    totalfactu = isNaN(parseFloat(totalfactu)) ? 0 : parseFloat(totalfactu);
    document.getElementById("totalfac").value = totalfactu.toFixed(2);
  }


</script>
</body>
</html>
