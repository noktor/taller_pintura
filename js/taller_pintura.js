$(document).ready(onReady);

function onReady(){
	
	var $contenidor = $('#contenidor');
	var $formulari = $('#formulari');
	var $porcio = $contenidor.find('.porcio');
	var $checkbox = $formulari.find('input[type=checkbox]');
	$porcio.on('click', function(){
		var $this = $(this);
		var data = $this.data('id');
		var $selector = $('input[value="'+data+'"]');
		console.log($this);
		if($this.hasClass('porcio_activa')){
			$this.removeClass('porcio_activa');
			$selector.prop('checked',false);
		} else {
		    $this.addClass('porcio_activa');
			$selector.prop('checked',true);
		}   
	});

	$checkbox.on('change', function(){
		var $this = $(this);
		var value = $this.val();
		var $porcio_pintada = $contenidor.find('#porcio_'+value);
		console.log($porcio_pintada+"-"+value);
		if($porcio_pintada.hasClass('porcio_activa')){
			$porcio_pintada.removeClass('porcio_activa');
			$this.prop('checked',false);
		} else {
		    $porcio_pintada.addClass('porcio_activa');
			$this.prop('checked',true);
		}   
	});

}