<?php
	include "FirePHPCore/fb.php";

	$llista_porcions = array(
							array(
								'id'=>01,
								'nom'=>'aleta_Frontal_D',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>02,
								'nom'=>'retrovisor_Dreta',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>03,
								'nom'=>'porta_Frontal_D',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>04,
								'nom'=>'porta_Anterior_D',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>05,
								'nom'=>'aleta_Anterior_D',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>06,
								'nom'=>'paraxocs_Anterior',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>07,
								'nom'=>'malater',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>08,
								'nom'=>'aleta_Anterior_E',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>09,
								'nom'=>'porta_Anterior_E',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>10,
								'nom'=>'porta_Frontal_E',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>11,
								'nom'=>'retrovisor_Esquerra',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>12,
								'nom'=>'aleta_Frontal_E',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>13,
								'nom'=>'paraxocs_Frontal',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>14,
								'nom'=>'tapa_Frontal',
								'descripcio'=>'',
								'preu'=>20000
							),
							array(
								'id'=>15,
								'nom'=>'sostre',
								'descripcio'=>'',
								'preu'=>20000
							)																														
						);
	echo "<pre>";
	print_r($llista_porcions);
	echo "</pre>";
	FB::send("test");
?>

<html>
	<head>
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
			<div id="porcio_paraxocs_Anterior" class="porcio" data-id="paraxocs_Anterior"><h5>Paraxocs Anterior</h5></div>
			<div id="porcio_malater" class="porcio" data-id="malater"></div>
			<div id="porcio_aleta_Anterior_E" class="porcio" data-id="aleta_Anterior_E"></div>
			<div id="porcio_porta_Anterior_E" class="porcio" data-id="porta_Anterior_E"></div>
			<div id="porcio_porta_Frontal_E" class="porcio" data-id="porta_Frontal_E"></div>
			<div id="porcio_retrovisor_Esquerra" class="porcio" data-id="retrovisor_Esquerra"></div>
			<div id="porcio_aleta_Frontal_E" class="porcio" data-id="aleta_Frontal_E"></div>
			<div id="porcio_paraxocs_Frontal" class="porcio" data-id="paraxocs_Frontal"><h5>Paraxocs Frontal</h5></div>
			<div id="porcio_tapa_Frontal" class="porcio" data-id="tapa_Frontal"></div>
			<div id="porcio_sostre" class="porcio" data-id="sostre"></div>													
		</div>
		<div id="formulari">
			<form>
				<table>
					<td>
						<input type="checkbox" name="porcio_cotxe" value="paraxocs_Frontal"> Paraxocs Frontal<br>
						<input type="checkbox" name="porcio_cotxe" value="aleta_Frontal_E"> Aleta Frontal Esquerra<br>
						<input type="checkbox" name="porcio_cotxe" value="retrovisor_Esquerra"> Retovisor Esquerra<br>
						<input type="checkbox" name="porcio_cotxe" value="porta_Frontal_E"> Porta Frontal Esquerra<br>
						<input type="checkbox" name="porcio_cotxe" value="porta_Anterior_E"> Porta Anterior Esquerra<br>
						<input type="checkbox" name="porcio_cotxe" value="aleta_Anterior_E"> Aleta Anterior Esquerra<br>
						<input type="checkbox" name="porcio_cotxe" value="paraxocs_Anterior"> Paraxocs Anterior<br>																								
						<input type="checkbox" name="porcio_cotxe" value="malater"> Malater<br>
					</td>
					<td>
						<input type="checkbox" name="porcio_cotxe" value="aleta_Anterior_D"> Aleta Anterior Dreta<br>
						<input type="checkbox" name="porcio_cotxe" value="porta_Anterior_D"> Porta Anterior Dreta<br>
						<input type="checkbox" name="porcio_cotxe" value="porta_Frontal_D"> Porta Frontal Dreta<br>																								
						<input type="checkbox" name="porcio_cotxe" value="retrovisor_Dreta"> Retrovisor Dreta<br>
						<input type="checkbox" name="porcio_cotxe" value="aleta_Frontal_D"> Aleta Frontal Dreta<br>
						<input type="checkbox" name="porcio_cotxe" value="tapa_Frontal"> Tapa Frontal<br>
						<input type="checkbox" name="porcio_cotxe" value="sostre"> Sostre<br>																								
					</td>
				</table>
			</form>
		</div>
	</body>
</html>