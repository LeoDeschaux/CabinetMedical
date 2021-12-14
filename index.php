<?php
include($_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/session_start.php'); 
$_SESSION['connexion'] = 'non';
?>
<!DOCTYPE HTML>
<html lang="fr">
	
	<head>
    	<meta charset="utf-8" />
    	<link href="styles/index.css" rel="stylesheet" type="text/css">
    	<title>Accueil</title>
    	<img src="images/golo.jpg" alt="logo" class="logo">
    	<header>
    		<h1>Bienvenue chez Ordomedic</h1>
    	</header>
	</head>
	<body>
		<div class="formulaire_inscripton">
			<form action="scripts/verification.php" method="post">
				<strong>Se connecter</strong>
					<p><input type="text" name="id" placeholder="Identifiant" ></p>
					<p><input type="password" name="mdp" placeholder=" Mot de passe" ></p>
					<?php
	                if(isset($_GET['erreur'])){
	                    $err = $_GET['erreur'];
	                    if($err==1)
	                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
	                }
                	?>
				<input type="reset" value="Annuler">
				<input type="submit" name = "valider" value="valider">
			</form>

			<br>
			
			<!-- <a href="/CabinetMedical/pages/usagers/rechercher.php">CHEAT GO TO ACCUEIL</a> -->

		</div>
	</body>
</html>