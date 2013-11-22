<?php


	error_reporting(-1);
	ini_set('display_errors',true);


	include "FirePHPCore/fb.php";
	include "validate.php";
	include "errors.php";
	include "flash.php";

	$llista_porcions = array(
		 'aleta_Frontal_D'=>array(
								'id'=>01,
								'nom'=>'Aleta Frontal Dreta',
								'descripcio'=>'',
								'preu'=>115
							),
		'retrovisor_Dreta'=>array(
								'id'=>02,
								'nom'=>'Retrovisor Dreta',
								'descripcio'=>'',
								'preu'=>31
							),
		 'porta_Frontal_D'=>array(
								'id'=>03,
								'nom'=>'Porta Frontal Dreta',
								'descripcio'=>'',
								'preu'=>105
							),
		'porta_Anterior_D'=>array(
								'id'=>04,
								'nom'=>'Porta Anterior Dreta',
								'descripcio'=>'',
								'preu'=>105
							),
		'aleta_Anterior_D'=>array(
								'id'=>05,
								'nom'=>'Aleta Anterior Dreta',
								'descripcio'=>'',
								'preu'=>115
							),
	   'paraxocs_Anterior'=>array(
								'id'=>06,
								'nom'=>'Paraxocs Anterior',
								'descripcio'=>'',
								'preu'=>125
							),
				 'maleter'=>array(
								'id'=>07,
								'nom'=>'Maleter',
								'descripcio'=>'',
								'preu'=>135
							),
		'aleta_Anterior_E'=>array(
								'id'=>08,
								'nom'=>'Aleta Anterior Esquerra',
								'descripcio'=>'',
								'preu'=>115
							),
		'porta_Anterior_E'=>array(
								'id'=>09,
								'nom'=>'Porta Anterior Esquerra',
								'descripcio'=>'',
								'preu'=>105
							),
		 'porta_Frontal_E'=>array(
								'id'=>10,
								'nom'=>'Porta Frontal Esquerra',
								'descripcio'=>'',
								'preu'=>105
							),
	 'retrovisor_Esquerra'=>array(
								'id'=>11,
								'nom'=>'Retrovisor Esquerra',
								'descripcio'=>'',
								'preu'=>31
							),
		 'aleta_Frontal_E'=>array(
								'id'=>12,
								'nom'=>'Aleta Frontal Esquerra',
								'descripcio'=>'',
								'preu'=>115
							),
		'paraxocs_Frontal'=>array(
								'id'=>13,
								'nom'=>'Paraxocs Frontal',
								'descripcio'=>'',
								'preu'=>125
							),
		    'tapa_Frontal'=>array(
								'id'=>14,
								'nom'=>'Tapa Frontal',
								'descripcio'=>'',
								'preu'=>155
							),
				  'sostre'=>array(
								'id'=>15,
								'nom'=>'Sostre',
								'descripcio'=>'',
								'preu'=>178
							),
				  'tot'=>array(
								'id'=>16,
								'nom'=>'Tot el cotxe',
								'descripcio'=>'',
								'preu'=>1375
							)																																				
						);
	//echo "<pre>";
	//print_r($llista_porcions);
	//echo "</pre>";
	//FB::send("test");
$llista_errors = new Errors();
//$llista_errors->accumulate = true;

