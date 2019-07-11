<?php

  include('conexion.php');
  $mostrarUltCompraPrecioMod = $conexiones->query("SELECT p.idprecio, i.idComprobante,po.idProducto,po.codProducto,po.descripcion,p.importe,p.porcDesc, p.porcUtil FROM productos as po
  inner join precios as p on po.idproducto=p.idproducto
  inner join items as i on p.idPrecio=i.idItems
  WHERE p.idPrecio=$idPrecio and po.idProducto=$idProducto and i.idComprobante=$idComprobante")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMProductosPreUltCompra = $mostrarUltCompraPrecioMod ->fetch(PDO::FETCH_ASSOC);

  $peUltIdComprobante= $rowMProductosPreUltCompra['idComprobante'];
  $peUltIdPrecio = $rowMProductosPreUltCompra['idprecio'];
  $peUltCodProducto = $rowMProductosPreUltCompra['codProducto'];
  $peUltDescripcion = $rowMProductosPreUltCompra['descripcion'];
  $peUltidProducto = $rowMProductosPreUltCompra['idProducto'];
  $peUltImporte = $rowMProductosPreUltCompra['importe'];
  $peUltPorcDesc=  $rowMProductosPreUltCompra['porcDesc'];
  $peUltPorcUtil = $rowMProductosPreUltCompra['porcUtil'];
  ?>
