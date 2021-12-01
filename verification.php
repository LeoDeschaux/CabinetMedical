<?php
//session_start();
if(isset($_POST['id']) && isset($_POST['mdp']))
{
    // connexion à la base de données
    $bdd_nom = 'root';
    $bdd_mdp = '';
    $bdd_table = 'cabinet';
    $bdd_host = 'localhost';
    $db = mysqli_connect($bdd_host, $bdd_nom, $bdd_mdp,$bdd_table)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $id = mysqli_real_escape_string($db,htmlspecialchars($_POST['id'])); 
    $mdp = mysqli_real_escape_string($db,htmlspecialchars($_POST['mdp']));
    
    if($id !== "" && $mdp !== "")
    {
        $requete = "SELECT count(*) FROM secretariat where 
              id = '".$id."' and mdp = '".$mdp."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['id'] = $id;
           header('Location: pages/accueil.php');
        }
        else
        {
           header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: index.php');
}
mysqli_close($db); // fermer la connexion
?>