<?php
	session_start();
	require_once "../Models/user.php";
	unset($_SESSION["message"]);

	$cat=htmlentities($_POST['categorie']);
	$topic=htmlentities($_POST['topic']);

	//ON REGARDE SI LE TOPIC EXISTE DANS LA BDD (si 0 alors il existe pas, sinon il existe)
	$count = $bdd->prepare("SELECT COUNT(*) AS nbre FROM TOPIC WHERE intitule='".$topic."'");
	$count->execute(array($topic));
	$query=$count->fetch(PDO::FETCH_ASSOC);

	//SI IL N'EXISTE PAS --> CREATION
	if($query['nbre']==0)
	{
		$user=new User($_SESSION["login"], null, null, null, null, null);
		$user->getInfo();
		
		//RECUPERATION DE LA CATEGORIE
		$b = $bdd->prepare("SELECT id from CATEGORIE WHERE intitule=:intitule2");
		$b->bindParam(':intitule2',$cat);
		$b->execute();
		$res=$b->fetch(PDO::FETCH_ASSOC);

		//VERIFICATION QUE LA CATEGORIE EXISTE
		$count2 = $bdd->prepare("SELECT COUNT(*) AS nbre_cat FROM TOPIC WHERE id_categorie='".$res['id']."'");
		$count2->execute(array($cat));
		$query2=$count2->fetch(PDO::FETCH_ASSOC);

		if($query2["nbre_cat"]==0)
		{
			header("Location: ../Views/topic.php");
			$_SESSION["message"]="catégorie inexistante";

		}
		else
		{

			//INSERTION DU TOPIC DANS LA CATEGORIE
			$a = $bdd->prepare("INSERT INTO TOPIC(intitule, note_moy, date_modif, id_utilisateur, id_categorie) VALUES (:intitule1,0,NOW(), :id_utilisateur1, :id_categorie1)");
		 	$a->bindParam(':intitule1',$topic);
	        $a->bindParam(':id_utilisateur1', $user->getid());
	        $a->bindParam(':id_categorie1',$res['id']);
	        $a->execute();
	        header("Location: ../droit.php");
		}
	}
	else
	{
		header("Location: ../Views/topic.php");

	}
		

?>


