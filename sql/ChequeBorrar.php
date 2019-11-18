<?php

  include('conexion.php');

  $idCheque = $_REQUEST['idCheque'];

  $conexiones->exec("DELETE FROM cheques WHERE idCheque='$idCheque'")or die ('Problemas en la Baja'.mysqli_error($conexiones));

  header("Location:../cheques.php");
?>
