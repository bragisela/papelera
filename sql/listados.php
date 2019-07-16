<?php

require('conexion.php');

$getCaja = $conexiones->query("SELECT idCajaTotal,fecha, descripcion, importe, nroCaja
from caja
GROUP by idCajaTotal");




?>
