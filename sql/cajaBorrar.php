<?php
  $pagina='cajaBorrarPHP';
  include('conexion.php');

  $idCaja = $_REQUEST['idCaja'];

  $conexiones->exec("DELETE FROM cajatemporal WHERE idCaja='$idCaja'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../caja.php");
?>
