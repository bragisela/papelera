<?php
include("sesion.php");
$pagina='registroPedidosPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
include('sql/numPedido.php');
include('sql/selectProductos.php');
  $fech = Date("Y-m-d");
  $Fecha = Date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <link href="css/modal.css" rel="stylesheet">
</head>
<style>

.sidebarTomi {
  margin-top: 40px;
  margin-bottom: 10px;
  height: 86%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #243A51 !important;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebarTomi a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebarTomi a:hover {
  color: #f1f1f1;
}


.sidebarTomi .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

.blan {
  color: #f1f1f1;
}
#main {
  transition: margin-right .5s;
  padding: 16px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}

</style>

<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>

  <div id="mySidebar" class="sidebarTomi">
    <!-- contenido menu -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <table>
      <thead>
        <tr>
          <th class="th-sm blan">Producto</th>
          <th class="th-sm blan">Cantidad</th>
          <th class="th-sm blan">Precio</th>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" class="form-control"  id="idComprobantee" placeholder=" " value="" readonly> </td>
        </tr>
      </tbody>
    </table>
  </div>
<div class="container-fluid mt-3 col col-md-11">

  <div id="main" align="right">

    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Registro de Ventas</h3>
        <div class="card-body">
        <form method="post" id="total">
          <div class="card">
            <div class="card-header bg-light">Datos del Cliente</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <select class="mdb-select md-form" searchable="Buscar.." id="cliente" name="cliente">
                      <option value="" disabled selected>Cliente</option>
                      <?php
                      while($rowCliente = $resultadoClientes->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <option value="<?php echo $rowCliente['idCliente']; ?>"><?php echo  $rowCliente['nombre']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                    <div class="col-md-3 mb-3">
                      <div class="md-form">
                        <input type="date" class="form-control" name="fecha" value="<?php echo $fech; ?>">
                      </div>
                    </div>
                    <?php
                    if($codRol==1) { ?>
                      <div class="col-md-3 mb-3">
                        <select class="mdb-select md-form" searchable="Buscar.."  name="justificante" id="justificante"  onchange="calcularNumero(this);" required>
                          <option value="" disabled selected>Tipo</option>
                          <option value="R">Pedido Sin iva</option>
                          <option value="F">Factura</option>
                        </select>
                      </div>
                    <?php }  ?>

                    <?php
                    if($codRol==2) { ?>
                      <div class="col-md-3 mb-3">
                        <select class="mdb-select md-form" searchable="Buscar.."  name="justificante" id="justificante" onchange="calcularNumero(this);" required>
                          <option value="" disabled selected>Tipo</option>
                          <option value="F">Factura</option>
                        </select>
                      </div>
                    <?php }  ?>


                    <div class="col-md-3 mb-3">
                      <div class="md-form">
                        <input hidden  id="numero"   name="numero" oninput="calcularNumero(this);" value="<?php echo $numero; ?>">
                        <input class="form-control"  type="number" id="numeromod" name="Nro" value="0">
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
                </div>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="text-left header col-md-4 mb-4">
                 <h5>Listado de Productos</h5>
            </div>
            <div class="text-left header col-md-4 mb-4">
            </div>
            <div class="col-md-4 mb-4 text-right">
              <button  type="button" class="openbtn" onclick="openNav()">☰ Ultimos pedidos</button>
            </div>
          </div>

       <div class="row">

         <div class="col-md-6 mb-6">
           <select class="mdb-select md-form" searchable="Buscar.." data-width="auto" id="producto">
             <option value="" disabled selected="selected">Buscar Productos</option>
             <?php
               while($rowProductos = $resultadoProductosPedidos->fetch(PDO::FETCH_ASSOC)) {
                 $importe3 = bcdiv($rowProductos['importe2'], '1', 2);
                 $stock = $rowProductos['Stock'];
                 if ( $stock <= 0) {
                   $stock = "Sin stock";
                 }

             ?>
             <option value="<?php echo $rowProductos['idProducto']; ?>"><?php echo $rowProductos['codProducto']; echo " - ";echo $rowProductos['descripcion']; echo " - ";echo $importe3; echo " - ";echo $stock;     ; ?></option>
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
             <th class="th-sm">Stock</th>
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
           <td colspan="6"></td>
            <td>Importe Bruto</td>
            <td>
              <input class="form-control" type="number" id="totalImporte"  name="importebruto"  value="" readonly>
            </td>
            <td></td>
           </tr>
           <tr>
             <td colspan="6"></td>
             <td>IVA</td>
             <td><input class="form-control" type="number" id="iva"  name="iva" readonly></td>
             <td></td>
           </tr>
           <tr>
             <td colspan="6"></td>
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
         <input type="reset" name="Cancelar" value="Volver" class="btn btn-info" onClick="location.href='pedidosBuscar.php'">
       </div>
     </div>
   </form>
    <?php


        if (isset($_POST['insertar'])) {

            $proveedor = $_POST['cliente'];
            $fecha = $_POST['fecha'];
            $nro = $_POST['Nro'];
            //recibo factura $pago
            $justificante = $_POST['justificante'];
            $totalComprado = $_POST['totalfacturado'];
            $tipo = "V";
            $sqlCompro = insertComprobantes($nro,$proveedor,$fecha,$tipo,$justificante,$totalComprado,0,0);
            $conexiones->exec($sqlCompro);
            $idComprobante = $conexiones->lastInsertId();
            $sqlCaja = insertCajaIngreso($fecha,"I",$justificante,$nro,$totalComprado,"0");
            $conexiones->exec($sqlCaja);

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


             $queryUtilidad = "INSERT INTO utilidad(Comprobante,idProducto, impVenta, impCosto, impUtilidad, fecha, cliente, tipo) VALUES (:Comprobante, :idProducto, :impVenta, ((SELECT costoUni FROM productos WHERE idProducto=(:idProducto))*:cant), ((:impVenta) - ((SELECT costoUni FROM productos WHERE idProducto=(:idProducto))*:cant)),:fecha,:cliente,:justificante)";
              $iUtilidad = $conexiones->prepare($queryUtilidad);
              $iUtilidad->execute(
                array(
                  ':Comprobante'   => $nro,
                  ':idProducto'   => $_POST["sele"][$count],
                  ':impVenta'  => $_POST["importe"][$count]*$_POST["cantidad"][$count],
                  ':cant'  => $_POST["cantidad"][$count],
                  ':fecha' => $Fecha,
                  ':cliente' => $proveedor,
                  ':justificante' => $_POST['justificante']

                )
              );

              $queryStock = "INSERT INTO inventario(idProducto,fecha,totalVendido,idComprobante) VALUES (:idProducto, :fecha, :totalVendido, :idComprobante)";
              $iStock = $conexiones->prepare($queryStock);
              $iStock->execute(
                array(
                  ':idProducto'  => $_POST["sele"][$count],
                  ':fecha' => $Fecha,
                  ':totalVendido'  => $_POST["cantidad"][$count],
                  ':idComprobante'   => $idComprobante
                )
              );


            }
            echo "<script language='javascript'>";
            echo "alert('El pedido fue realizado correctamente');";
            echo "</script>";
            ?>

            <div class="modal">
            	<div class="contenido">
            		<br>
            	  <h2 align="center">¿Desea realizar el pago?</h2>
            			<br>
                  <input hidden id="comprobante4" name="comprobante" value="<?php echo $idComprobante; ?>">
                  <input class="btn btn-success btn-md btn-mar" type="text" name="aceptar" id="aceptar" onclick="accion(this);" value="Aceptar">
                  <input class="btn btn-info btn-md" type="text" name="cancelar" id="cancelar" onclick="accionn(this);" value="Cancelar">
              </div>
            </div>
            <?php

        }
     ?>
   </div>
 </div>
</section>
</div>
</div>
</main>
<?php
include("pie.php");
?>
<script type="text/javascript" src="scripts/getCliente.js"></script>
<script type="text/javascript" src="scripts/getCompro.js"></script>
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
    var cadena = text.split(separador)[1];
    var precio = text.split(separador)[2];
    var precio = parseFloat(precio);
    var cadena2 = text.split(separador)[3];

    var item = '<tr>';
    item = item +'<td>'+cod+'<input hidden class="form-control" type="number" name="sele[]" value="'+sel+'"></td>';
    item = item +'<td>'+cadena+'</td>';
    item = item +'<td><input class="form-control" type="number" id="cantidad[]" name="cantidad[]" oninput="calcularCantidad(this);" min="0"></td>';
    item = item +'<td><input class="form-control" type="text"    value="'+cadena2+'"  readonly></td>';
    item = item +'<td><input class="form-control" type="number" id="precio[]"  name="precio[]" oninput="Calcular(this);calcularCantidad(this);" value="'+precio+'" min="0" readonly></td>';
    item = item +'<td><input class="form-control" type="number" id="descuento[]" name="desc[]" oninput="Calcular(this);calcularCantidad(this);" value="0" min="0" max="100"></td>';
    item = item +'<td><input class="form-control" type="number" id="importe[]"  name="importe[]" readonly></td>';
    item = item +'<td><input class="form-control" type="number" id="total[]"  name="total[]" readonly></td>';
    item = item +'<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></div></td></tr>';
    if (sel !='') {
      $("#lista").append(item);
      $('#producto').val($('#producto > option:first').val());
    }
    }
    $(document).on('click', '.remove', function(){
      var totalEli = this.parentNode.parentNode.childNodes[6].childNodes[0].value;

      // comienzo iva segun select
      var iva = document.getElementById("iva");
      var condi = condicion; //
      switch (condi) {
        case 'R':
            var iv = parseFloat(iva.value) - parseFloat(((totalEli * 0)/100));
            break;
        case 'F':
            var iv = parseFloat(iva.value) - parseFloat(((totalEli * 21)/100));
            break;
        default:
            var iv = 1;
            break;
          }

      if (iv.toFixed(2)<=0) {
        iva.value = 0;
      }else{
        iva.value =  iv.toFixed(2);
      }
      var totalFac= document.getElementById("totalfac");
      var fac = parseFloat(totalFac.value) - (parseFloat(totalEli)  + parseFloat(((totalEli * 21)/100)));
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

    // comienzo iva segun select
    var condicion;
    var select = document.getElementById('justificante');
    select.addEventListener('change',
    function condicionIva2 (){
      var selectedOption = this.options[select.selectedIndex];
      var opcion = selectedOption.value;
      condicion=opcion;
    });

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

      var condi = condicion;
      switch (condi) {
        case 'R':
          var iva = 0;
          break;
        case 'F':
          var iva = (totalI*21)/100;
          break;
        default:
          var iva = 1;
          break;
      }

      iva =  isNaN(parseFloat(iva)) ? 0 : parseFloat(iva);
      document.getElementById("iva").value = iva.toFixed(2);
      var totalfactu = parseFloat(totalI) + parseFloat(iva);
      totalfactu = isNaN(parseFloat(totalfactu)) ? 0 : parseFloat(totalfactu);
      document.getElementById("totalfac").value = totalfactu.toFixed(2);

    }

    function calcularNumero(ele) {
      var numero = document.getElementById("numero").value;
      var justificante = document.getElementById("justificante").value;
      if (numero==0 && justificante=='R'){
        numero = 5000;
        document.getElementById("numeromod").value = numero;
      } else if (justificante=='R') {
        numero++;
        document.getElementById("numeromod").value = numero;
      }
      console.log(numero);
    }

    function accion(ele) {
      var comprobante = document.getElementById("comprobante4").value;
      var float = parseFloat(comprobante);
      var accion = document.getElementById("aceptar").value;
      switch (accion) {
          case 'Aceptar':
                      window.location='pedidoPago.php?idComprobante='+float;
          break;
      }
    }

    function accionn(ele) {
      var accion = document.getElementById("cancelar").value;
      switch (accion) {
          case 'Cancelar':
                         window.location='pedidosBuscar.php';
          break;
      }
    }
</script>
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "300px";
  document.getElementById("main").style.marginRight = "300px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginRight= "0";
}
</script>
</body>
</html>