if(isset($_POST["submit"])){

	if( !isset($_POST["condicions"]) ){
		$llista_errors->add_public("Les condicions d'ús s'han d'acceptar.","condicions");
	}
	else if (!isset($_POST["porcio_cotxe"])){
		$llista_errors->add_public("Has d'escollir alguna porcio per a pintar.","checkboxes");
	} 
	else if( isset($_POST["nom"]) && isset($_POST["telefon"]) && isset($_POST["email"])){

		$nom=$_POST['nom'];
		$telefon=$_POST['telefon'];
		$email=$_POST['email'];
		$data_valid = array();

		if( Validate::is_empty($telefon) && Validate::is_empty($email)){

			$llista_errors->add_public("Has d'indicar un telèfon o un email.");
		}
		else if( !Validate::is_empty($telefon) && !Validate::is_number($telefon) ){
			$llista_errors->add_public("Format de telèfon incorrecte.","telefon");
		}
		else if( !Validate::is_empty($email) && !Validate::is_email($email) ){
			$llista_errors->add_public("Format d'e-mail incorrecte.","email");
		}
		else
		{
			//	telèfon correcte
			//	mail introduït correctament		
			FB::send("Nom: ".$nom);				
			FB::send("Telèfon: ".$telefon);
			FB::send("E-mail: ".$email);		
			$data_valid['nom'] = trim($nom);				
			$data_valid['telefon'] = trim($telefon);
			$data_valid['email'] = trim($email);	
			$data_valid['email_string'] = trim($email);
		}

		//DONECalcaular el total segons els checkbox que m'arriben
		$total=0;

		//DONEmodificar el foreach, actualment compta tots els checkboxes i els suma (incloent el total):

	//	$aux_llista_porcions = array_reverse($llista_porcions);
	//	$aux_array_checkbox = array_reverse($_POST["porcio_cotxe"]);
		if(isset($_POST['tot_cotxe'])){
			$total = $llista_porcions['tot']['preu'];
		}
		else
		{
			foreach ($_POST["porcio_cotxe"] AS $porcio)
			{
				if( isset($llista_porcions[$porcio]))
				{
					$total += $llista_porcions[ $porcio ]['preu'];
				//	FB::send($aux_llista_porcions[ $porcio ]['preu']." THIS MUST HAVE TO BE SEEN");
				}
				else
				{
					$llista_errors->add_hypocritical( Errors::$str_please_redo, 'Hack attempt!!! Han passat el valor de porcio inexistent:"'.$porcio.'"');
					break;
				}
			}
		}
		$data_valid['total'] = $total;
	}
	else
	{
		$llista_errors->add_hypocritical( Errors::$str_please_redo, 'No ha arribat cap variable $_POST.' );
	}

//	echo "<pre>";
//	print_r($llista_errors->get_public());
//	echo "</pre>";	
	if( Validate::is_empty($data_valid['nom']) ){
		$data_valid['nom']='sin nombre';
	}
	if( Validate::is_empty($data_valid['telefon']) ){
		$data_valid['telefon']='sin telefono';
	}
	if( Validate::is_empty($data_valid['email']) ){
		$data_valid['email'] = 'web@autologa.com';
		$data_valid['email_string']='sin email';
	}
	FB::send($data_valid['total']);
	if ($llista_errors->free() ){
		include "mandrill/Mandrill.php";
		$options = array(
					"html"=>'<b>Has recibido una nueva petición de contacto:<br><br>Nombre: '.
					$data_valid["nom"].'<br>Telefono: '.$data_valid["telefon"].'<br>E-mail: '.
					$data_valid["email_string"].'<br>Total a pagar: '.$data_valid["total"].' €</b>',
					"subject"=>'Notificación nuevo presupuesto pintura.',
					"from_email"=>$data_valid['email'],
					"from_name"=>$data_valid['nom'],
					"to"=>array(
							array(
								"email"=>'avilac4@gmail.com',
								"name"=>'albert vila'
								)
							),
					"track_opens"=>true,
					"track_clicks"=>true
					);

		try
		{
			$mail = new Mandrill("74h-7Vh5dOfbfuJpd4c_tA");
			$response = $mail->messages->send($options);
			FB::send($response);
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
		FB::send("No hi ha cap error.");
		//phpinfo();
		//mail("avilac4@gmail.com","asuntillo","Este es el cuerpo del mensaje");
		FB::send("Formulari enviat correctament.");
	}
	else{
		//FB::send( $llista_errors->get_public() );
		// Mostrar error al usuari

		Flash::next('errors', $llista_errors->get_public() );
		echo '<div class="alert alert-error">'.
		'<ul>'; 
		foreach( $llista_errors->get_public() AS $error )
		{
			echo '<li>'.$error.'</li>';
		}
		echo '</ul>'.
		'</div>';

	}		
//	FB::send("Total: ".$_POST["total_amagat"]);
	header("Location: index.php");

} else {
	
//amb aquest else englobo tot el contingut de la pàgina:
$missatge = Flash::get('errors');
FB::send($missatge);
?>

<html>
	<head>
		<meta charset="UTF-8">		
		<title>Taller de Pintura</title>
		<link rel="stylesheet/less" type="text/css" href="css/style.less" />
		<script src="js/less-1.5.0.min.js" type="text/javascript"></script>
		<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="js/taller_pintura.js" type="text/javascript"></script>
	</head>

	<body>
	<form class="form-horizontal" method="post">	
		<div id="contenidor">
			<div title="<?php echo $llista_porcions['aleta_Frontal_D']['nom'];?>" id="porcio_aleta_Frontal_D" class="porcio" data-id="aleta_Frontal_D"><h5><?php echo $llista_porcions['aleta_Frontal_D']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['retrovisor_Dreta']['nom'];?>" id="porcio_retrovisor_Dreta" class="porcio" data-id="retrovisor_Dreta"><h5><?php echo $llista_porcions['retrovisor_Dreta']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['porta_Frontal_D']['nom'];?>"id="porcio_porta_Frontal_D" class="porcio" data-id="porta_Frontal_D"><h5><?php echo $llista_porcions['porta_Frontal_D']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['porta_Anterior_D']['nom'];?>" id="porcio_porta_Anterior_D" class="porcio" data-id="porta_Anterior_D"><h5><?php echo $llista_porcions['porta_Anterior_D']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['aleta_Anterior_D']['nom'];?>" id="porcio_aleta_Anterior_D" class="porcio" data-id="aleta_Anterior_D"><h5><?php echo $llista_porcions['aleta_Anterior_D']['nom'];?></h5></div>	
			<div title="<?php echo $llista_porcions['paraxocs_Anterior']['nom'];?>" id="porcio_paraxocs_Anterior" class="porcio" data-id="paraxocs_Anterior"><h5><?php echo "<b>".$llista_porcions['paraxocs_Anterior']['nom']."</b>";?></h5></div>
			<div title="<?php echo $llista_porcions['maleter']['nom'];?>" id="porcio_maleter" class="porcio" data-id="maleter"><h5><?php echo $llista_porcions['maleter']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['aleta_Anterior_E']['nom'];?>" id="porcio_aleta_Anterior_E" class="porcio" data-id="aleta_Anterior_E"><h5><?php echo $llista_porcions['aleta_Anterior_E']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['porta_Anterior_E']['nom'];?>" id="porcio_porta_Anterior_E" class="porcio" data-id="porta_Anterior_E"><h5><?php echo $llista_porcions['porta_Anterior_E']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['porta_Frontal_E']['nom'];?>" id="porcio_porta_Frontal_E" class="porcio" data-id="porta_Frontal_E"><h5><?php echo $llista_porcions['porta_Frontal_E']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['retrovisor_Esquerra']['nom'];?>" id="porcio_retrovisor_Esquerra" class="porcio" data-id="retrovisor_Esquerra"><h5><?php echo $llista_porcions['retrovisor_Esquerra']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['aleta_Frontal_E']['nom'];?>" id="porcio_aleta_Frontal_E" class="porcio" data-id="aleta_Frontal_E"><h5><?php echo $llista_porcions['aleta_Frontal_E']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['paraxocs_Frontal']['nom'];?>" id="porcio_paraxocs_Frontal" class="porcio" data-id="paraxocs_Frontal"><h5><?php echo "<b>".$llista_porcions['paraxocs_Frontal']['nom']."</b>";?></h5></div>
			<div title="<?php echo $llista_porcions['tapa_Frontal']['nom'];?>" id="porcio_tapa_Frontal" class="porcio" data-id="tapa_Frontal"><h5><?php echo $llista_porcions['tapa_Frontal']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['sostre']['nom'];?>" id="porcio_sostre" class="porcio" data-id="sostre"><h5><?php echo $llista_porcions['sostre']['nom'];?></h5></div>													
		</div>
		<div id="formulari">
			
				<table>
					<td>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['paraxocs_Frontal']['preu']; ?>" value="paraxocs_Frontal"> <?php echo $llista_porcions['paraxocs_Frontal']['nom'].": <b>".$llista_porcions['paraxocs_Frontal']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['aleta_Frontal_E']['preu']; ?>" value="aleta_Frontal_E"> <?php echo $llista_porcions['aleta_Frontal_E']['nom'].": <b>".$llista_porcions['aleta_Frontal_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['retrovisor_Esquerra']['preu']; ?>" value="retrovisor_Esquerra"> <?php echo $llista_porcions['retrovisor_Esquerra']['nom'].": <b>".$llista_porcions['retrovisor_Esquerra']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['porta_Frontal_E']['preu']; ?>" value="porta_Frontal_E"> <?php echo $llista_porcions['porta_Frontal_E']['nom'].": <b>".$llista_porcions['porta_Frontal_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['porta_Anterior_E']['preu']; ?>" value="porta_Anterior_E"> <?php echo $llista_porcions['porta_Anterior_E']['nom'].": <b>".$llista_porcions['porta_Anterior_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['aleta_Anterior_E']['preu']; ?>" value="aleta_Anterior_E"> <?php echo $llista_porcions['aleta_Anterior_E']['nom'].": <b>".$llista_porcions['aleta_Anterior_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['paraxocs_Anterior']['preu']; ?>" value="paraxocs_Anterior"> <?php echo $llista_porcions['paraxocs_Anterior']['nom'].": <b>".$llista_porcions['paraxocs_Anterior']['preu']." &euro;</b>";?><br>																							
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['maleter']['preu']; ?>" value="maleter"> <?php echo $llista_porcions['maleter']['nom'].": <b>".$llista_porcions['maleter']['preu']." &euro;</b>";?><br>
					</td>
					<td>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['aleta_Anterior_D']['preu']; ?>" value="aleta_Anterior_D"> <?php echo $llista_porcions['aleta_Anterior_D']['nom'].": <b>".$llista_porcions['aleta_Anterior_D']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['porta_Anterior_D']['preu']; ?>" value="porta_Anterior_D"> <?php echo $llista_porcions['porta_Anterior_D']['nom'].": <b>".$llista_porcions['porta_Anterior_D']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['porta_Frontal_D']['preu']; ?>" value="porta_Frontal_D"> <?php echo $llista_porcions['porta_Frontal_D']['nom'].": <b>".$llista_porcions['porta_Frontal_D']['preu']." &euro;</b>";?><br>																								
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['retrovisor_Dreta']['preu']; ?>" value="retrovisor_Dreta"> <?php echo $llista_porcions['retrovisor_Dreta']['nom'].": <b>".$llista_porcions['retrovisor_Dreta']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['aleta_Frontal_D']['preu']; ?>" value="aleta_Frontal_D"> <?php echo $llista_porcions['aleta_Frontal_D']['nom'].": <b>".$llista_porcions['aleta_Frontal_D']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['tapa_Frontal']['preu']; ?>" value="tapa_Frontal"> <?php echo $llista_porcions['tapa_Frontal']['nom'].": <b>".$llista_porcions['tapa_Frontal']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe[]" data-preu="<?php echo $llista_porcions['sostre']['preu']; ?>" value="sostre"> <?php echo $llista_porcions['sostre']['nom'].": <b>".$llista_porcions['sostre']['preu']." &euro;</b>";?><br><br>
						<input type="checkbox" name="tot_cotxe" data-preu="<?php echo $llista_porcions['tot']['preu']; ?>" value="tot"> <?php echo "<b>".$llista_porcions['tot']['nom'].": ".$llista_porcions['tot']['preu']." &euro;</b>";?><br>
					</td>
				</table>
			
		</div>
		<span id="total"><b>Total: 0 &euro;</b></span>
			<div id="contacte">
				<?php
				$class = $span = $id = '';
				if( isset($missatge['nom']) )
				{
					$id = 'inputError';
					$class = ' error';
					$span = '<span class="help-inline">'.$missatge['nom'].'</span>';
				}
				else
				{
					$id = "inputName";
				}

				?>
				  <div class="control-group<?php echo $class;?>">
				    <label class="control-label" for="<?php echo $id; ?>">Nom:</label>
				    <div class="controls">
				      <input type="text" id="<?php echo $id; ?>" name="nom" placeholder="Nom">
				      <?php echo $span;?>
				    </div>
				  </div>
				<?php
				$class = $span = '';				
				if( isset($missatge['telefon']) )
				{
					$id = "inputError";
					$class = ' error';
					$span = '<span class="help-inline">'.$missatge['telefon'].'</span>';
				}
				else
				{
					$id = "inputPhone";
				}
				
				?>		  		  
				  <div class="control-group<?php echo $class;?>">
				    <label class="control-label" for="<?php echo $id; ?>">Telèfon:</label>
				    <div class="controls">
				      <input type="text" id="<?php echo $id; ?>" name="telefon" placeholder="Telèfon">
				      <?php echo $span;?>
				    </div>
				  </div>
				<?php
				$class = $span = '';				
				if( isset($missatge['email']) )
				{
					$id = "inputError";
					$class = ' error';
					$span = '<span class="help-inline">'.$missatge['email'].'</span>';
				}
				else
				{
					$id = "inputEmail";
				}

				?>		  
				  <div class="control-group<?php echo $class;?>">
				    <label class="control-label" for="<?php echo $id; ?>">E-mail:</label>
				    <div class="controls">
				      <input type="text" id="<?php echo $id; ?>" name="email" placeholder="E-mail">
				      <?php echo $span;?>
				    </div>
				  </div>  
				  <div class="control-group">
				    <div class="controls">
				      <label class="checkbox">
				        <input type="checkbox" name="condicions"> Accepto les <a href="http://www.google.com" target="_blank">condicions d'ús</a> i la <a href="http://www.sport.es" target="_blank">Política de Privacitat.</a>
				      </label>
				      <button name="submit" type="submit" class="btn">Sign in</button>
				    </div>
				  </div>
				<input type="hidden" id="total_amagat" name="total_amagat" value="0">
			</div>
		</form>
	</body>
</html>
<?php
//tanco l'else if d'adalt.
//IMPORTANT , guardar els clics?
}