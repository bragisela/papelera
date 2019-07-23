<?php

  $pagina = 'mostrarImprimirPedido.php';
  include('conexion.php');

  $mostrarPedidoImprimirCalculos = $conexiones->query("SELECT c.idComprobante, c.fecha, p.codproducto, p.descripcion, i.cant, pre.importe, pre.porcUtil from comprobantes as c
    inner join items as i on i.idComprobante=c.idComprobante
    inner join productos as p on i.idProducto=p.idProducto
    inner JOIN precios as pre on pre.idPrecio=i.idItems
    where c.idComprobante = $idComprobante")
  or die ('No se puede traer listado comprobante'.mysqli_error($conexiones));

  $mostrarPedidoImprimirDatos = $conexiones->query("SELECT cl.nombre, cl.condicionIVA, cl.cuit, cl.domicilioComercio , c.nrocomprobante, c.fecha from comprobantes as c
  inner join clientes as cl on c.IdCliPro=cl.idCliente
  where c.idComprobante = $idComprobante")
  or die ('No se puede traer listado comprobante'.mysqli_error($conexiones));

  $rowImprimir2 = $mostrarPedidoImprimirDatos ->fetch(PDO::FETCH_ASSOC);

  $nroComprobante2 = $rowImprimir2['nrocomprobante'];
  $fecha2 = $rowImprimir2['fecha'];
  $nombre2 = $rowImprimir2['nombre'];
  $cuit2 = $rowImprimir2['cuit'];
  $domicilio2 = $rowImprimir2['domicilioComercio'];
  $condIva2 = $rowImprimir2['condicionIVA'];

?>
