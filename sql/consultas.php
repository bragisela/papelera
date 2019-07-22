<?php
  include('conexion.php');

  $resultadoClientes = $conexiones->query("SELECT idCliente,nombre,cuit,condicionIVA,domicilioComercio,domicilioFiscal FROM clientes ORDER BY nombre")
  or die ('No se puede traer listado Clientes'.mysqli_error($conexiones));

  $resultadoProveedor = $conexiones->query("SELECT idProveedor,nombre,cuit,condicionIVA,domicilio FROM proveedores ORDER BY nombre")
  or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

  $resultadoProductos = $conexiones->query("SELECT idProducto,codProducto,descripcion,material,unidadEmbalaje,medidas,unidadMedida FROM productos ORDER BY codProducto")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $resultadoPedidos = $conexiones ->query("SELECT c.idComprobante, c.nroComprobante, c.fecha, p.nombre, p.domicilio FROM comprobantes c, proveedores p WHERE c.tipo='V' AND c.IdCliPro=p.idProveedor")
  or die ('No se puede traer listado Compras'.mysqli_error($conexiones));

  $resultadoCompras = $conexiones ->query("SELECT c.idComprobante, c.nroComprobante, c.fecha, p.nombre, p.domicilio FROM comprobantes c, proveedores p WHERE c.tipo='C' AND c.IdCliPro=p.idProveedor")
  or die ('No se puede traer listado Compras'.mysqli_error($conexiones));

  $resultadoCaja = $conexiones->query("SELECT fecha,idCajaTotal,descripcion,tipoMov,importe,nroCaja FROM caja ORDER BY idCajaTotal")
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $resultadoCajaInd = $conexiones->query("SELECT DISTINCT nroCaja FROM caja ORDER BY idCajaTotal") //Consulta los nro de caja para que no se repitan en el select.
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $resultadoCajaTemporal = $conexiones->query("SELECT fecha,idCaja,descripcion,tipoMov,importe FROM cajatemporal ORDER BY idCaja")
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $totalCajaTemporal = $conexiones->query("SELECT SUM(importe) as totalCajaTemporal FROM cajatemporal")
  or die ('No se puede traer listado Total'.mysqli_error($conexiones));
?>
