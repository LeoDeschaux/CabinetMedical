<?php
include('scripts/session_start.php'); 
$_SESSION['connexion'] = 'non';
//
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
    	<meta charset="utf-8" />
    	<link href="styles/defaut.css" rel="stylesheet" type="text/css">
    	<link href="styles/index.css" rel="stylesheet" type="text/css">
    	<title>Cabinet ORDOMEDIC</title>
	</head>
	<body>
		<main>
			<h1>BIENVENUE CHEZ ORDOMEDIC</h1>
			<div class="formulaire_inscripton">
				<form action="scripts/verification.php" method="post">
					<br>
					<strong>Se connecter</strong>
					<p><input type="text" name="id" placeholder="Identifiant" ></p>
					<p><input type="password" name="mdp" placeholder=" Mot de passe" ></p>
					<?php
					if(isset($_GET['erreur'])){	 // les messages affichés vont dépendre de verification.php en fonction de l'erreur si il y en a une
	                    $err = $_GET['erreur'];
	                    if($err == 1) {
	                        echo "<p style='color:red'>Identifiant ou Mot de passe incorrect</p>"; 
	                    }
	                    if ($err == 2) {
	                        echo "<p style='color:red'>Caractères spéciaux interdit !</p>";
	                    }
	                 }
	                 ?>
	                 <button class="btn-annuler"><a href="index.php" style="text-decoration:none; color: #FFF;">Annuler</a></button> 
					<input class="btn-valider" type="submit" value="Valider">
				</form>
			</div>
		</main>
		<?php include "scripts/footer.php"; // bas de page ?>
</html>