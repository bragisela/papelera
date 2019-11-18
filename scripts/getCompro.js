$(document).ready(function(){

	$("#cliente").change(function() {
		var id = $(this).find(":selected").val();
		var dataString = 'idCliente='+ id;
		$.ajax({
			url: 'scripts/getCompro.php',
			dataType: "json",
			data: dataString,
			cache: false,
			success: function(dataCliente) {
			   if(dataCliente) {
          var cuit = dataCliente.idComprobante;
          document.getElementById('idComprobantee').value = cuit ;

				}
			}
		});
 	})
});
