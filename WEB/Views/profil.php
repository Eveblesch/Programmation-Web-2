<?php
	session_start();
	require_once "../Models/user.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>PROFIL</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/profil.css">
</head>
<body>
	
<!---------------AFFICHAGE DES INFORMATIONS---------->
<div id="info">
	<h1>Profil</h1>
	<?php 
		
		$user=new User($_SESSION["login"], null, null, null, null, null);
		$user->getInfo();
		echo "<a href='../droit.php'>Retour</a>";
		echo "<ul>";
			if($user->getdroit()==1)
            $recup_droit="Utilisateur";
        else if($user->getdroit()==2)
            $recup_droit="Moderateur";
        else if($user->getdroit()==3)
            $recup_droit="Administrateur";

		if($user->getdroit()==1)
			echo "<li><b>Login :</b> " .$user->getLogin()." (".$recup_droit.")<li>";
		if($user->getdroit()==2)
			echo "<li><b>Login :</b> " .$user->getLogin()." (".$recup_droit.")<li>";
		if($user->getdroit()==3)
			echo "<li><b>Login : </b>" .$user->getLogin()." (".$recup_droit.")<li>";
		echo "<li><b>Pseudo :</b> " .$user->getpseudo()."<li>";
		echo "<li><b>Mot de passe :</b> Crypté<li>";
		echo "<li><b>Email :</b> " .$user->getemail()."<li>";
		echo "<ul>";
	?>
</div>

<!---------------CHANGEMENT DU MOT DE PASSE--------------->

<form method="POST" action="../Controleurs/changepasswd.php">
	<p><b>Changer de mot de passe </b></p>
	<input type="text" placeholder = "Ancien mot de passe" name="mdp"></br>
	<input type="text" placeholder = "Nouveau mot de passe" name="mdp1"></br>
    <input type="text" placeholder="Confirmation" name="mdp2"></br>
    <button>Modifier</button>
    <div class="erreur"><?php echo $_SESSION['ch_mdp'];?></div>
</form>

<!---------------CHANGEMENT DE L'EMAIL--------------->

<form method="POST" action="../Controleurs/changeemail.php">
	<p><b>Changer d'adresse email </b></p>
	<input type="text" placeholder = "Ancienne adresse" name="email"></br>
	<input type="text" placeholder = "Nouvelle adresse" name="email1"></br>
    <input type="email" placeholder="Confirmation nouvelle adresse" name="email2"></br>
    <button>Modifier</button></br>
    <div class="erreur"><?php echo $_SESSION['ch_email'];?></div>
</form>

<!-----------SUPPRESSION DE SON COMPTE--------------->

</br><button onclick="location.href = '../Controleurs/deleteuser.php'">Supprimer mon compte</button>   


<!-----------SUPPRESSION D'UN UTILISATEUR------------>
<?php 
	if($user->getdroit()==3)
	{ ?>

	<form method="POST" action="../Controleurs/supUtilisateur.php">
		<p><b>Supprimer un utilisateur </b></p>
		<input type="text" placeholder = "Nom de l'utilisateur" name="supp"></br>
	  	<button>Supprimer</button>
	</form>
	<div class="erreur"><?php echo $_SESSION['ch_util']; ?></div>

	<div id="utilisateur">
	
<!---------AFFICHAGE DE LA LISTE DES UTILISATEURS------->
		<p><b>Tous les utilisateurs</b></p>

		<?php
		
		$query=$bdd->prepare('SELECT login FROM UTILISATEUR');
		$query->execute();
		while($users=$query->fetch())
		{
			echo "<li>".$users['login']."</li>";
		}
	?>
	</div>
		<form method="POST" action="profil_utilisateur.php">
		<p><b>Voir le profil d'un utilisateur </b></p>
		<input type="text" placeholder = "Nom de l'utilisateur" name="profil"></br>
	  	<button>Voir</button>
	  	<?php echo $_SESSION["message"];?>
	</form>
	<?php } ?>
	

</body>
</html>