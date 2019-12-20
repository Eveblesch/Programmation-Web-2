<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>TOPIC</title>
	<link rel="stylesheet" type="text/css" href="../CSS/topic.css">
	<meta charset="utf-8">

</head>
<div id="main">
	<header><b>NOUVEAU TOPIC</b></header>
	<body>
	</br></br>
	<a href='../droit.php'><b>Retour</a></b></br></br>

	<form method = "post" action="../Controleurs/add_topic.php">
		<input type="text" placeholder = "Titre du topic" name="topic">
		</br>
		<input type="text" placeholder="Entrez le nom de la catégorie..." name="categorie">
		</br>
       	<button>Publier</button>
       <?php echo $_SESSION["message"]; ?>
	</form>

	<p><b>Catégories disponibles</b></p>

	<?php
	require_once "../Models/bdd.php";

	$query=$bdd->prepare('SELECT intitule FROM CATEGORIE');
	$query->execute();
	while($users=$query->fetch())
	{
		echo "<li>".$users['intitule']."</li>";
	}
	?>
</div>


</body>
</html>
