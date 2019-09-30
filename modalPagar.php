<div class="modal">
	<div class="contenido">
	  <h2 align="center">¿Desea recibir el pago?</h2>
    <form method="post">
      <button class="btn btn-danger btn-md btn-mar"  name="cancelar"  id="cancelar" data-dismiss="modal" type="submit">Cancelar</button>
      <button class="btn btn-success  btn-md" name="guardar"  id="guardar" data-dismiss="modal" type="submit">Aceptar</button>

        <?php
          if (isset($_POST['guardar'])) {
									echo "<script language='javascript'>";
                  echo "window.location='pedidoPago.php?idComprobante=$idComprobante';";
									echo "</script>";

					}
        ?>
    </form>
  </div>
</div>
