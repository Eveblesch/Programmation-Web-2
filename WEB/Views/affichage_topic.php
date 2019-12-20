<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>TOPIC</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../CSS/affichage.css">
</head>
<body>
<a href='../droit.php'>Retour</a></br>
<h1><b>Topic</b></h1>
<?php
	require "../Models/bdd.php";


 		$query=$bdd->prepare('SELECT intitule, id FROM TOPIC ORDER BY id');
        $query->execute();

    while($affichage_topic=$query->fetch())
    {
    	echo "<ul><b>".$affichage_topic['intitule']."</b>";
		
		$query2=$bdd->prepare('SELECT intitule FROM COMMENTAIRE WHERE id_topic="'.$affichage_topic["id"].'" ORDER BY date_ecriture');
        $query2->execute();

        while($affichage_commentaire=$query2->fetch())
		{
			echo "<li>".$affichage_commentaire['intitule']."</li>";
		}
		echo "</ul>";
    }
?>
</body>
</html>