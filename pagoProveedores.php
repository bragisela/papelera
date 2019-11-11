<?php
include("sesion.php");
$pagina='pagoProveedoresPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include('sql/pagoProveedores.php');

//INICIO EXCEL

$total_rows = 2;

$download_filelink = '<ul class="list-unstyled">';


if(isset($_POST["export"]) && isset($_POST["desde"])!="" && isset($_POST["hasta"])!="")
{
	require_once 'class/PHPExcel.php';


	$last_page = ceil($total_rows/10000);
	$start = 0;
	$file_number = 0;

	for($count = 0; $count < $last_page; $count++)
	{


		$file_number++;
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array("Proveedor","Domicilio","Ultimo pago", "Se debe por proveedor");
		$column = 0;
    $object->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $object->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $object->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

			$column++;
		}

		$query = "
    SELECT pro.idProveedor,pro.nombre, pro.domicilio, sum(co.totalcomprado)-sum(pa.importe) as deuda, pa.fecha FROM proveedores as pro
    INNER join comprobantes as co on co.IdCliPro=pro.idProveedor
    inner join pagos as pa on pa.idComprobante=co.idComprobante
    where co.fecha BETWEEN CAST('".$_POST["desde"]."' AS DATE) AND CAST('".$_POST["hasta"]."' AS DATE)
    and co.tipo='c' and co.activo=0  GROUP by co.IdCliPro order by deuda ASC
		";
		$statement = $conexiones->prepare($query);
		$statement->execute();
		$excel_result = $statement->fetchAll();

    //recorrer array con los datos filtrados por campaña para descargar

    $excel_row = 2;
    $totalImporte=0;
		foreach($excel_result as $sub_row)
		{


      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sub_row["nombre"]);
      $object->getActiveSheet()->getColumnDimension('A')->setWidth("21");
      $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sub_row["domicilio"]);
      $object->getActiveSheet()->getColumnDimension('B')->setWidth("21");
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $sub_row["fecha"]);
      $object->getActiveSheet()->getColumnDimension('C')->setWidth("21");
      $deuda = $sub_row["deuda"];
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, "$ $deuda");
      $object->getActiveSheet()->getColumnDimension('D')->setWidth("21");
      $object->getActiveSheet()->getColumnDimension('E')->setWidth("21");
      $totalImporte=$totalImporte+$sub_row["deuda"];
      $totalImporte = bcdiv($totalImporte, '1', 2);
			$excel_row++;
		}
      $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row+1, "DEUDA TOTAL:");
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row+1, "$ $totalImporte  " );


			// FALTA DESC, EXENTOS, NETO GRAVADO

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$file_name = 'Estado deuda '.$_POST["desde"].' a '.$_POST["hasta"].'.xls';
		$object_writer->save($file_name);
    // nombre archivo exceñ
		$download_filelink .= '<li><label><a href="download.php?filename='.$file_name.'" target="_blank">Descargar - '.$file_name.'</a></label></li>';
	}
	$download_filelink .= '</ul>';
}
else {
	echo "Seleccione una campaña";
}
// FIN EXCEL

?>
<!DOCTYPE html>
<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->
<main>
  <div class="container-fluid mt-5">
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Descargar listado de deudas proveedores</h3>
          <form class=" text-left border border-light p-5" method="post">
            <div class="form-row mb-4">
              <div class="col-md-3 col-sm-6">
                <label>Desde</label>
                <div class="md-form" style="margin-top: -10px;">
                  <input type="date" class="form-control" name="desde" value="">
                </div>
              </div>
              <div class="col-md-3 col-sm-6" >
                <label>Hasta</label>
                <div class="md-form" style="margin-top: -10px;">
                  <input type="date" class="form-control" name="hasta" value="">
                </div>
              </div>
              <div class="md-form col-lg-2 col-md-2 col-sm-3" style="margin-top: 8px;">
                <input  type="submit" name="export" class="btn btn-success" value="Seleccionar" />
              </div>
              <div class="md-form col-lg-3 col-md-4 col-sm-12 margen7" style="margin-top: -2px;" >
                <?php echo $download_filelink; ?>
              </div>
            </div>
          </form>
      </div>
    </section>
    <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Pago de Proveedores</h3>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Nombre</th>
                    <th class="th-sm">Domicilio</th>
                    <th class="th-sm">Ultimo pago</th>
                    <th class="th-sm">Deuda</th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $deudaTotal=0;
                  while($rowProveedores = $resultadoDeuda->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                      <td><?php echo $rowProveedores['nombre'];  $idProveedor = $rowProveedores['idProveedor']; ?></td>
                      <td><?php echo $rowProveedores['domicilio']; ?></td>
                      <td><?php echo $rowProveedores['fecha'];  ?></td>
                      <td> <?php
                      if ($rowProveedores['deuda']!=0){
                        echo "$ " . $rowProveedores['deuda'] . "";
                      } else {
                        echo "Sin deuda";
                      }?></td>
                      <td><?php echo "
                      <a href='proveedoresComprobantes.php?idProveedor=$idProveedor' title='Ver comprobantes'><i class='fas fa-asterisk'></i></a>
                      "; ?></td>
                    </tr>
                    <?php
                    $deudaTotal = $deudaTotal + $rowProveedores['deuda'];
                  }

                  ?>
                </tbody>
                <tfoot>
                    <tr>
                      <td colspan="3"></td>
                      <td style="font-weight: bold; font-size:18px; "> Deuda total  $ <?php echo $deudaTotal;  ?>  </td>
                    </tr>
                  </tfoot>
              </table>
            </div>
          </div>
      </div>
    </section>
  </div>
</main>

<?php
include("pie.php");
?>
<script>
// SideNav Button Initialization
$(".button-collapse").sideNav();
// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);

function pDelete(element) {
  if(confirm('Esta seguro que quiere eliminar el producto?'))
    window.location.href = "sql/proveedorBorrar.php?idProveedor=" + element.id;
}
</script>
</body>
</html>
