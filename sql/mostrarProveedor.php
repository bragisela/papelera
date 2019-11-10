<?php
  $pagina = 'mostrarProveedorPHP';
  include('conexion.php');
  // $idProducto = $_REQUEST['idProducto']; va en la pag donde se pide la consulta
  $mostrarProveedor = $conexiones->query("SELECT nombre,cuit,condicionIVA,domicilio,rete FROM proveedores WHERE idProveedor = $idProveedor")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMProveedor = $mostrarProveedor->fetch(PDO::FETCH_ASSOC);

  $ProNombre = $rowMProveedor['nombre'];
  $ProCuit = $rowMProveedor['cuit'];
  $ProCondicionIva = $rowMProveedor['condicionIVA'];
  $ProDomicilio = $rowMProveedor['domicilio'];
  $Prete = $rowMProveedor['rete'];
?>
