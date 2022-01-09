<?php
include('connexion.php'); 

if(isset($_POST['id']) && isset($_POST['mdp'])) {

  if(preg_match('`([\-_.,;:\|]+)`', $_POST['id'])) {           // Ces caractères ne sont pas utilisables pour renseigner l'identifiant

    header('Location: ../index.php?erreur=2');                 // redirection vers index.php, via header.php affiche "Caractères spéciaux interdit"

  } elseif (preg_match('`([\-_.,;:\|]+)`', $_POST['id'])) {    // Ces caractères ne sont pas utilisables pour renseigner le mot de passe

    header('Location: ../index.php?erreur=2');                 // redirection vers index.php, via header.php affiche "Caractères spéciaux interdit"

  } else {
    
      if ($_POST['id'] == "root") {                            // verification de l'identifiant

        if ($_POST['mdp'] == "$iutinfo") {                         // verification du mot de passe

          $_SESSION['connexion'] = 'oui';                      // connexion réussite
          header('Location: ../pages/usagers/rechercher.php'); // redirection vers l'accueil 

        } else {
          header('Location: ../index.php?erreur=1');           // redirection vers index.php, via header.php affiche "Utilisateur ou mot de passe incorrect"
        }
      } else {
          header('Location: ../index.php?erreur=1');           // redirection vers index.php, via header.php affiche "Utilisateur ou mot de passe incorrect"
      }
  }
} 
?>

etu
$iutinfo