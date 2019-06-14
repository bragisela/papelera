<?php
  $pagina = 'mostrarProductos.php';
  include('conexion.php');
  // $idProducto = $_REQUEST['idProducto']; va en la pag donde se pide la consulta
  $mostrarProductosPre = $conexiones->query("SELECT p.idprecio, po.idProducto,po.codProducto,po.descripcion,p.importe,p.porcDesc, p.porcUtil FROM productos as po
  inner join precios as p on po.idproducto=p.idproducto WHERE p.idPrecio=$idPrecio and po.idProducto=$idProducto
")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMProductosPre = $mostrarProductosPre->fetch(PDO::FETCH_ASSOC);

  $peIdPrecio = $rowMProductosPre['idprecio'];
  $peCodProducto = $rowMProductosPre['codProducto'];
  $peDescripcion = $rowMProductosPre['descripcion'];
  $idProducto = $rowMProductosPre['idProducto'];
  $peImporte = $rowMProductosPre['importe'];
  $pePorcDesc=  $rowMProductosPre['porcDesc'];
  $pePorcUtil = $rowMProductosPre['porcUtil'];



?>
