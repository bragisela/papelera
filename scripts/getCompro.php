<style>
.bla{
  color: black;
  font-size: 16px;

}

table {
	width: 100%;
}

.bo{
  border-top: 1px solid;
  border-color: black;
}

</style>
<?php
include_once("../sql/conexion.php");

  $buscar = $_POST['listado'];


  if(isset($buscar)) {
    //traer ultimos 3 comprobantes
    $sql2= $conexiones->query("SELECT co.idComprobante from comprobantes as co
    inner join clientes as cli on co.IdCliPro=cli.idCliente
    where cli.idCliente= ".$buscar." AND co.tipo='V' ORDER BY co.idComprobante DESC LIMIT 3 ")
    or die ('No se puede traer listado de este Cliente'.mysqli_error($conexiones));


    echo "<div class='table-wrapper-scroll-y my-custom-scrollbar'>
          <table class'table-bordered table-striped mb-0'>
            <thead>
              <tr>
                <th class='bla'>Fecha</th>
                <th class='bla'>Producto</th>
                <th class='bla'>Cantidad</th>
                <th class='bla'>Precio</th>
              </tr>
            </thead>";
      echo "<tbody> ";
      while($rowCO = $sql2->fetch()) {
        //recorrer cada detalle de comprobante
        $pre = $rowCO["idComprobante"];

        $sql= $conexiones->query("SELECT pro.descripcion,co.fecha, pre.importe, i.cant from items as i
        inner join productos as pro on i.idProducto=pro.idProducto
        inner join precios as pre on i.idItems=pre.idPrecio
        inner join comprobantes as co on co.idComprobante=i.idComprobante
        inner join clientes as cli on co.IdCliPro=cli.idCliente
        where cli.idCliente= ".$buscar." AND co.tipo='V' AND co.idComprobante= ".$pre." ")
        or die ('No se puede traer listado de este Cliente'.mysqli_error($conexiones));

        if($sql->execute()) {
            $sql->setFetchMode(PDO::FETCH_ASSOC);
        }
                  while($row = $sql->fetch()) {
                    $pre = $row["importe"];
                    $cant = $row["cant"];
                    $fec = $row["fecha"];
                    $fec2 = date("d/m/Y", strtotime($fec));
                    $des = $row["descripcion"];
                    $pre = bcdiv($pre, '1', 2);
                   echo "<tr>
                   <td class='bla bo'  style='width:24%;'>".$fec2."</td>
                    <td class='bla bo'  style='width:34%;'>".$des."</td>
                    <td class='bla bo' align='center' style='width:18%;'>".$cant."</td>
                    <td class='bla bo'  style='width:26%;'>$ ".$pre."</td>
                  </tr>";
                }


    }
    echo "</tbody>
       </table>
       </div>";


    }
  else {
  	echo " <h1> No se han encontrado resultados </h1>";
  }
?>
