(function () {
	$('#termo').keyup(function() {
		if($(this).val().length > 2){
			var dados = { 
			termo: $(this).val(), 
			metodo: "lista"
			}
			$.post('database.php', dados, function(retorno) {
				$("#relatorio").html(retorno);
			});
		}

    });
})();