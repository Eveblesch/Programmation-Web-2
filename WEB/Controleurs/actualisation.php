<?php
require "../Models/user.php";
session_start();
$_SESSION['test']=$_GET['param1'];
echo $_SESSION['test'];

$query=$bdd->prepare('SELECT id FROM TOPIC WHERE intitule=:intitule2');
$query->bindParam(":intitule2",$_SESSION['test']);
$query->execute();
$tab=$query->fetch();

$count2=$bdd->prepare("SELECT COUNT(*) AS total FROM TOPIC_NOTE WHERE id_topic=".$tab['id']);
$count2->execute(array($tab['id']));
$req3=$count2->fetch(PDO::FETCH_ASSOC);
echo $req3["total"];
$_SESSION['nbre_votes']=$req3["total"];

header("Location: ../droit.php");
?>