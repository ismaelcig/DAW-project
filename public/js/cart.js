$(document).ready(function() {
	adaptText();//Se llama una vez al entrar
	
	/*Evento al redimensionar la ventana*/
	var resizeTimer;
	$(window).on('resize', function(){
		//Para que sólo se llame una vez al evento
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {//Lo que hace realmente el evento
			
			adaptText();//Se vuelve a llamar al redimensionar
			
		}, 50);
		
	});
	
	/*Eliminar de la cesta*/
	//Por cada elemento
	$('.rem-bucket').val(function(){
		$(this).click(function() {
			console.log('rem-bucket');
			//Recuperamos las variables
			var bookId = $(this).find('#book_id').val();
			var bookLang = $(this).find('#book_lang').val();
			
			//Se elimina
			$.ajax({
				type: "POST",
				url: "common/includes/book-functions.php",
				dataType: 'json',
				data: {
					action: 'rem-bucket',
					book_id: bookId,
					book_lang: bookLang
				}
			}).done(function(data) {
				console.log('done');
				if('' != data.msg){
					if('removed'){//Si lo ha eliminado
						location.reload(false);//Se recarga la página
					}
				}
			});
		});
	});
	
	
	
	
	
	/*Función Checkout*/
	$('#checkout-btn').click(function() {
		console.log('checkout-btn');
		
		if(confirm("Confirm payment?")){
			//Procedemos al pago
			$.ajax({
				type: "POST",
				url: "common/includes/book-functions.php",
				dataType: 'json',
				data: {
					action: 'rem-bucket',
					book_id: bookId,
					book_lang: bookLang,
					book_price: bookPrice
				}
			}).done(function(data) {
				console.log('done');
				if('' != data.msg){
					alertText(data.msg);
					if('removed'){//Si lo ha añadido
						$('.rem-bucket').addClass('hidden');//Ocultamos "eliminar"
						$('.add-bucket').removeClass('hidden');// Mostramos "añadir"
						//Actualizamos el nº de elementos
						$('#cartAmount').text(data.newAmount);
					}
				}
			});
		}
		
	});
	
	
});


function adaptText(){
	/**/
	var charsMD = 450
	var charsXS = 200;
	var breakpoint = 990;//Breakpoin de CSS
	//Por cada sinopsis
	$('.synopsis').val(function(){
		var nInitialChars = 0;
		//En resoluciones pequeñas se muestra menos texto
		if($(window).width() >=breakpoint)
			nInitialChars = charsMD;
		else
			nInitialChars = charsXS;
			
		var fullText = $(this).find( '.full-text' ).text();//Texto completo

		if (fullText.length > nInitialChars) {
			//Texto corto
			var sText = fullText.substr(0, nInitialChars);
			//Resto del texto
			//var eText = fullText.substr(nInitialChars, fullText.length - nInitialChars);
			
			//Ponemos el texto corto
			$(this).find( '.short-text' ).text(sText + '...');
			
		}
	});
}