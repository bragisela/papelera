<?php
include("sesion.php");
$pagina='reportesCajaPHP';
include("encabezado.php");
include("sql/conexion.php");
include("sql/consultas.php");
//include("segguridad.php");
include("menu.php");
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

        <?php

         if (isset($_POST['buscar']) && ($_POST['fechaD'] !='') && ($_POST['fechaH']!='')) {
           ?>

        <div class="card text-center">
          <h3 class="card-header primary-color-dark white-text"> Reporte de Caja </h3>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Fecha</th>
                      <th class="th-sm">NroCaja</th>
                      <th class="th-sm">Descripcion</th>
                      <th class="th-sm">Importe</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($rowCaja = $resultadoCaja->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php echo $rowCaja['fecha']; ?></td>
                        <td><?php echo $rowCaja['nroCaja']; ?></td>
                        <td><?php echo $rowCaja['descripcion']; ?></td>
                        <td><?php echo $rowCaja['importe']; ?></td>
                        <!--<td><?php echo "
                        <a href='cajaModificar.php?idCaja=$idCaja'><i class='far fa-edit'></i></i></a>
                        <a onClick='pDelete(this);' id='$idCaja'><i class='far fa-trash-alt'></i></a>"; ?></td>-->
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      <?php } ?>
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
</script>
</body>
</html>
