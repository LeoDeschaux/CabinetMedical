<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Statistiques</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" href="../styles/defaut.css">
    	<?php 
			include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/connexion.php'); 
		?>
	</head>

	<body>

    	<!-- ///////////////////// NAVIGUATION BAR //////////////////// -->
    	<?php 
			$var = '1';
			$CouleurMenu = 'Statistiques';
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php';
			include($headerPath); 
		?>
		<!--
		<img src="../images/golo.jpg">
		-->
		<section style="text-align: center">
			<h1 style="font-family: arial;font-size: 5em;color: deeppink;, text-align: center !important;">
				STATISTIQUES
			</h1>
			<table>
				<thead>
					<tr>
						<th colspan="2">boubouboubou</th>
					</tr>
				</thead>
				<tbody>
			        <tr>
			            <td>The table body</td>
			            <td>with two columns</td>
			        </tr>
			    </tbody>
			</table>
		</section>
		
	</body>

</html>