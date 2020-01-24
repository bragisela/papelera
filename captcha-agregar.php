<?PHP
  //Antes del botón enviar o Guardar
  <div class="elem-group">
    <label for="captcha">Por favor ingrese los números</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" >
  </div>


//después del if en el que aparece la acción del enviar

if(isset($_POST['captcha_challenge']) && $_POST['captcha_challenge'] == $_SESSION['captcha_text']) {
//ahí va toda la acción del botón enviar
}
else {
  echo "<script language='javascript'>";
echo "alert('El captcha es incorrecto');";
echo "</script>";



?>
