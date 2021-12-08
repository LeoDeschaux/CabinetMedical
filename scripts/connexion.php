<?php
	// connexion à la base de données
    $bdd_nom = 'root';
    $bdd_mdp = '';
    $bdd_table = 'cabinet';
    $bdd_host = 'localhost';
    $db = mysqli_connect($bdd_host, $bdd_nom, $bdd_mdp,$bdd_table)
           or die('could not connect to database');

	session_start();
	if ($_SESSION['connexion'] !== 'oui') {
		header('Location: /www/CabinetMedical/index.php');
	}

	if (isset($_POST['deconnexion'])) {
		if ($_POST['deconnexion']) {
			session_destroy();
			header("Refresh:0");
		}
	}
	
?>