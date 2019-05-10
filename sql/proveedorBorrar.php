<?php
  $pagina='proveedorBorrarPHP';
  include('conexion.php');

  $idProveedor = $_REQUEST['idProveedor'];

  $conexiones->exec("DELETE FROM proveedores WHERE idProveedor='$idProveedor'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../proveedores.php");
?>
