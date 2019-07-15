<?php
include("sesion.php");
$pagina='reportesCajaPHP';
include("encabezado.php");
include("sql/conexion.php");
include("sql/consultas.php");
//include("segguridad.php");
include("menu.php");
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
        <h3 class="card-header primary-color white-text">Reporte de Caja</h3>
        <div class="card-body">
        <form method="post" id="total">
          <br>
          <div class="text-left header">
               <h5>Listado de Cajas</h5>
          </div>
       <div class="row">

         <div class="col-md-6 mb-6">
           <select class="mdb-select md-form" searchable="Buscar.." data-width="auto" id="producto">
             <option value="" disabled selected="selected">Buscar Productos</option>
             <?php
               while($rowCaja = $resultadoCaja->fetch(PDO::FETCH_ASSOC)) {
             ?>
             <option value="<?php echo $rowCaja['idCaja']; ?>"><?php echo $rowCaja['nroCaja']; ?></option>
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
             <th class="th-sm">Fecha</th>
             <th class="th-sm">Descipcion</th>
             <th class="th-sm">Importe</th>
           </tr>
         </thead>
         <tbody >
           <?php
           while($rowCaja = $resultadoCaja->fetch(PDO::FETCH_ASSOC)) {
             ?>
           <tr>
             <td><?php echo ($rowCaja['fecha']) ;?></td>
             <td><?php echo $rowCaja['descripcion']; $idCaja = $rowCaja['idCaja']; ?></td>
             <td><?php echo ($rowCaja['importe']);?>
             </td>
           </tr>
           <?php
           }
           ?>
         </tbody>
       </table>
     </div>
   </form>
    <?php


        if (isset($_POST['insertar'])) {

            $proveedor = $_POST['proveedor'];
            $fecha = $_POST['fecha'];
            $nro = $_POST['Nro'];
            $totalComprado = $_POST['importebruto'];
            $tipo = "C";
            $sqlCompro = insertComprobantes($nro,$proveedor,$fecha,$tipo,$totalComprado);
            $conexiones->exec($sqlCompro);
            $idComprobante = $conexiones->lastInsertId();

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

              // $queryInventario = "INSERT INTO inventario(idProducto,fecha,totalComprado) VALUES (:idProducto,:fecha, :totalComprado)";
              // $iInventario = $conexiones->prepare($queryInventario);
              // $iInventario->execute(
              //   array(
              //     ':idProducto'   => $_POST["sele"][$count],
              //     ':fecha'  => $Fecha,
              //     ':totalComprado'  => $_POST["precio"][$count]
              //   )
              // );

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

<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
          <h3 class="card-header primary-color-dark white-text"> Reporte de Caja </h3>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Fecha</th>
                      <th class="th-sm">NroCaja</th>
                      <th class="th-sm">Descripcion</th>
                      <th class="th-sm">Importe</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    while($rowCaja = $resultadoCaja->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php echo $rowCaja['fecha']; ?></td>
                        <td><?php echo "c " . $rowCaja['nroCaja']; ?></td>
                        <td><?php echo $rowCaja['descripcion']; ?></td>
                        <td><id="importe"  name="importe"><?php echo $rowCaja['importe']; ?></td>
                        <!--<td><?php echo "
                        <a href='cajaModificar.php?idCaja=$idCaja'><i class='far fa-edit'></i></i></a>
                        <a onClick='pDelete(this);' id='$idCaja'><i class='far fa-trash-alt'></i></a>"; ?></td>-->
                      </tr>
                      <?php
                    }
                    ?>


                  </tbody>
                  <tr>
                    <td colspan=""></td>
                    <td>Total</td>
                    <td><input class="form-control" type="number" id="totalcaja"  name="totalcaja" readonly></td>
                    <td></td>
                  </tr>
                </table>

              </div>
            </div>
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
  item = item +'<td><input class="form-control" type="number" id="precio[]"  name="precio[]" oninput="Calcular(this);calcularCantidad(this);" min="0"></td>';
  item = item +'<td><input class="form-control" type="number" id="descuento[]" name="desc[]" oninput="Calcular(this);calcularCantidad(this);" value="0" min="0" max="100"></td>';
  item = item +'<td><input class="form-control" type="number" id="importe[]"  name="importe[]" readonly></td>';
  item = item +'<td><input class="form-control" type="number" id="total[]"  name="total[]" readonly></td>';
  item = item +'<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">X</div></td></tr>';
  if (sel !='') {
    $("#lista").append(item);
    $('#producto').val($('#producto > option:first').val());
  }
  }
  $(document).on('click', '.remove', function(){
    var totalEli = this.parentNode.parentNode.childNodes[6].childNodes[0].value;
    var retencion = document.getElementById("retencion");
    var rete =  parseFloat(retencion.value) - parseFloat(((totalEli * 2.5)/100));
    if (rete.toFixed(2)<=0) {
      retencion.value = 0;
    }else{
      retencion.value =  rete.toFixed(2);
    }
    var iva = document.getElementById("iva");
    var iv = parseFloat(iva.value) - parseFloat(((totalEli * 21)/100));
    if (iv.toFixed(2)<=0) {
      iva.value = 0;
    }else{
      iva.value =  iv.toFixed(2);
    }
    var totalFac= document.getElementById("totalfac");
    var fac = parseFloat(totalFac.value) - (parseFloat(totalEli)  + parseFloat(((totalEli * 2.5)/100)) + parseFloat(((totalEli * 21)/100)));
    var totafac = isNaN(parseFloat(fac)) ? 0 : parseFloat(fac);
    if (totafac.toFixed(2)<=0) {
      totalFac.value = 0;
    }else{
      totalFac.value =  totafac.toFixed(2);
    }
    var totalImporte = document.getElementById("totalImporte");
    totalImporte.value = parseFloat(totalImporte.value) - parseFloat(totalEli);
    $(this).closest('tr').remove();
  });

  function Calcular(ele) {
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
    var retencion = (totalI*2.5)/100;
    retencion = isNaN(parseFloat(retencion)) ? 0 : parseFloat(retencion);
    document.getElementById("retencion").value = retencion.toFixed(2);
    var iva = (totalI*21)/100;
    iva =  isNaN(parseFloat(iva)) ? 0 : parseFloat(iva);
    document.getElementById("iva").value = iva.toFixed(2);
    var totalfactu = parseFloat(totalI) + parseFloat(retencion) + parseFloat(iva);
    totalfactu = isNaN(parseFloat(totalfactu)) ? 0 : parseFloat(totalfactu);
    document.getElementById("totalfac").value = totalfactu.toFixed(2);

  }


</script>
</body>
</html>
