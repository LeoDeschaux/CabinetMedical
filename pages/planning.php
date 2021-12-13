<!DOCTYPE HTML>
<html>
	
	<head>
		<title>Planning</title>
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
			$CouleurMenu = 'Planning';
			$headerPath =  $_SERVER['DOCUMENT_ROOT'] . '/CabinetMedical/scripts/header.php';
			include($headerPath); 
		?>
		<!--
		<section style="text-align: center">
			<h1 style="font-family: arial;font-size: 5em;color: deeppink;, text-align: center !important;">
				PLANNING
			</h1>
		</section>
		-->

	<?php
	onFieldChange();

	function onFieldChange()
	{
		if(empty($_POST['search']))
		{
			showAllUsagers();
		}
		else
		{
			showCorrespondingUsagers();
		}
	}

	?>

	<?php 
	function showCorrespondingUsagers()
	{
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

	    $req = $linkpdo->prepare("SELECT * FROM usager WHERE nom=:nom OR prenom=:prenom OR adresse=:adresse OR cp=:cp OR ville=:ville");
    
	    $field = $_POST['search'];

	    $req->execute(array(
	    'nom' => $field,
	    'prenom' => $field));
	    
	    ///Affichage des entrées du résultat une à une
	    echo "<h2>Liste de toutes les consultations :</h2>";

	    echo "<table class=\"tableau_table\">";
	    echo "<tr class=\"tableau_cell_title\">";
	        echo "<th>Nom</th>";
	        echo "<th>Prenom</th>";
	    echo "</tr>";

	    while ($row = $req->fetch())
	    {
	        echo "<tr class=\"tableau_cell_title\">";
	            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
	            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";
	        echo "</tr>";
	    }

	    echo "</table>";
	    
	    $req->closeCursor(); 
	}


	function showAllUsagers()
	{
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

	    ///Sélection de tout le contenu de la table carnet_adresse
	    $req = $linkpdo->query("SELECT * FROM usager");
	    
	    ///Affichage des entrées du résultat une à une
	    echo "<h2>Liste de toutes les consultations :</h2>";

	    echo "<table class=\"tableau_table\">";
	    echo "<tr class=\"tableau_cell_title\">";
	        echo "<th>Nom</th>";
	        echo "<th>Prenom</th>";

	        echo "<th>Modifier</th>";
	        echo "<th>Supprimer</th>";
	    echo "</tr>";

	    while ($row = $req->fetch())
	    {
	    	$id = $row['id_u'];

	        echo "<tr class=\"tableau_cell_title\">";
	            echo "<td class=\"tableau_cell\">" . $row['nom'] . "</td>";
	            echo "<td class=\"tableau_cell\">" . $row['prenom'] . "</td>";

	            //echo "<td class=\"tableau_cell\">" . Date("d-m-Y", $row['date_naissance']). "</td>";

	            echo "<td class=\"tableau_cell\"><a href=\"modifier.php?id=$id\">Modifier</a></td>";
                echo "<td class=\"tableau_cell\"><a href=\"supprimer.php?id=$id\">Supprimer</a></td>";
	        echo "</tr>";
	    }

	    echo "</table>";
	    
	    $req->closeCursor(); 
	}

	?>

	</body>

</html>