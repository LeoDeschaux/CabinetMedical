<?php
	///Connexion au serveur MySQL
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

	if ($_SESSION['connexion'] !== 'oui') {
		header('Location: /CabinetMedical/index.php');
	}
	
	if (isset($_POST['deconnexion'])) {
		if ($_POST['deconnexion']) {
			$_SESSION['connexion'] = 'non';  
			header("Refresh:0");
		}
	}
	
?>