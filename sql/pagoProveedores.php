<?php
  include('conexion.php');



  $resultadoDeuda = $conexiones->query("SELECT pro.idProveedor,pro.nombre, pro.domicilio, sum(co.totalcomprado)-sum(pa.importe) as deuda, pa.fecha FROM proveedores as pro
  INNER join comprobantes as co on co.IdCliPro=pro.idProveedor
  inner join pagos as pa on pa.idComprobante=co.idComprobante
  where co.activo=0 GROUP by co.IdCliPro")
  or die ('No se puede traer listado Proveedores'.mysqli_error($conexiones));







?>
