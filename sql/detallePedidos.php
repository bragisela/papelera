<?php


$detallePedidos = $conexiones->query("SELECT pre.porcDesc,p.costoUni,c.totalcomprado,c.justificante,i.idItems, i.cant, p.descripcion, p.codProducto, pre.importe, pre.porcUtil, c.nroComprobante from comprobantes as c
inner join items as i on c.idComprobante=i.idComprobante
inner join productos as p on i.idProducto=p.idProducto
inner join precios as pre on i.idItems=pre.idPrecio
where c.idComprobante='$idPedido' and c.tipo='V'")
or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

$total= $detallePedidos->rowCount();

?>
