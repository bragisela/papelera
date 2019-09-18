<?php
  include('conexion.php');

$detalleCompras = $conexiones->query("SELECT c.justificante,i.cant, p.descripcion, p.codProducto, pre.importe, pre.porcDesc from comprobantes as c
inner join items as i on c.idComprobante=i.idComprobante
inner join productos as p on i.idProducto=p.idProducto
inner join precios as pre on i.idItems=pre.idPrecio
where c.idComprobante='$idCompra' and c.tipo='C'")
or die ('No se puede traer listado Productos'.mysqli_error($conexiones));



?>
