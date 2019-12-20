<?php

session_start();
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFIL UTILISATEUR</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/profil.css">
</head>
<body>

<div id="info">
	<h1>Profil</h1>
	<?php 
		require_once "../Models/user.php";

		//VERIFICATION SI L'UTILISATEUR EST DANS LA BASE
		$a=$bdd->prepare("SELECT COUNT(*) AS nbre FROM UTILISATEUR WHERE login=:login1");
		$a->bindParam(":login1",$_POST['profil']);
		$a->execute();
		$req=$a->fetch(PDO::FETCH_ASSOC);


		if(!isset($_POST["profil"])||$req["nbre"]==0)
		{
			$_SESSION["message"]="Utilisateur inexistant";
			header("Location: profil.php");
		}
		else
		{
			$_SESSION['profil']=$_POST['profil'];
		}


		$user=new User($_SESSION['profil'], null, null, null, null, null);
		$user->getInfo();
		$_SESSION["changement_utilisateur"]=$user->getid();
		
		$droit=$user->getdroit();
		if($droit==1)
            $recup_droit="Utilisateur";
        else if($droit==2)
            $recup_droit="Moderateur";
        else if($droit==3)
            $recup_droit="Administrateur";

		echo "<a href='profil.php'>Retour à l'administrateur</a>";
		echo "<ul>";
		if($user->getdroit()==1)
			echo "<li><b>Login :</b> " .$user->getLogin()." (".$recup_droit.")<li>";
		if($user->getdroit()==2)
			echo "<li><b>Login :</b> " .$user->getLogin()." (".$recup_droit.")<li>";
		if($user->getdroit()==3)
			echo "<li><b>Login : </b>" .$user->getLogin()." (".$recup_droit.")<li>";
		
		echo "<li><b>Pseudo :</b> " .$user->getpseudo()."<li>";
		echo "<li><b>Mot de passe :</b> Crypté <li>";
		echo "<li><b>Email :</b> " .$user->getemail()."<li>";
		echo "<ul>";
	?>
</div>
	</div>

		<!--CHANGEMENT DU DROIT DE L'UTILISATEUR-->

		<form method="POST" action="../Controleurs/changer_droit.php">
		<p><b>Changer le droit (Choisir entre "Administrateur", "Moderateur","Utilisateur")</b></p>
		<input type="text" placeholder = "Rentrer le nouveau droit" name="droit"></br>
	  	<button>Modifier</button>
	  	<?php echo $_SESSION['message_droit'];?>
	</form>
</body>
</html>
