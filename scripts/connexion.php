<?php

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