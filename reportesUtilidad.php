<?php
include("sesion.php");
$pagina='reportesUtilidadPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
include("sql/consultas.php");
include("sql/listados.php");
$fech = Date("Y-m-d");

//INICIO EXCEL

$total_rows = $getRepUtil->rowCount();

$download_filelink = '<ul class="list-unstyled">';

if(isset($_POST["export"]) && isset($_POST["desdeU"])!="" && isset($_POST["hastaU"])!="")
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
		$table_columns = array("Fecha","Tipo","Comprobante","Utilidad");
		$column = 0;
		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$query = "
    SELECT idUtilidad, tipo, fecha, comprobante, (SUM(impUtilidad))
    from utilidad
		WHERE fecha
		BETWEEN CAST('".$_POST["desdeU"]."' AS DATE) AND CAST('".$_POST["hastaU"]."' AS DATE)
    GROUP by comprobante
		";
		$statement = $conexiones->prepare($query);
		$statement->execute();
		$excel_result = $statement->fetchAll();
		$excel_row = 2;


    //recorrer array con los datos filtrados por comprobante para descargar
		foreach($excel_result as $sub_row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $sub_row["fecha"]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $sub_row["tipo"] );
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $sub_row["comprobante"]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $sub_row["(SUM(impUtilidad))"]);
			$excel_row++;
		}
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$file_name = 'ReporteUtilidad-'.($_POST["desdeU"])."-"."a"."-".($_POST["hastaU"]).'.xls';
		$object_writer->save($file_name);
    // nombre archivo exceñ
		$download_filelink .= '<li><label><a href="download.php?filename='.$file_name.'" target="_blank">Descargar - '.$file_name.'</a></label></li>';
	}
	$download_filelink .= '</ul>';
}
else {
	echo "Seleccione un número de comprobante";
}
// FIN EXCEL

?>

<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */
</style>
<body class="hidden-sn mdb-skin">
<!--Main Layout-->

<main>
  <div class="container-fluid">
   <section id="margen2">
      <form class=" text-left border border-light p-5" method="post">
         <div class="form-row mb-4">
					 <!--
           <div class="col-md-3 col-sm-6" >
               <select name="comprobante"  class="mdb-select md-form" searchable="Nro de comprobantes..">
                 <option value="" disabled selected>Elija el número de comprobante</option>
                   <?php //Select de los números de comprobantes.
									 	if ($codRol==1) {
                     while($rowUtilidad = $resultadoUtilidadSuper->fetch(PDO::FETCH_ASSOC)) {
                       ?>
                         <option value="<?php echo $rowUtilidad['comprobante']; ?>"><?php echo $rowUtilidad['tipo']; ?>-<?php echo  $rowUtilidad['comprobante']; ?></option>
                       <?php
                     }
									 }
									 if ($codRol==2) {
										while($rowUtilidad = $resultadoUtilidad->fetch(PDO::FETCH_ASSOC)) {
											?>
												<option value="<?php echo $rowUtilidad['comprobante']; ?>"><?php echo $rowUtilidad['tipo']; ?>-<?php echo  $rowUtilidad['comprobante']; ?></option>
											<?php
										}
									}
                   ?>
               </select>
               <label class="mdb-main-label">Comprobantes</label>
           </div> -->

					 <div class="col-md-3 col-sm-6">
						 <label>Desde</label>
						 <div class="md-form" style="margin-top: -10px;">
							 <input type="date" class="form-control" name="desdeU" value="<?php echo $fech; ?>">
						 </div>
					 </div>


					 <div class="col-md-3 col-sm-6" >
						 <label>Hasta</label>
						 <div class="md-form" style="margin-top: -10px;">
							 <input type="date" class="form-control" name="hastaU" value="<?php echo $fech; ?>">
						 </div>
					 </div>

           <div class="md-form col-lg-3 col-md-4  col-sm-6  margen7 ">
             <input type="submit" name="export" class="btn btn-success" value="Seleccionar" />
           </div>

           <div class="md-form col-lg-3 col-md-4 col-sm-12 margen7" >
             <?php echo $download_filelink; ?>
           </div>

         </div>
      </form>
   </section>

    <section >
    	<table   class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
      	<thead>
        	<tr>
						<th class="th-sm">Fecha</th>
            <th class="th-sm">Comprobante Nº</th>
            <th class="th-sm">Utilidad Total</th>
          </tr>
        </thead>
      	<tbody>
          <?php
					if (isset($_POST["export"]) && isset($_POST["desdeU"])!="" && isset($_POST["hastaU"])!=""){
          	while(($rowUtilidad = $getRepUtil->fetch(PDO::FETCH_ASSOC)) && ($rowUtilidadTotal = $totalUtilidad->fetch(PDO::FETCH_ASSOC))) {
							if(($_POST["desdeU"])<=($rowUtilidad['fecha']) && ($_POST["hastaU"])>=($rowUtilidad['fecha'])) {
								echo "<tr>";
								echo "<th>" . $rowUtilidad['fecha'] . "</th>";
								echo "<th>" . $rowUtilidad['tipo'] . "-" . $rowUtilidad['comprobante'] . "</th>";
								echo "<th>" . $rowUtilidadTotal['totalUtilidad'] . "</th>";
								 		}
							 		}
						 		}
                 ?>

        </tbody>
      </table>
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
const ps = new PerfectScrollbar(sideNavScrollbar);
//Ps.initialize(sideNavScrollbar);

$(document).ready(function() {
  $('.mdb-select').materialSelect();
});

</script>
</body>
</html>
