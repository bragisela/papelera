<?php
$idComprobante = $_REQUEST['idComprobante'];
include('sql/mostrarImprimirPedido.php');

// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('lib/pdf/autoload.inc.php');
ob_start();

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html= '
<head>
<link rel="stylesheet" type="text/css" href="css/imprimir.css" media="screen" />
</head>
<table>
            <tr>
                <td colspan="4" class="center bor" ><h2>Presupuesto '.$nroComprobante2.' </h2></td>
            </tr>
            <tr>
                <td colspan="2" class="izq bor" >Sres: ' . $nombre2 .' </td>
                <td colspan="2" class="der bor" >CUIT: ' . $cuit2 .' </td>
            </tr>
            <tr>
                <td colspan="2" class="izq bor bot" >Domicilio:  '. $domicilio2 .'</td>
                <td colspan="2" class="der bor bot1" >Fecha:  '. $fecha2 .'</td>
            </tr>
            <tr>
                <th  class="center bor size0"> CANTIDAD </th>
                <th  class="center bor size1"> DESCRIPCION </th>
                <th  class="center bor size2"> P UNITARIO </th>
                <th  class="center bor size3"> TOTAL </th>
              </tr>';
            $i=1;
            $subtotal=0;
            $iva=0.21;
            $import=0;
            $cantidad=0;
            while($rowImprimir = $mostrarPedidoImprimirCalculos->fetch(PDO::FETCH_ASSOC)) {
            $html.=' <tr>
                <td  class="center bor size0" > '.    $rowImprimir['cant'] .' </td>
                <td class="center bor size1"> '. $rowImprimir['descripcion'] .' </td>
                <td  class="center bor size2"> '.  $rowImprimir['importe'] .' </td>
                <td  class="center bor size3"> '.  $rowImprimir['importe'] * $rowImprimir['cant'] .' </td>
              </tr>';
          $cantidad = $cantidad + $rowImprimir['cant'];
          $subtotal = $subtotal + $rowImprimir['importe'] * $rowImprimir['cant'];
          $i=$i+1;
          $rowImprimir['importe']=0;
          $rowImprimir['cant']=0;

          }
          $iva= $subtotal*$iva;
          $total= $subtotal+$iva;
          

        $html.= '
        <tr>
            <th  class="center bor size0"></th>
            <th class="center bor size1"></th>
            <th  class="center bor size2"> SUB TOTAL </th>
            <th  class="center bor size3"> $'. $subtotal .'</th>
          </tr>
          <tr>
              <th  class="center bor size0"></th>
              <th class="center bor size1"></th>
              <th class="center bor size2"> IVA 21% </th>
              <th  class="center bor size3">  $ '.$iva.'</th>
            </tr>
            <tr>
                <th  class="center bor size0"> '. $cantidad .'</th>
                <th class="center bor size1"></th>
                <th  class="center bor size2"> TOTAL </th>
                <th  class="center bor size3"> $ '.$total.' </th>
              </tr>
        </table>

';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("order.pdf", array("Attachment" => 0));

?>
