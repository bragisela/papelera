<?php
  include('conexion.php');

$resultadoDeuda = $conexiones->query("SELECT cli.idCliente, cli.nombre, cli.cuit, cli.condicionIVA ,  cli.domicilioComercio, cli.domicilioFiscal, SUM(co.totalcomprado) as deuda from clientes as cli
inner join comprobantes as co on cli.idCliente=co.IdCliPro where co.tipo='V'
and co.activo='0' and cli.idCliente='$idCliente'")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

$rowCli = $resultadoDeuda->fetch(PDO::FETCH_ASSOC);

$nombre= $rowCli['nombre'];
$cuit = $rowCli['cuit'];
$iva = $rowCli['condicionIVA'];
$domFiscal= $rowCli['domicilioFiscal'];
$domComercio= $rowCli['domicilioComercio'];


?>
