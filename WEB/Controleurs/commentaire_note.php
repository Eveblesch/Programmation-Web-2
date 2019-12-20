<?php
session_start();
require "../Models/user.php";

//COMPTE LE NOMBRE DE NOTE POUR LE COMMENTAIRE
$a=$bdd->prepare("SELECT COUNT(*) AS note FROM COMMENTAIRE_NOTE WHERE id_commentaire='".$_GET['id_com']."' AND id_utilisateur='".$_GET['id_uti']."'");
$a->execute(array($_GET['id_com']));
$req3=$a->fetch(PDO::FETCH_ASSOC);

//RECUPERATION DE LA NOTE DONNEE PAR UN UTILISATEUR (vaut 1 ou -1)
$f=$bdd->prepare("SELECT note FROM COMMENTAIRE_NOTE WHERE id_commentaire='".$_GET['id_com']."' AND id_utilisateur='".$_GET['id_uti']."'");
$f->execute(array($_GET['id_com']));
$req4=$f->fetch(PDO::FETCH_ASSOC);


if($req3['note']==0) //Pas encore noté
{
	if($_GET['signe']==1) //S'il appuie sur +
	{
		$b=$bdd->prepare("INSERT INTO COMMENTAIRE_NOTE(note, id_utilisateur, id_commentaire) VALUES (1,:id_utilisateur2,:id_commentaire2)");
		$b->bindParam(":id_utilisateur2",$_GET['id_uti']);
		$b->bindParam(":id_commentaire2",$_GET['id_com']);
		$b->execute();
	}
	else //S'il appuie sur -
	{
		$c=$bdd->prepare("INSERT INTO COMMENTAIRE_NOTE(note, id_utilisateur, id_commentaire) VALUES (-1,:id_utilisateur2,:id_commentaire2)");
		$c->bindParam(":id_utilisateur2",$_GET['id_uti']);
		$c->bindParam(":id_commentaire2",$_GET['id_com']);
		$c->execute();
	
	}
}
else //Déjà noté
{
	if($_GET['signe']==1) //Si il veut mettre un +
	{
		if($req4["note"]==(-1)) // et que avant c'était un -
		{
			$d=$bdd->prepare("UPDATE COMMENTAIRE_NOTE SET note=1 WHERE id_commentaire=:id_commentaire3 AND id_utilisateur='".$_GET['id_uti']."'");
			$d->bindParam(":id_commentaire3",$_GET['id_com']);
			$d->execute();
		}
	}

	if($_GET['signe']==2) //Si il veut mettre un - 
	{
		if($req4["note"]==1) // et que avant c'était un +
		{
			$e=$bdd->prepare("UPDATE COMMENTAIRE_NOTE SET note=-1 WHERE id_commentaire=:id_commentaire3 AND id_utilisateur='".$_GET['id_uti']."'");
			$e->bindParam(":id_commentaire3",$_GET['id_com']);
			$e->execute();
		}
	}
}


//CALCULER LA NOTE TOTALE D'UN COMMENTAIRE
$g=$bdd->prepare("SELECT SUM(note) AS somme FROM COMMENTAIRE_NOTE WHERE id_commentaire='".$_GET['id_com']."'");
$g->execute(array($_GET['id_com']));
$req5=$g->fetch(PDO::FETCH_ASSOC);
echo "<br>".$req5["somme"];

//REMPLIR DANS LA BASE COMMENTAIRE LA NOTE_TOTALE
$h=$bdd->prepare("UPDATE COMMENTAIRE SET note_totale=:note1 WHERE id=:id_commentaire3");
$h->bindParam(":note1",$req5['somme']);
$h->bindParam(":id_commentaire3",$_GET['id_com']);
$h->execute();

header("Location: ../droit.php");


