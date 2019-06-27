<?php
include("sesion.php");
$pagina='cajaPHP';
include("encabezado.php");
include("sql/conexion.php");
include("sql/insert.php");
include('sql/consultas.php');
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
    <section class="pb-5 col-md-12">
      <div class="card text-center">
        <h3 class="card-header primary-color-dark white-text">Movimientos de Caja</h3>
          <div class="card-body">
            <!-- Botones modal de Ingreso y Egreso -->
            <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#ingreso"><i class="fas fa-plus"></i>
              Ingreso
            </button>
            <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal" data-target="#egreso"><i class="fas fa-minus"></i>
              Egreso
            </button>
            <!-- Inicio Modal Ingreso -->
            <div class="modal fade" id="ingreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">INGRESO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Inicio del cuerpo de formulario de ingreso -->
                    <div class="card text-center">
                      <h3 class="card-header success-color white-text">Nuevo Ingreso de caja</h3>
                      <div class="card-body">
                        <form method="post">
                          <div class="row">
                            <div class="col-md-12 mb-4">
                              <div class="md-form">
                                <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 mb-4">
                              <div class="md-form">
                                <input type="text" id="form3" class="form-control" name="descripcion">
                                <label for="form3" class="">Descripcion</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 mb-4">
                              <div class="md-form">
                                <input type="text" id="form4" class="form-control" name="importe">
                                <label for="form4" class="">Importe</label>
                              </div>
                            </div>
                          </div>
                          <input type="submit" name="GuardarIngreso" value="Guardar" class="btn btn-success">
                          <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='caja.php'">
                        </form>
                          <!--FIN -->
                          <?php //Acción al presionar GuardarIngreso
                            if (isset($_POST['GuardarIngreso'])){
                              $sqlCaja = insertCajaIngreso($_POST['fecha'],$_POST['tipoMov'],$_POST['descripcion'],$_POST['importe']);
                              $conexiones->exec($sqlCaja);

                              echo "<script language='javascript'>";
                              echo "alert('El Ingreso se realizó correctamente');";
                              echo "window.location='caja.php';";
                              echo "</script>";

                            }
                          ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Fin del cuerpo de agregar Ingreso -->

            <!-- Inicio Modal Egreso -->
            <div class="modal fade" id="egreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EGRESO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Inicio del cuerpo de formulario de Egreso -->
                    <div class="card text-center">
                      <h3 class="card-header danger-color-dark white-text">Nuevo Egreso de caja</h3>
                      <div class="card-body">
                        <form method="post">
                          <div class="row">
                            <div class="col-md-12 mb-4">
                              <div class="md-form">
                                <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 mb-4">
                              <div class="md-form">
                                <input type="text" id="form5" class="form-control" name="descripcion">
                                <label for="form5" class="">Descripcion</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 mb-4">
                              <div class="md-form">
                                <input type="text" id="form6" class="form-control" name="importe">
                                <label for="form6" class="">Importe</label>
                              </div>
                            </div>
                          </div>
                          <input type="submit" name="GuardarEgreso" value="Guardar" class="btn btn-success">
                          <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='caja.php'">
                        </form>
                          <!--FIN -->
                          <?php //Acción al presionar GuardarEgreso
                            if (isset($_POST['GuardarEgreso'])){
                              $sqlCajaEgreso = insertCajaEgreso($_POST['fecha'],$_POST['tipoMov'],$_POST['descripcion'],$_POST['importe']);
                              $conexiones->exec($sqlCajaEgreso);

                              echo "<script language='javascript'>";
                              echo "alert('El Egreso se realizó correctamente');";
                              echo "window.location='caja.php';";
                              echo "</script>";

                            }
                          ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Fin del cuerpo de agregar Egreso -->
            <!-- Inicio de la tabla de movimientos de Caja -->
              <table class="table table-bordered table-hover table-striped display AllDataTables" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">Fecha</th>
                    <th class="th-sm">Descripcion</th>
                    <th class="th-sm">Debe</th>
                    <th class="th-sm">Haber</th>
                    <th class="th-sm">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($rowCaja = $resultadoCajaTemporal->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                      <td><?php echo ($rowCaja['fecha']) ;?></td>
                      <td><?php echo $rowCaja['descripcion']; $idCaja = $rowCaja['idCaja']; ?></td>
                      <td><?php
                        if ($rowCaja['importe']>0){
                          echo "$", number_format (($rowCaja['importe']),2,",",".") ;
                        } else {
                          echo "-";
                        }
                          ?>
                      </td>
                      <td><?php
                        if ($rowCaja['importe']<0){
                          echo "$", number_format (($rowCaja['importe']),2,",",".");
                        } else {
                          echo "-";
                        }
                        ?></td>
                      <td><?php echo "
                        <a href='cajaModificar.php?idCaja=$idCaja'><i class='far fa-edit'></i></a>
                        <a onClick='pDelete(this);' id='$idCaja'><i class='far fa-trash-alt'></i></a>";?></td>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
              </table>
              <!-- Fin de la tabla de movimientos de Caja -->

              <!-- Botón inactivo que arroja el saldo de caja. -->
              <button type="button"  class="btn btn-dark" disabled><td colspan="5"></td>
               <td>Saldo de Caja  </td>
               <td>
                 <?php global $cierreTotal;
                 while($rowCajaTotal = $totalCajaTemporal->fetch(PDO::FETCH_ASSOC)) {


                    $cierreTotal = ($rowCajaTotal['totalCajaTemporal']);
                    echo '$' . number_format ($cierreTotal,2,",",".");


                    }
                    ?>
               </td></button>
               <button type="button" data-toggle="modal" name="cierreCaja" data-target="#cierreCaja" class="btn btn-dark-green"><i class="fas fa-money-check-alt fa-1.5x"></i>    Cierre de Caja</button></td>




              <!-- Inicio Modal Cierre de Caja -->
              <div class="modal fade" id="cierreCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">CIERRE DE CAJA</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Inicio del cuerpo de formulario de Cierre de Caja -->
                      <div class="card text-center">
                        <h3 class="card-header success-color white-text">Cierre de Caja</h3>
                        <div class="card-body">
                          <form method="post">
                            <div class="row">
                              <div class="col-md-12 mb-4">
                                <div class="md-form">
                                  <input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">
                                </div>
                              </div>
                            </div>
                            <!--
                            <div class="row">
                              <div class="col-md-4 mb-4">
                                <div class="md-form">
                                  <input type="text" id="form8" class="form-control" value="Cierre de Caja" name="descripcion">
                                  <label for="form8" class="">Descripcion</label>
                                </div>
                              </div>
                            </div> -->
                            <div class="row">
                              <div class="col-md-12 mb-4">
                                <div class="md-form">
                                  <input type="text" id="form9" class="form-control" name="importe" value="<?php echo $cierreTotal ?>">
                                  <label for="form9" class="" >Importe</label>
                                </div>
                              </div>
                            </div>


                            <input type="submit" name="GuardarCierreCaja" value="Guardar" class="btn btn-success">
                            <input type="reset" name="Cancelar" value="Cancelar" class="btn btn-info" onClick="location.href='caja.php'">
                          </form>
                            <!--FIN -->
                            <?php
                              if (isset($_POST['GuardarCierreCaja'])){
                                $sqlCierreCaja = cierreCaja($_POST['fecha'],$_POST['tipoMov'],$_POST['descripcion'],$_POST['importe']);
                                $conexiones->exec($sqlCierreCaja);

                                echo "<script language='javascript'>";
                                echo "alert('El Cierre de Caja se realizó correctamente');";
                                echo "window.location='caja.php';";
                                echo "</script>";

                              }
                            ?>
                        </div>
                      </div>
                      <!-- Fin del cuerpoModal Cierre de Caja -->
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
    if(confirm('Esta seguro que quiere eliminar el movimiento?'))
      window.location.href = "sql/cajaBorrar.php? idCaja=" + element.id;
  }
</script>
</body>
</html>
