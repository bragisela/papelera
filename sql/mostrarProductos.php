<?php
  $pagina = 'mostrarProductos.php';
  include('conexion.php');
  // $idProducto = $_REQUEST['idProducto']; va en la pag donde se pide la consulta
  $mostrarProductos = $conexiones->query("SELECT idProducto,codProducto,descripcion,material,unidadEmbalaje,medidas,unidadMedida FROM productos WHERE idproducto = $idProducto")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMProductos = $mostrarProductos->fetch(PDO::FETCH_ASSOC);

  $PcodProdcuto = $rowMProductos['codProducto'];
  $PDescripcion = $rowMProductos['descripcion'];
  $PMaterial = $rowMProductos['material'];
  $PunidadEmbalaje = $rowMProductos['unidadEmbalaje'];
  $PMedidas = $rowMProductos['medidas'];
  $PunidadMedida = $rowMProductos['unidadMedida'];
?>
