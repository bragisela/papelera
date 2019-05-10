<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
$servername = "localhost";
$username = "root";
$password = "";
$db = "dbpapelera";

try {
  $conexion = new PDO("mysql:host=$servername;dbname=$db", $username, $password, array('charset'=>'utf8'));
  $conexion->query("SET CHARACTER SET utf8");
  //setear el modo de error de PDO a exception
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbStatus = "Exitosa";
} catch(PDOException $e) {
  $dbStatus = "Fallo la conexion: " . utf8_encode($e->getMessage());
}
?>
