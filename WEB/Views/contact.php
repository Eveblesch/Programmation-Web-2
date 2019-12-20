<?php
	session_start();
	require_once "../Models/bdd.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/contact.css">
</head>
<body>
	<form method="POST" action="../Controleurs/envoieMail.php">
		<h1>Contacter l'administrateur</h1>
		<input type="text" placeholder = "Objet" name="objet"></br>
	   	<textarea id="email" placeholder="Rentrez le contenu...." name="email" rows="5" cols="33"></textarea></br>
	    <button>Envoyer</button>
	    <?php echo $_SESSION['envoie'];?>
	  
	</form>
	<a href="../droit.php">Accueil</a>

</body>
</html>
