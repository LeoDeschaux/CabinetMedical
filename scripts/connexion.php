<?php
	include('session_start.php'); 

	// Connexion au serveur MySQL
  	$server = 'localhost';//'127.0.0.1';
	$login = 'id18235165_root';
    $mdp = '@(bCM&?(MJvS875A';
	$db = 'id18235165_cabinetmedical';

	/*
	// Connexion au serveur MySQL
	$login = 'root';
    $mdp = '';
  	$server = '127.0.0.1';
	$db = 'cabinet';
	*/
	
	try {

		$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

		$linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    //$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	}
	    catch (Exception $e) {
	    die('Erreur : ' . $e->getMessage());
	}
	
	if ($_SESSION['connexion'] !== 'oui') {									// Empêche la navigation via l'url si l'utilisateur ne s'est pas connécté 
		header('Location: ../index.php');						// redirige l'utilisateur vers index.php
	}
	
	if (isset($_POST['deconnexion'])) {										// Déconnecte l'utilisateur et le redirige vers index.php 
		if ($_POST['deconnexion']) {
			$_SESSION['connexion'] = 'non';  								// deconnecte l'utilisateur
			header("Refresh:0");											// comme l'utilisateur est déconnecté alors il est redirigé vers index.php
		}
	}
	
?>