<?php
include("sesion.php");
$pagina='reporteVentasPHP';
include("encabezado.php");
include("sql/conexion.php");
include("seguridad.php");
$fech = Date("Y-m-d");
$Fecha = Date("Y-m-d H:i:s");

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
		$table_columns = array("Fecha","Comprobante","Proveedores", "Cuit", "Importe bruto" , "Desc" , "Neto Gravado", "No grav exentos", "IVA", "Total Facturado" );
		$column = 0;
		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$query = "
    SELECT prov.nombre, prov.cuit, c.idcomprobante, c.nrocomprobante, c.fecha, c.totalcomprado from proveedores as prov
    inner join comprobantes as c on c.IdCliPro=prov.idProveedor
    where c.fecha BETWEEN CAST('".$_POST["desde"]."' AS DATE) AND CAST('".$_POST["hasta"]."' AS DATE) AND c.justificante='F' AND c.tipo='V'
		";
		$statement = $conexiones->prepare($query);
		$statement->execute();
		$excel_result = $statement->fetchAll();
		$excel_row = 2;
    $totalFac=0;
    $totalIva=0;
    $totalDesc=0;
    $totalImporte=0;
    $totalNoExento=0;
    $totalGravado=0;
    //recorrer array con los datos filtrados por campaña para descargar
		foreach($excel_result as $sub_row)
		{
      $iva=((21*$sub_row["totalcomprado"])/100);
      $iva = bcdiv($iva, '1', 2);
      $facturado= $sub_row["totalcomprado"] + $iva;
      $facturado = bcdiv($facturado, '1', 2);

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sub_row["fecha"]);
			$object->getActiveSheet()->getColumnDimension('A')->setWidth("15");
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sub_row["nrocomprobante"]);
			$object->getActiveSheet()->getColumnDimension('B')->setWidth("15");
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $sub_row["nombre"]);
			$object->getActiveSheet()->getColumnDimension('C')->setWidth("15");
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $sub_row["cuit"]);
			$object->getActiveSheet()->getColumnDimension('D')->setWidth("15");
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $sub_row["totalcomprado"]);
			$object->getActiveSheet()->getColumnDimension('E')->setWidth("15");
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, 0);
			$object->getActiveSheet()->getColumnDimension('F')->setWidth("15");
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $sub_row["totalcomprado"]);
			$object->getActiveSheet()->getColumnDimension('G')->setWidth("15");
      $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, 0);
			$object->getActiveSheet()->getColumnDimension('H')->setWidth("15");
      $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $iva);
			$object->getActiveSheet()->getColumnDimension('I')->setWidth("15");
      $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $facturado);
			$object->getActiveSheet()->getColumnDimension('J')->setWidth("15");
      $totalImporte=$totalImporte+$sub_row["totalcomprado"];
      $totalDesc=$totalDesc;
      $totalNoExento=$totalNoExento;
      $totalGravado=$totalGravado+$sub_row["totalcomprado"];
      $totalFac=$totalFac+$facturado;
      $totalFac = bcdiv($totalFac, '1', 2);
      $totalIva=$totalIva+$iva;
      $totalIva = bcdiv($totalIva, '1', 2);
			$excel_row++;
		}

      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Totales");
      $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $totalImporte);
      $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $totalDesc);
      $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $totalGravado);
      $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $totalNoExento);
      $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $totalIva);
      $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $totalFac);
      // FALTA DESC, EXENTOS, NETO GRAVADO


		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$file_name = 'Libro Iva Ventas '.$_POST["desde"].' a '.$_POST["hasta"].'.xls';
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

</style>
<body class="hidden-sn mdb-skin">
  <main>
    <div class="container-fluid mt-5">
      <section class="pb-5">
      <div class="card text-center">
        <h3 class="card-header primary-color white-text">Descargar Libro Iva Ventas a Excel</h3>
        <form class=" text-left border border-light p-5" method="post">

          <div class="form-row mb-4">


            <div class="col-md-3 col-sm-6">
              <label>Desde</label>
              <div class="md-form" style="margin-top: -10px;">
                <input type="date" class="form-control" name="desde" value="<?php echo $fech; ?>">
              </div>
            </div>


            <div class="col-md-3 col-sm-6" >
              <label>Hasta</label>
              <div class="md-form" style="margin-top: -10px;">
                <input type="date" class="form-control" name="hasta" value="<?php echo $fech; ?>">
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
    </div>
  </main>
<!--Main Layout-->

<?php
include("pie.php");
?>
<script>

$(document).ready(function() {
  $('.mdb-select').materialSelect();
});
// SideNav Button Initialization
$(".button-collapse").sideNav();
// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);


</script>
</body>
</html>
