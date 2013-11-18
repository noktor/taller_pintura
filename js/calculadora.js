$(document).ready(onReady);

function onReady(){
	console.log('hola');
	var $calcul = $('#calcul');
	$('.num').on('click', function(event){
		console.time('event');
		var buto = $(event.target);
		var valor = buto.val();
	    var valor_calcul = $calcul.val();
		$calcul.val(valor_calcul+valor);
		//var valor_calcul = $('#calcul').val();
		//$('#calcul').val(valor_calcul+valor);
		console.timeEnd('event');
		var string = $(this).val();
		var caracter = string.substring(string.length - length-1);
		if(!isNaN(caracter) && caracter != ""){
			console.log('caràcter afegit '+caracter);
		} else {
			event.preventDefault();
		}
	});
	$('#borrarTot').on('click', function(event){
		console.time('event');
		var buto = $(event.target);
		var valor = "";
	    var valor_calcul = $calcul.val();
		$calcul.val(valor);
		//var valor_calcul = $('#calcul').val();
		//$('#calcul').val(valor_calcul+valor);

		console.timeEnd('event');
	});
	$('#borrarCaracter').on('click', function(event){
		console.time('event');
		var buto = $(event.target);
	    var valor_calcul = $calcul.val();
		valor_calcul = valor_calcul.substring(0, valor_calcul.length-1);
		$calcul.val(valor_calcul);
		//var valor_calcul = $('#calcul').val();
		//$('#calcul').val(valor_calcul+valor);
		console.log($calcul.val());
		console.timeEnd('event');
	});

	/*valida l'estat actual del contenidor del càlcul
	(comprova caràcters numèricsi simbols d'operació):*/
	$('#calcul').on('keypress', function(event){
		var string = $(this).val();
		var caracter = string.substring(string.length - length-1);
		console.log("-"+caracter+"-");
		console.log(event);
		if(!isNaN(caracter) && caracter != ""){
			console.log('caràcter afegit '+caracter);
		} else {
			console.log( isNaN(caracter) );
			console.log( caracter!="" );
			event.preventDefault();
		}
	});

	$('#operar').on('click', function(event){
		event.preventDefault();
		$.ajax({
			url: "ajax.php",
			type: "get",
			data: {operar:1, contenidor:$calcul.val()},
			dataType: "json"
		})
		.done(function(data){
			if(data.error === 0){
				$calcul.val(data.total);
			} else if (data.error === -1) {
				$("#error").text("Un nombre sol no es pot operar.");
			} else if (data.error === 1) {
				$("#error").text("La calculadora nomès accepta nombres i símbols matemàtics.");
			}
		})
		.fail(function(){
			alert("Error al calcular.");
		});		
	});	
}



/*
var val = 0,
$elm = $('#calcul');
console.time('color');
for( var i=0; i<10000; i++)
{
	$('#calcul').css('background','#ff00'+val);
	//$elm.css('background','#ff00'+val);
	val = (val<10)? (val+1):0;
}
console.timeEnd('color');

}*/