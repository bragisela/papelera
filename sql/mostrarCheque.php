<?php


  include('conexion.php');
  $mostrarCheque = $conexiones->query("SELECT idCheque,banco,importe,numero,plazo,activo from cheques where idCheque='$idCheque'")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowC = $mostrarCheque->fetch(PDO::FETCH_ASSOC);

  $CheId = $rowC ['idCheque'];
  $CheBanco = $rowC ['banco'];
  $CheImporte = $rowC ['importe'];
  $CheNumero = $rowC ['numero'];
  $ChePlazo = $rowC ['plazo'];
  //$ChePlazo  = substr($ChePlazo, 0, -15);
  $CheActivo = $rowC ['activo'];
?>
