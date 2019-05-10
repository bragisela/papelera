<?php
  $pagina='productosBorrarPHP';
  include('conexion.php');

  $idProducto = $_REQUEST['idProducto'];

  $conexiones->exec("DELETE FROM productos WHERE idProducto='$idProducto'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../productos.php");
?>
