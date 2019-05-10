<?php
  $pagina = 'mostrarProductos.php';
  include('conexion.php');
  // $idProducto = $_REQUEST['idProducto']; va en la pag donde se pide la consulta
  $mostrarPrecios = $conexiones->query("SELECT idPrecio, idProducto, importe, porcDesc, porcUtil,fecha FROM precios WHERE idProducto = $idProducto")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $Precio = $conexiones->query("SELECT porcUtil FROM precios WHERE idProducto = $idProducto ORDER BY fecha ASC")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMPrecio = $Precio->fetch(PDO::FETCH_ASSOC);

  $porcUtil = $rowMPrecio['porcUtil'];

?>
