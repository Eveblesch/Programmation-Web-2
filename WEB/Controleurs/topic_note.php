<?php
session_start();
require "../Models/user.php";

$count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM TOPIC_NOTE WHERE id_topic=".$_GET['param']." AND id_utilisateur=".$_GET['uti']);
$count->execute(array($_GET['uti']));
$req=$count->fetch(PDO::FETCH_ASSOC);

echo $_GET['uti']."->".$_GET["param"];
echo "<br>".$req['nbr'];
//TEST SI LA NOTE EST DEJA SET OU PAS
if($req['nbr']==0)
{
	$a=$bdd->prepare('INSERT INTO TOPIC_NOTE(note, id_utilisateur, id_topic) VALUES (:note2,:id_utilisateur2,:id_topic2)');
	$a->bindParam(':note2',$_GET['note']);
	$a->bindParam(':id_utilisateur2',$_GET['uti']);
	$a->bindParam(':id_topic2',$_GET['param']);
	$a->execute();

}
else
{
	$b=$bdd->prepare("UPDATE TOPIC_NOTE SET note=".$_GET['note']." WHERE id_utilisateur=".$_GET['uti']);
	$b->execute();
}



//RECUPERATION DE LA MOYENNE
$c=$bdd->prepare("SELECT AVG(note) AS moyenne FROM TOPIC_NOTE WHERE id_topic='".$_GET['param']."'");
$c->execute(array($_GET['param']));
$req2=$c->fetch(PDO::FETCH_ASSOC);


//RENTRER DANS LA TABLE TOPIC LA NOTE MOYENNE
$d=$bdd->prepare("UPDATE TOPIC SET note_moy='".$req2['moyenne']."' WHERE id='".$_GET['param']."'");
$d->execute();

$count2=$bdd->prepare("SELECT COUNT(*) AS total FROM TOPIC_NOTE WHERE id_topic='".$_GET['param']."'");
$count2->execute(array($_GET['param']));
$req3=$count2->fetch(PDO::FETCH_ASSOC);
$_SESSION['nbre_votes']=$req3["total"];

header("Location: ../droit.php");


?>
