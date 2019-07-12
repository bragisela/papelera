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
<link rel="stylesheet" type="text/css" href="css/imprimirRemito.css" media="screen" />
</head>
<body>
<div class="margen">';
//primer rectangulo
for($i=0;$i<12;$i++){
  $html.= '<br>';
}

$html.= '

<table>

            <tr>
              <th class="bor r1 bot" colspan="2">Señores:  ' . $nombre2 .'</th>
              <th class="bor r3 bot1" colspan="2"></th>
            </tr>
            <tr>
              <th class="bor r2" colspan="2">Domicilio:</th>
              <th class="bor r4 bot1" colspan="2">Cond IVA: '.$condIva2.'</th>
            </tr>
            <tr>
              <th class="bor r2" colspan="2">Localidad: Saladillo</th>
              <th class="bor r4" colspan="2">Cuit: '.$cuit2.'</th>
            </tr>
            <tr>
              <th class="bor r2" colspan="2">Provincia: Buenos Aires</th>
              <th class="bor r4" colspan="2">Factura Num: '.$nroComprobante2.' </th>
            </tr>
            <tr>
              <th class="bor" colspan="4">Remitimos a Ud(s) la siguiente Mercaderia:</th>
            </tr>
            </table>
            <table>
            <tr>
                <th  class="center bor size0"> CANTIDAD </th>
                <th  class="center bor size1 r5"> DESCRIPCION </th>
              </tr>';
            $i=1;
            $subtotal=0;
            $iva=0.21;
            $import=0;
            $cantidad=0;
            while($rowImprimir = $mostrarPedidoImprimirCalculos->fetch(PDO::FETCH_ASSOC)) {
            $html.=' <tr>
                <td  class="center bor size0 fila0" > '.    $rowImprimir['cant'] .'  </td>
                <td class="center bor size1 fila1 "> '. $rowImprimir['descripcion'] .'  </td>
              </tr>';
          $cantidad = $cantidad + $rowImprimir['cant'];
          $subtotal = $subtotal + $rowImprimir['importe'] * $rowImprimir['cant'];
          $i=$i+1;
          $rowImprimir['importe']=0;
          $rowImprimir['cant']=0;

          }
          $iva= $subtotal*$iva;
          $total= $subtotal+$iva;
          for($i;$i<25;$i++){
            $html.=' <tr>
                <td  class="center bor size0 fila0" > </td>
                <td class="center bor size1 fila1">  </td>
              </tr>';
          }


        $html.= '
            <tr>
                <th  class="center bor size0"> '. $cantidad .'</th>
                <th class="center bor size1"></th>
              </tr>
        </table>
        <table>
          <tr>
            <td class="center bor footer1" colspan="2">..............................................................</td>
            <th class="center bor footer2" colspan="2">..............................................................</th>
          </tr>
          <tr>
            <th class="center bor footer3" colspan="2">Recibi Conforme.</th>
            <th class="center bor footer4" colspan="2">Aclaracion.</th>
          </tr>
        </table>
        </div>
        </body>

';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("order.pdf", array("Attachment" => 0));

?>
