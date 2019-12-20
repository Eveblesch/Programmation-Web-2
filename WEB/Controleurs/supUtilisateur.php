<?php
session_start();
require "../Models/user.php";

unset($_SESSION['ch_util']);

$user=new User($_POST["supp"], null, null, null, null, null);
$user->getInfo();

//ON COMPTE COMBIEN DE FOIS IL Y A L'UTILISATEUR (POUR VERIFIER QU'IL SOIT BIEN DANS LA BDD)
$count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM UTILISATEUR WHERE login='".$user->getLogin()."'");
$count->execute(array($user->getLogin()));
$req  = $count->fetch(PDO::FETCH_ASSOC);

//SI L'UTILISATEUR EST BIEN DANS LA BDD
if($req['nbr']==1)
{
    $a=$bdd->prepare('DELETE FROM UTILISATEUR WHERE login=:login');
	$a->bindParam(':login', $_POST["supp"]);
	$a->execute();
	header("Location: ../Views/profil.php");
	$_SESSION['ch_util']="Utilisateur supprimé";
}
else
{
	header("Location: ../Views/profil.php");
	$_SESSION['ch_util']="Utilisateur inexistant";

}


?>
