<?php
  $pagina = 'mostrarCaja.php';
  include('conexion.php');
  $idCaja = $_REQUEST['idCaja']; //va en la pag donde se pide la consulta

  $mostrarCaja = $conexiones->query("SELECT importe,descripcion,tipoMov FROM cajatemporal WHERE idCaja = $idCaja")
  or die ('No se puede traer listado de Caja'.mysqli_error($conexiones));

  $rowMCaja = $mostrarCaja->fetch(PDO::FETCH_ASSOC);

  $Pfecha = $rowMCaja['fecha'];
  $PDescripcion = $rowMCaja['descripcion'];
  $PImporte = $rowMCaja['importe'];
  $PtipoMov = $rowMCaja['tipoMov']

?>
