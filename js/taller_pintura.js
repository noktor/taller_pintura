$(document).ready(onReady);

function onReady(){

	var $contenidor = $('#contenidor');
	var $formulari = $('#formulari');
	var $total = $('#total');
	var $porcio = $contenidor.find('.porcio');
	var $checkbox = $formulari.find('input[type=checkbox]');
	var $check_total = $("input[value='tot']");
	$porcio.on('click', function(){
		var $this = $(this);
	//	var total = $total.data('total');
		var data = $this.data('id');
		var $selector = $('input[value="'+data+'"]');
		console.log($this);
		if($this.hasClass('porcio_activa')){
			$this.removeClass('porcio_activa');
			$selector.prop('checked',false);
			$check_total.prop('checked',false);
		//	total -= $selector.data('preu');
		} else {
		    $this.addClass('porcio_activa');
			$selector.prop('checked',true);
		//	total += $selector.data('preu');			
		}
		marcar_CB_Total();		
		calcularTotal();
	});

	$checkbox.on('change', function(){
		var $this = $(this);
		console.log($this.prop("checked"));
		var value = $this.val();
		var $porcio_pintada = $contenidor.find('#porcio_'+value);
	//	console.log($porcio_pintada+"-"+value);
		if(value=="tot"){
			if($this.prop('checked')){
				//$checkbox.each(function(){
				$checkbox.prop('checked',true);
				$porcio.addClass('porcio_activa');
				//});
			} else {
				$checkbox.prop('checked',false);
				$porcio.removeClass('porcio_activa');
			}	
		} else {
			if($porcio_pintada.hasClass('porcio_activa')){
				$porcio_pintada.removeClass('porcio_activa');
		//		$this.prop('checked',false);
			} else {
			    $porcio_pintada.addClass('porcio_activa');
		//		$this.prop('checked',true);
			}

			if($this.prop('checked') === false){
				$check_total.prop('checked',false);
		//		console.log($check_total);
			}
			marcar_CB_Total();
		}
		calcularTotal();
	});

	function calcularTotal(){
		var total = 0;
		//var tot = $("input[value='tot']");
		if($check_total.prop('checked') === true){
			total += $check_total.data('preu');
		} else {
			$checkbox.each(function(){
				if($(this).prop('checked') && $(this).val()!='tot'){
					total += $(this).data('preu');
				}
			});
		}
		$("#contacte").find("#total_amagat").val(total);		
		console.log("preu actual: "+$("#contacte").find("#total_amagat").val()+" €");
		$total.html("<b>Total: "+total+" &euro;</b>");
	}

	function marcar_CB_Total(){
		console.log($("#formulari input:checkbox:checked").length);
		
		if($porcio.hasClass('porcio_activa').length == 15){
			$check_total.prop('checked',true);
		}

		//if ($("#formulari input:checkbox:checked").length == 15){
//la sentència if de sota fa el mateix que la comentada adalt
		if($checkbox.filter(':checked').length == 15){
			$check_total.prop('checked',true);
		}
	}
}