<?php
	include "FirePHPCore/fb.php";

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
	FB::send("test");
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
			<div id="porcio_aleta_Frontal_D" class="porcio" data-id="aleta_Frontal_D"></div>
			<div id="porcio_retrovisor_Dreta" class="porcio" data-id="retrovisor_Dreta"></div>
			<div id="porcio_porta_Frontal_D" class="porcio" data-id="porta_Frontal_D"></div>
			<div id="porcio_porta_Anterior_D" class="porcio" data-id="porta_Anterior_D"></div>
			<div id="porcio_aleta_Anterior_D" class="porcio" data-id="aleta_Anterior_D"></div>	
			<div id="porcio_paraxocs_Anterior" class="porcio" data-id="paraxocs_Anterior"><h5><?php echo "<b>".$llista_porcions['paraxocs_Anterior']['nom']."</b>";?></h5></div>
			<div id="porcio_malater" class="porcio" data-id="malater"></div>
			<div id="porcio_aleta_Anterior_E" class="porcio" data-id="aleta_Anterior_E"></div>
			<div id="porcio_porta_Anterior_E" class="porcio" data-id="porta_Anterior_E"></div>
			<div id="porcio_porta_Frontal_E" class="porcio" data-id="porta_Frontal_E"></div>
			<div id="porcio_retrovisor_Esquerra" class="porcio" data-id="retrovisor_Esquerra"></div>
			<div id="porcio_aleta_Frontal_E" class="porcio" data-id="aleta_Frontal_E"></div>
			<div id="porcio_paraxocs_Frontal" class="porcio" data-id="paraxocs_Frontal"><h5><?php echo "<b>".$llista_porcions['paraxocs_Frontal']['nom']."</b>";?></h5></div>
			<div id="porcio_tapa_Frontal" class="porcio" data-id="tapa_Frontal"></div>
			<div id="porcio_sostre" class="porcio" data-id="sostre"></div>													
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
	</body>
</html>