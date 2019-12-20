<?php
session_start();
require "../Models/user.php";
unset($_SESSION["message"]);

if(!isset($_SERVER['REQUEST_METHOD']) || !is_string($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST')
{
        header('Location: ../Views/signup.php');
        exit;
}

else
{
    //AJOUT D'UN UTILISATEUR
    if(isset($_POST['login'],$_POST['mdp'], $_POST['pseudo'], $_POST['email']))
    {
        $login = htmlentities($_POST['login']);
        $mdp=password_hash($_POST['mdp'],PASSWORD_DEFAULT);
        $pseudo = htmlentities($_POST['pseudo']);
        $email = htmlentities($_POST['email']);


        //VERIFICATION DE L'UNICITE DES INFORMATIONS RENTREES
        $a=$bdd->prepare("SELECT COUNT(*) AS nbre FROM UTILISATEUR WHERE login=:login1 OR pseudo=:pseudo1 OR email=:email1");
        $a->bindParam(':login1',$_POST['login']);
        $a->bindParam(':pseudo1',$_POST['pseudo']);
        $a->bindParam(':email1',$_POST['email']);
        $a->execute();
        $req=$a->fetch(PDO::FETCH_ASSOC);

        //UTILISATEUR INEXISTANT
        if($req["nbre"]==0)
        {
            $new_user=new User($login,$mdp, $pseudo, $email,1,1);
            $new_user->create();
            header("Location: ../Views/signin.php");
        }

        else
        {
            $_SESSION["message"]="Informations déjà existantes";
            header("Location: ../Views/signup.php");
        }
    }
}

?>
