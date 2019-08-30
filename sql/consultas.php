<?php
  include('conexion.php');

  $resultadoClientes = $conexiones->query("SELECT idCliente,nombre,cuit,condicionIVA,domicilioComercio,domicilioFiscal FROM clientes ORDER BY nombre")
  or die ('No se puede traer listado Clientes'.mysqli_error($conexiones));

  $resultadoProveedor = $conexiones->query("SELECT idProveedor,nombre,cuit,condicionIVA,domicilio FROM proveedores ORDER BY nombre")
  or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));

  $resultadoProductos = $conexiones->query("SELECT pro.idProducto,pro.codProducto,pro.descripcion,pro.material,pro.unidadEmbalaje,pro.medidas,pro.unidadMedida FROM productos as pro
")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $resultadoProductosPedidos = $conexiones->query("SELECT pro.descripcion, pro.codProducto, t1.idPrecio,t1.idProducto,t1.importe, (t1.importe+(t1.porcUtil*t1.importe/100)) as importe2 FROM precios as t1 INNER JOIN ( SELECT idProducto,max(idPrecio) as fecha FROM precios GROUP BY idProducto) as t2 ON t1.idPrecio = t2.fecha AND t1.idProducto = t2.idProducto inner join productos as pro on t1.idProducto=pro.idProducto")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $resultadoPedidos = $conexiones ->query("SELECT c.idComprobante, c.nroComprobante, c.fecha, cl.nombre, cl.domicilioComercio FROM comprobantes c, clientes cl WHERE c.tipo='V' AND c.IdCliPro=cl.idCliente")
  or die ('No se puede traer listado Compras'.mysqli_error($conexiones));

  $resultadoCompras = $conexiones ->query("SELECT c.idComprobante, c.nroComprobante, c.fecha, p.nombre, p.domicilio FROM comprobantes c, proveedores p WHERE c.tipo='C' AND c.IdCliPro=p.idProveedor")
  or die ('No se puede traer listado Compras'.mysqli_error($conexiones));

  $resultadoCaja = $conexiones->query("SELECT fecha,idCajaTotal,descripcion,tipoMov,importe,nroCaja FROM caja ORDER BY idCajaTotal")
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $resultadoCajaInd = $conexiones->query("SELECT DISTINCT nroCaja FROM caja ORDER BY idCajaTotal") //Consulta los nro de caja para que no se repitan en el select.
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $resultadoUtilidad = $conexiones->query("SELECT DISTINCT comprobante FROM utilidad ORDER BY idUtilidad") //Consulta los nro de comprobante para que no se repitan en el select.
  or die ('No se puede traer listado Utilidad'.mysqli_error($conexiones));

  $resultadoCajaTemporal = $conexiones->query("SELECT fecha,idCaja,descripcion,tipoMov,importe FROM cajatemporal ORDER BY idCaja")
  or die ('No se puede traer listado Caja'.mysqli_error($conexiones));

  $totalCajaTemporal = $conexiones->query("SELECT SUM(importe) as totalCajaTemporal FROM cajatemporal")
  or die ('No se puede traer listado Total'.mysqli_error($conexiones));

  $totalUtilidad = $conexiones->query("SELECT SUM(impUtilidad) as totalUtilidad FROM utilidad GROUP BY comprobante")
  or die ('No se puede traer listado Total'.mysqli_error($conexiones));
?>
