<?php
  $pagina='clientesBorrarPHP';
  include('conexion.php');

  $idCliente = $_REQUEST['idCliente'];

  $conexiones->exec("DELETE FROM clientes WHERE idCliente='$idCliente'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../clientes.php");
?>
