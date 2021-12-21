<?php
	// Connexion au serveur MySQL
	$login = 'root';
    $mdp = '';
  	$server = '127.0.0.1';
	$db = 'cabinet';
	try {
	    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	}
	    catch (Exception $e) {
	    die('Erreur : ' . $e->getMessage());
	}

	// Empêche la navigation via l'url si l'utilisateur ne s'est pas connécté 
	if ($_SESSION['connexion'] !== 'oui') {
		header('Location: /CabinetMedical/index.php');
	}
	
	// Déconnecte l'utilisateur et le redirige vers index.php 
	if (isset($_POST['deconnexion'])) {
		if ($_POST['deconnexion']) {
			$_SESSION['connexion'] = 'non';  
			header("Refresh:0");
		}
	}
	
?>