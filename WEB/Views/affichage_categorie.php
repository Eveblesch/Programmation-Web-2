<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CATEGORIES</title>
    <link rel="stylesheet" type="text/css" href="../CSS/affichage.css">
</head>
<body>
    <a href='../droit.php'>Retour</a>
    <h1><b>Catégories disponibles</b></h1>
<?php
 require "../Models/bdd.php";
        $query=$bdd->prepare('SELECT intitule,id FROM CATEGORIE ORDER BY id');
        $query->execute();
        while($affichage_cat=$query->fetch())
        {
                echo "<ul><b>".$affichage_cat['intitule']."</b>";

                $query2=$bdd->prepare('SELECT intitule FROM TOPIC WHERE id_categorie="'.$affichage_cat["id"].'" ORDER BY date_modif');
                $query2->execute();

                while($affichage_topic=$query2->fetch())
                {
                    echo "<li>".$affichage_topic['intitule']."</li>";
                    
                }
                echo "</ul>";
        }
?>
</body>
</html>
