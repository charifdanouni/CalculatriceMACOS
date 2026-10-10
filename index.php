<?php
	require_once("controleur/controleur.class.php");
	//instanciation de la classe controleur 
	$unControleur = new Controleur ();
?>

<!DOCTYPE html>
<html>
<head>
	<title>TP auth</title>
</head>
<body>
<center>
	<img src="images/logo_iris.png" height="200" width="250">
	<h1> TP Authentification Slam 2A 2027 </h1>
	<?php
	require_once ("vue/vue_connexion.php");
	if (isset($_POST['Valider'])){
		$email = $_POST['email']; 
		$mdp = $_POST['mdp']; 

		$unUser = $unControleur->selectWhereUser($email,$mdp); 
		if ($unUser == null){
			echo "<br> Veuillez vérifier vos identifiants";
		}else {
			echo "<br> Bienvenue M. Mme ".$unUser['nom']." ".$unUser['prenom'];
			//test de la date pour demander un changement de mot de passe
			$dtMdp = $unUser ['dateMdp'];
			$toDay = date ("Y-m-d");
			echo "<br> Dates : ".$dtMdp." ".$toDay;
            //creation de deux objets Dates
			$dt1 = new DateTime($dtMdp);
			$dt2 = new DateTime($toDay);
			$diff = $dt2->diff($dt1);
			echo $diff->days;
			if ($diff->days >= 30){
			    //on affiche le formulaire de changement de mdp
				require_once ("vue/vue_change_mdp.php");
		    }
	    }
	}
?>
</center>
</body>
</html>