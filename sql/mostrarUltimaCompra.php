<?php
  $pagina = 'mostrarUltimaCompra.php';
  include('conexion.php');
  $MostrarUltCompra = $conexiones->query("SELECT pre.idPrecio, i.idProducto, pre.importe, pre.porcDesc, pre.porcUtil, pre.fecha from items as i 
  inner join precios as pre on i.idItems=pre.idPrecio
  where i.idComprobante=$idComprobante")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));
?>
