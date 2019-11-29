<?php
  $pagina = 'mostrarUltimaCompra.php';
  include('conexion.php');
  $MostrarUltCompra = $conexiones->query("SELECT p.descripcion, pre.idPrecio, i.idProducto, pre.importe, pre.porcDesc, pre.porcUtil, pre.fecha
     from items as i
  inner join precios as pre on i.idItems=pre.idPrecio inner join productos as p on i.idProducto=p.idProducto
  where i.idComprobante=$idComprobante")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $MostrarUltCompra2 = $conexiones->query("SELECT p.idProducto, p.costoUni from items as i
    inner join precios as pre on i.idItems=pre.idPrecio 
    inner join productos as p on i.idProducto=p.idProducto where i.idComprobante=$idComprobante")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));
?>
