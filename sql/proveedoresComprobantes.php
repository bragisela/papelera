<?php
include('conexion.php');

$proveedor= $conexiones->query("SELECT * FROM `proveedores` WHERE idProveedor=$idProveedor")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

while($rowProv = $proveedor->fetch(PDO::FETCH_ASSOC)) {
  $nombre = $rowProv['nombre'];
  $cuit = $rowProv['cuit'];
  $condicioniva = $rowProv['condicionIVA'];
  $domicilio = $rowProv['domicilio'];
}

$comprobantes = $conexiones->query("SELECT co.idComprobante,co.justificante,co.tipo,co.nroComprobante, co.totalcomprado, co.fecha, pa.activo from comprobantes as co
inner join pagos as pa on co.idComprobante=pa.idComprobante
WHERE co.idCliPro=$idProveedor and co.activo=0 and co.tipo='C'")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

$saldoAcumulado = $conexiones->query("SELECT sum(co.totalcomprado) as saldo from comprobantes as co
inner join pagos as pa on co.idComprobante=pa.idComprobante
WHERE tempPago=1 and co.idCliPro=$idProveedor")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

while($rowSA = $saldoAcumulado->fetch(PDO::FETCH_ASSOC)) {
  $saldo = $rowSA['saldo'];
}

$cheques = $conexiones->query("SELECT pa.modoPago,pa.idPago, pa.banco, pa.importe, pa.numero, pa.plazo from pagos as pa
where pa.activo=0  AND pa.modoPago='Cheque'")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

$comprobante2 = $conexiones->query("SELECT co.idComprobante  from comprobantes as co
inner join pagos as pa on co.idComprobante=pa.idComprobante
WHERE tempPago=1 and co.idCliPro=$idProveedor group by co.idComprobante")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

while($rowco3 = $comprobante2->fetch(PDO::FETCH_ASSOC))
  $idCom = $rowco3['idComprobante'];


?>
