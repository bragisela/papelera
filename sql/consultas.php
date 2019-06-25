<?php
  include('conexion.php');

  $resultadoClientes = $conexiones->query("SELECT idCliente,nombre,cuit,condicionIVA,domicilioComercio,domicilioFiscal FROM clientes ORDER BY nombre")
  or die ('No se puede traer listado Clientes'.mysqli_error($conexiones));

  $resultadoProveedor = $conexiones->query("SELECT idProveedor,nombre,cuit,condicionIVA,domicilio FROM proveedores ORDER BY nombre")
  or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

  $resultadoProductos = $conexiones->query("SELECT idProducto,codProducto,descripcion,material,unidadEmbalaje,medidas,unidadMedida FROM productos ORDER BY codProducto")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $resultadoCompras = $conexiones ->query("SELECT c.idComprobante, c.nroComprobante, c.fecha, p.nombre, p.domicilio FROM comprobantes c, proveedores p WHERE c.tipo='C' AND c.IdCliPro=p.idProveedor")
  or die ('No se puede traer listado Compras'.mysqli_error($conexiones));

  $resultadoCaja = $conexiones->query("SELECT fecha,idCaja,descripcion,tipoMov,importe FROM caja ORDER BY idCaja")
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $totalCaja = $conexiones->query("SELECT SUM(importe) as totalCaja FROM caja")
  or die ('No se puede traer listado Total'.mysqli_error($conexiones));
?>
