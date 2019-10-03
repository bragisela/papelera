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

$comprobantes = $conexiones->query("SELECT co.idComprobante,co.tipo,co.nroComprobante, co.totalcomprado, co.fecha, pa.activo from comprobantes as co
inner join pagos as pa on co.idComprobante=pa.idComprobante
WHERE co.idCliPro=$idProveedor")
or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));
?>
