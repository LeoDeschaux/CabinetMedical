<?php
	session_start();
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
			<form action="verification.php" method="post">
				<strong>Se connecter</strong>
					<p><input type="text" name="id" placeholder="Identifiant" ></p>
					<p><input type="password" name="mdp" placeholder=" Mot de passe" ></p>
				<?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    	session_destroy();
                }
                ?>
				<input type="reset" value="Annuler">
				<input type="submit" name = "valider" value="valider">
			</form>
		</div>
	</body>
</html>