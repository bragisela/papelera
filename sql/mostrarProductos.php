<?php
  $pagina = 'mostrarProductos.php';
  include('conexion.php');
  // $idProducto = $_REQUEST['idProducto']; va en la pag donde se pide la consulta
  $mostrarProductos = $conexiones->query("SELECT po.idProducto,po.codProducto,po.descripcion,po.material,po.unidadEmbalaje,po.medidas,po.unidadMedida,po.idProveedor, prov.nombre FROM productos  as po
    inner join proveedores as prov on prov.idProveedor=po.idProveedor
    WHERE po.idproducto = $idProducto")
  or die ('No se puede traer listado Productos'.mysqli_error($conexiones));

  $rowMProductos = $mostrarProductos->fetch(PDO::FETCH_ASSOC);

  $PcodProdcuto = $rowMProductos['codProducto'];
  $PDescripcion = $rowMProductos['descripcion'];
  $PMaterial = $rowMProductos['material'];
  $PunidadEmbalaje = $rowMProductos['unidadEmbalaje'];
  $PMedidas = $rowMProductos['medidas'];
  $PunidadMedida = $rowMProductos['unidadMedida'];
  $Pprov = $rowMProductos['idProveedor'];
  $Pnom = $rowMProductos['nombre'];
?>
