<?php
include("sesion.php");
$pagina='proveedoresComprobantesPHP';
include("encabezado.php");
include("seguridad.php");
include("sql/conexion.php");
$idProveedor = $_REQUEST['idProveedor'];
include('sql/proveedoresComprobantes.php');
$fech = Date("Y-m-d");
$Fecha = Date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="es">
<style>
/* <!-- ACA IRIA EL CSS --> */

</style>

<body class="hidden-sn mdb-skin">
  <!--Main Layout-->
  <main>
    <div class="container-fluid mt-3 col col-md-11">
      <section class="pb-5">
        <div class="card text-center">
          <h3 class="card-header primary-color white-text">Datos del proveedor</h3>
          <div class="card-body">
            <form method="post">
              <div class="row">
                <div class="col-md-4 mb-4">
                  <div class="md-form">
                    <input type="text" id="form1" class="form-control" name="Nombre" value="<?php echo $nombre; ?>" disabled>
                    <label for="form1" class="">Nombre</label>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="md-form">
                    <input type="text" id="form2" class="form-control" name="Cuit" value="<?php echo $cuit; ?>" disabled>
                    <label for="form2" class="">CUIT</label>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="md-form">
                    <input type="text" id="form3" class="form-control" name="CondicionIVA" value="<?php echo $condicioniva; ?>" disabled>
                    <label for="form3" class="">Condicion IVA</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-4">
                  <div class="md-form">
                    <input type="text" id="form3" class="form-control" name="Domicilio" value="<?php echo $domicilio; ?>" disabled>
                    <label for="form3" class="">Domicilio</label>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="card text-center">
          <h3 class="card-header primary-color-dark white-text">Comprobantes</h3>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Nro Comprobante</th>
                      <th class="th-sm">Fecha emision</th>
                      <th class="th-sm">Importe</th>
                      <th class="th-sm">Estado</th>
                      <th class="th-sm">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($rowCo = $comprobantes->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php echo $rowCo['nroComprobante'];  $idComprobante = $rowCo['idComprobante']; ?></td>
                        <td><?php echo $rowCo['fecha']; ?></td>
                        <td>$ <?php echo $rowCo['totalcomprado']; ?></td>
                        <td><?php if ($rowCo['activo'] == 1) {
                          echo "<button type='button' class='btn btn-default btn-sm' disabled style='margin-top: -5px;' >Pagado</button>";
                        }else{
                            echo "<button type='button' class='btn btn-outline-default  waves-effect btn-sm' disabled style='margin-top: -5px;'>Pago pendiente</button>";
                        } ?></td>
                        <td><?php echo "
                         <a href='.php?idProveedor=$idComprobante' class='btn btn-success btn-md'>Pagar</a>
                         <a href='pagoProveedores.php' class='btn btn-secondary btn-md'>Cancelar</a>
                        "; ?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
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
  var ps = new PerfectScrollbar(sideNavScrollbar);

  $(document).ready(function() {
    $('.mdb-select').materialSelect();
  });

</script>
</body>
</html>
