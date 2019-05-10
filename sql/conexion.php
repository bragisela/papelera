<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
$servername = "localhost";
$username = "root";
$password = "";
$db = "dbpapel";

try {
  $conexiones = new PDO("mysql:host=$servername;dbname=$db", $username, $password, array('charset'=>'utf8'));
  $conexiones->query("SET CHARACTER SET utf8");
  //setear el modo de error de PDO a exception
  $conexiones->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbStatus = "Exitosa";
} catch(PDOException $e) {
  $dbStatus = "Fallo la conexion: " . utf8_encode($e->getMessage());
}
?>
