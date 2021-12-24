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
	</head>
	<body>
		<h1>BIENVENUE CHEZ ORDOMEDIC</h1>
		<div class="formulaire_inscripton">
			<form action="scripts/verification.php" method="post">
				<br>
				<strong>Se connecter</strong>
				<p><input type="text" name="id" placeholder="Identifiant" ></p>
				<p><input type="password" name="mdp" placeholder=" Mot de passe" ></p>
				<?php
				if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err == 1) {
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                    if ($err == 2) {
                        echo "<p style='color:red'>Caractères spéciaux interdit !</p>";
                    }
                 }
                 ?>
   				<input class="btn-annuler" type="reset" value="Annuler"> 
				<input class="btn-valider" type="submit" value="valider">
			</form>
		</div>
	</body>
</html>