<?php

require('conexion.php');

$getRepCaja = $conexiones->query("SELECT idCajaTotal,fecha, descripcion, importe, nroCaja
from caja
GROUP by idCajaTotal");




?>
