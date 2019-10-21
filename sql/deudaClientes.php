<?php
  include('conexion.php');

$resultadoDeuda = $conexiones->query("SELECT cli.idCliente, cli.nombre, cli.domicilioComercio, cli.domicilioFiscal, SUM(co.totalcomprado) as deuda from clientes as cli
inner join comprobantes as co on cli.idCliente=co.IdCliPro where co.tipo='V'
and co.activo='0' group by cli.idCliente")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

?>
