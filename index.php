<?php


	error_reporting(-1);
	ini_set('display_errors',true);


	include "FirePHPCore/fb.php";
	include "validate.php";
	include "errors.php";

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
				 'malater'=>array(
								'id'=>07,
								'nom'=>'Malater',
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
if(isset($_POST["submit"])){
	if(isset($_POST["nom"]) && isset($_POST["cognoms"]) && isset($_POST["telefon"]) && isset($_POST["email"]) && isset($_POST["condicions"])){
		$nom=$_POST['nom'];
		$cognoms=$_POST['cognoms'];
		$telefon=$_POST['telefon'];
		$email=$_POST['email'];
		$total=$_POST['total_amagat'];
		if(Validate::is_empty($nom)){
		//	FB::send("Com et dius?");
			$llista_errors->add_public("El nom és obligatori.","nom");
		} else {
			FB::send("Nom: ".$_POST["nom"]);	
		}
		if(Validate::is_empty($cognoms)){
		//	FB::send("I els cognoms?");
			$llista_errors->add_public("Els cognoms són obligatoris","cognoms");
		} else {
			FB::send("Cognoms: ".$_POST["cognoms"]);	
		}
		if(!Validate::is_empty($telefon)){
			if(Validate::is_number($telefon)){
				FB::send("Telèfon: ".$_POST["telefon"]);
			} else {
			//	FB::send("Telèfon incorrecte!");
				$llista_errors->add_public("Format de telèfo incorrecte.","telefon");				
			}			
			//$llista_errors->add-public("Com et dius?","nom");
		} else {
		//	FB::send("Digue'ns el teu telèfon?");
			$llista_errors->add_public("El telèfon és obligatori.","telefon");			
		}
		if(!Validate::is_empty($email)){

			//$llista_errors->add-public("Com et dius?","nom");
			if(Validate::is_email($email)){
				FB::send("E-mail: ".$_POST["email"]);	
			} else {
			//	FB::send("Email incorrecte!");
				$llista_errors->add_public("Format d'e-mail incorrecte.","email");
			}
		} else {
		//	FB::send("Actualitza't, crea un email!");
			$llista_errors->add_public("L'e-mail és obligatori.","email");						
		}
		if($total!=0){
		    FB::send("Total: ".$total);			
		} else {
			$llista_errors->add_public("Has de seleccionar alguna part del cotxe per pintar!","parts_a_pintar");
		}
	} else {
		$llista_errors->add_public("Les condicions d'ús s'han d'acceptar.","condicions");
		FB::send("Les condicions d'ús s'han d'acceptar.");
	}
	echo "<pre>";					
	print_r($llista_errors->get_public());
	echo "</pre>";	
	if ($llista_errors->free() && isset($_POST['submit'])){
		FB::send("No hi ha cap error.");
		//phpinfo();
		//mail("avilac4@gmail.com","asuntillo","Este es el cuerpo del mensaje");
		FB::send("Formulari enviat correctament.");
	}		
//	FB::send("Total: ".$_POST["total_amagat"]);	
	header("Location: index.php");
} else {
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
		<div id="contenidor">
			<div title="<?php echo $llista_porcions['aleta_Frontal_D']['nom'];?>" id="porcio_aleta_Frontal_D" class="porcio" data-id="aleta_Frontal_D"><h5><?php echo $llista_porcions['aleta_Frontal_D']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['retrovisor_Dreta']['nom'];?>" id="porcio_retrovisor_Dreta" class="porcio" data-id="retrovisor_Dreta"><h5><?php echo $llista_porcions['retrovisor_Dreta']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['porta_Frontal_D']['nom'];?>"id="porcio_porta_Frontal_D" class="porcio" data-id="porta_Frontal_D"><h5><?php echo $llista_porcions['porta_Frontal_D']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['porta_Anterior_D']['nom'];?>" id="porcio_porta_Anterior_D" class="porcio" data-id="porta_Anterior_D"><h5><?php echo $llista_porcions['porta_Anterior_D']['nom'];?></h5></div>
			<div title="<?php echo $llista_porcions['aleta_Anterior_D']['nom'];?>" id="porcio_aleta_Anterior_D" class="porcio" data-id="aleta_Anterior_D"><h5><?php echo $llista_porcions['aleta_Anterior_D']['nom'];?></h5></div>	
			<div title="<?php echo $llista_porcions['paraxocs_Anterior']['nom'];?>" id="porcio_paraxocs_Anterior" class="porcio" data-id="paraxocs_Anterior"><h5><?php echo "<b>".$llista_porcions['paraxocs_Anterior']['nom']."</b>";?></h5></div>
			<div title="<?php echo $llista_porcions['malater']['nom'];?>" id="porcio_malater" class="porcio" data-id="malater"><h5><?php echo $llista_porcions['malater']['nom'];?></h5></div>
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
			<form>
				<table>
					<td>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['paraxocs_Frontal']['preu']; ?>" value="paraxocs_Frontal"> <?php echo $llista_porcions['paraxocs_Frontal']['nom'].": <b>".$llista_porcions['paraxocs_Frontal']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['aleta_Frontal_E']['preu']; ?>" value="aleta_Frontal_E"> <?php echo $llista_porcions['aleta_Frontal_E']['nom'].": <b>".$llista_porcions['aleta_Frontal_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['retrovisor_Esquerra']['preu']; ?>" value="retrovisor_Esquerra"> <?php echo $llista_porcions['retrovisor_Esquerra']['nom'].": <b>".$llista_porcions['retrovisor_Esquerra']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['porta_Frontal_E']['preu']; ?>" value="porta_Frontal_E"> <?php echo $llista_porcions['porta_Frontal_E']['nom'].": <b>".$llista_porcions['porta_Frontal_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['porta_Anterior_E']['preu']; ?>" value="porta_Anterior_E"> <?php echo $llista_porcions['porta_Anterior_E']['nom'].": <b>".$llista_porcions['porta_Anterior_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['aleta_Anterior_E']['preu']; ?>" value="aleta_Anterior_E"> <?php echo $llista_porcions['aleta_Anterior_E']['nom'].": <b>".$llista_porcions['aleta_Anterior_E']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['paraxocs_Anterior']['preu']; ?>" value="paraxocs_Anterior"> <?php echo $llista_porcions['paraxocs_Anterior']['nom'].": <b>".$llista_porcions['paraxocs_Anterior']['preu']." &euro;</b>";?><br>																							
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['malater']['preu']; ?>" value="malater"> <?php echo $llista_porcions['malater']['nom'].": <b>".$llista_porcions['malater']['preu']." &euro;</b>";?><br>
					</td>
					<td>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['aleta_Anterior_D']['preu']; ?>" value="aleta_Anterior_D"> <?php echo $llista_porcions['aleta_Anterior_D']['nom'].": <b>".$llista_porcions['aleta_Anterior_D']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['porta_Anterior_D']['preu']; ?>" value="porta_Anterior_D"> <?php echo $llista_porcions['porta_Anterior_D']['nom'].": <b>".$llista_porcions['porta_Anterior_D']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['porta_Frontal_D']['preu']; ?>" value="porta_Frontal_D"> <?php echo $llista_porcions['porta_Frontal_D']['nom'].": <b>".$llista_porcions['porta_Frontal_D']['preu']." &euro;</b>";?><br>																								
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['retrovisor_Dreta']['preu']; ?>" value="retrovisor_Dreta"> <?php echo $llista_porcions['retrovisor_Dreta']['nom'].": <b>".$llista_porcions['retrovisor_Dreta']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['aleta_Frontal_D']['preu']; ?>" value="aleta_Frontal_D"> <?php echo $llista_porcions['aleta_Frontal_D']['nom'].": <b>".$llista_porcions['aleta_Frontal_D']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['tapa_Frontal']['preu']; ?>" value="tapa_Frontal"> <?php echo $llista_porcions['tapa_Frontal']['nom'].": <b>".$llista_porcions['tapa_Frontal']['preu']." &euro;</b>";?><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['sostre']['preu']; ?>" value="sostre"> <?php echo $llista_porcions['sostre']['nom'].": <b>".$llista_porcions['sostre']['preu']." &euro;</b>";?><br><br>
						<input type="checkbox" name="porcio_cotxe" data-preu="<?php echo $llista_porcions['tot']['preu']; ?>" value="tot"> <?php echo "<b>".$llista_porcions['tot']['nom'].": ".$llista_porcions['tot']['preu']." &euro;</b>";?><br>
					</td>
				</table>
			</form>
		</div>
		<span id="total"><b>Total: 0 &euro;</b></span>
		<form id="contacte" class="form-horizontal" method="post">
		  <div class="control-group">
		    <label class="control-label" for="inputName">Nom:</label>
		    <div class="controls">
		      <input type="text" id="inputName" name="nom" placeholder="Nom">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputSurname">Cognoms:</label>
		    <div class="controls">
		      <input type="text" id="inputSurname" name="cognoms" placeholder="Cognoms">
		    </div>
		  </div>		  
		  <div class="control-group">
		    <label class="control-label" for="inputPhone">Telèfon:</label>
		    <div class="controls">
		      <input type="text" id="inputPhone" name="telefon" placeholder="Telèfon">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">E-mail:</label>
		    <div class="controls">
		      <input type="text" id="inputEmail" name="email" placeholder="E-mail">
		    </div>
		  </div>
		  		  
		  <div class="control-group">
		    <div class="controls">
		      <label class="checkbox">
		        <input type="checkbox" name="condicions"> Accepto les <a href="http://www.youtube.com" target="_blank">condicions d'ús</a> i la <a href="http://www.pumbao.com" target="_blank">Política de Privacitat.</a>
		      </label>
		      <button name="submit" type="submit" class="btn">Sign in</button>
		    </div>
		  </div>
		<input type="hidden" id="total_amagat" name="total_amagat" value="0">
		</form>
	</body>
</html>
<?php
}