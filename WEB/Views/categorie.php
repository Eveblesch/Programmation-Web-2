<?php
	session_start();
	require_once "../Models/bdd.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Catégorie</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/topic.css">
</head>
<body>
<div id="main">
	<a href='../droit.php'><b>Retour</b></a>
	<form method = "post" action="../Controleurs/add_categorie.php">
		<header><b>NOUVELLE CATEGORIE</b></header><br><br>
		<input type="text" id="cat" placeholder="Rentrez le nom d'une catégorie" name="categorie">
		<button>Valider</button>
	</form>

	<p><b>Catégories disponibles</b></p>

	<?php
	
	$query=$bdd->prepare('SELECT intitule FROM CATEGORIE');
	$query->execute();

	//AFFICHAGE DES CATEGORIES
	while($users=$query->fetch())
	{
		echo "<li>".$users['intitule']."</li>";
	}

	?>
</div>
</body>
</html>