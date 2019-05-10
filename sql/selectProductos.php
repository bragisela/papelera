<?php

function selectProductos($conexiones)
{
 $output = '';
 $query = "SELECT idProducto,descripcion FROM productos";
 $statement = $conexiones->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
   $output .= '<option value="'.$row["idProducto"].'">'.rtrim($row["descripcion"]).'</option>';
 }
 return $output;
}


function selectProductosCod($conexiones)
{
 $output = '';
 $query = "SELECT idProducto,codProducto,descripcion FROM productos";
 $statement = $conexiones->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["idProducto"].'">'.rtrim($row["codProducto"]).'</option>';
 }
 return $output;
}


?>
