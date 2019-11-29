<?php
  $pagina = 'mostrarProveedorPHP';
  include('conexion.php');
  // $idProducto = $_REQUEST['idProducto']; va en la pag donde se pide la consulta
  $mostrarProveedor = $conexiones->query("SELECT count(pro.idProveedor) as cant,prov.nombre,prov.cuit,prov.condicionIVA,prov.domicilio,prov.rete FROM proveedores as prov
  inner join productos as pro on prov.idProveedor=pro.idProveedor
  WHERE prov.idProveedor = $idProveedor")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMProveedor = $mostrarProveedor->fetch(PDO::FETCH_ASSOC);

  $ProNombre = $rowMProveedor['nombre'];
  $ProCuit = $rowMProveedor['cuit'];
  $ProCondicionIva = $rowMProveedor['condicionIVA'];
  $ProDomicilio = $rowMProveedor['domicilio'];
  $Prete = $rowMProveedor['rete'];
  $cant = $rowMProveedor['cant'];

  $mostrarProductos = $conexiones->query("SELECT pro.idProducto,pro.costoUni FROM proveedores as prov
  inner join productos as pro on prov.idProveedor=pro.idProveedor
  WHERE prov.idProveedor = $idProveedor")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));
?>
