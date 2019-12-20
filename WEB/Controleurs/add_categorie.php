<?php
	session_start();
	require_once "../Models/user.php";

	$cat=htmlentities($_POST['categorie']);
	$user=new User($_SESSION["login"], null, null, null, null, null);
	$user->getInfo();
	//ON COMPTE LE NOMBRE DE FOIS QU'ON A LA CATEGORIE (Si 0 elle existe pas, sinon elle existe)
	$count = $bdd->prepare("SELECT COUNT(*) AS nbre FROM CATEGORIE WHERE intitule='".$cat."'");
	$count->execute(array($cat));
	$query=$count->fetch(PDO::FETCH_ASSOC);

	//SI LA CATEGORIE N'EXISTE PAS DANS LA BDD --> CREATION
	if($query['nbre']==0)
	{
		$a = $bdd->prepare("INSERT INTO CATEGORIE(intitule, id_utilisateur) VALUES (:intitule1, :id_utilisateur1)");
	 	$a->bindParam(':intitule1',$cat);
        $a->bindParam(':id_utilisateur1', $user->getid());
        $a->execute();
        
        header("Location: ../droit.php");
	}
	else
	{
		header("Location: ../Views/categorie.php");

	}
		

?>


