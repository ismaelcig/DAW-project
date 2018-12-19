$(document).ready(function(){
	
	
	/*Nuevo libro*/
	$('#newBookForm').find("button[type=submit]").click(function() {
		console.log('newBookForm Submit');
		
		if(confirm("¿Añadir?")){
			//Se crea el libro
			$.ajax({
				type: "POST",
				url: "common/includes/book-functions.php",
				dataType: 'json',
				data: {
					action: 'newBook'
				}
			}).done(function(data) {
				console.log('done');
				if('' != data.msg){
					//Esperamos a que acepte
					$.when( $.ajax(alertText(data.msg))).then(function(){
						if('thx' == data.msg){//Si lo ha añadido
							location.reload(false);//Se recarga la página
						}
					});
				}
			});
		}
	});
	
	
	/*Registrar libro en idioma nuevo*/
	$( "select[name=book_id]" ).change(function() {
		var selector = $(this);
		
		if('' != selector.val()){//Si se ha seleccionado un libro
			//Deshabilitar campos
			$("input[name=_author]").prop("disabled", true);
			$("input[name=_genre]").prop("disabled", true);
			$("input[name=_saga]").prop("disabled", true);
			$("#sld").prop("disabled", true);
			$("input[name=_price]").prop("disabled", true);
		}
		else{
			//Habilita campos
			$("input[name=_author]").prop("disabled", false);
			$("input[name=_genre]").prop("disabled", false);
			$("input[name=_saga]").prop("disabled", false);
			$("#sld").prop("disabled", false);
			$("input[name=_price]").prop("disabled", false);
		}
	});
	
	

	//Por cada Rating slider
	$('.rate-element').val(function(){
		var slider = $(this).find("input[type=range]");//El slider
		var output = $(this).find('#rating-val');//Lo que se muestra
		var input = $(this).find("input[type=hidden]");//Lo que se pasa en el form
		output.text(slider.val()); //Mostrar valor por defecto

		//Actualizar valor span
		slider.on('input', function() {
			output.text($(this).val());
			input.text($(this).val());
		});
	});
	
	
	/*Función ProcessOrder*/
	$('.order-item').val(function(){
		var item = $(this);
		$(this).find('.process').click(function() {
			console.log('process');
			
			var orderId = item.find('#order_id').val();
			//Se procesa
			$.ajax({
				type: "POST",
				url: "common/includes/book-functions.php",
				dataType: 'json',
				data: {
					action: 'processOrder',
					order_id: orderId
				}
			}).done(function(data) {
				console.log('done');
				console.log(data);
				if('ok' == data.res){//Todo correcto
					//Esperamos a que acepte
					$.when( $.ajax(alertText(data.msg))).then(function(){
						item.remove();
						//if('thx' == data.msg){//Si lo ha añadido
							//location.reload(false);//Se recarga la página
						//}
					});
				}
				else{//Algo ha fallado
					$.ajax(alertText(data.msg));
				}
			});
		});
		
	});
	
	

	
	/*
	//Validar Precio (Permite nº y .)
	function validatePrice(s) {
		var rgx = /^[0-9]*\.?[0-9]*$/;
		return s.match(rgx);
	}
	
	
	
	//Validar fecha (dd/mm/aaaa)
	function isValidDate(dateString){
		//Comprobar patrón
		if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
			return false;

		//Valores en int
		var parts = dateString.split("/");
		var day = parseInt(parts[1], 10);
		var month = parseInt(parts[0], 10);
		var year = parseInt(parts[2], 10);

		//Comprobar rangos año/mes
		if(year < 1000 || year > 3000 || month == 0 || month > 12)
			return false;

		var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

		//Ajustar para bisiestos
		if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
			monthLength[1] = 29;

		//Comprobar rango del día
		return day > 0 && day <= monthLength[month - 1];
	};*/



});