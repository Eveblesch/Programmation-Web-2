<?php

    if(!isset($_SERVER['REQUEST_METHOD']) || !is_string($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        header('Location: ../Views/signin.php');
        exit;
    }

    session_start();
    unset($_SESSION['message']);
    require "../Models/user.php";

    //SI TOUS LES CHAMPS SONT REMPLIS
    if(isset($_POST['login'], $_POST['mdp']) && is_string($_POST['login']) && is_string($_POST['mdp']))
    {
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['mdp']);
        

		$new_user=new User($login,null,null,null,null,null);
        $new_user->getInfo();

        //SI L'UTILISATEUR EST DANS LA BASE DE DONNEES --> CONNEXION
        if(password_verify($password,$new_user->getmdp()))
        {
            $_SESSION['login']=$login;
            $_SESSION['pseudo']=$new_user->getpseudo();
            $_SESSION['logged']=true;
            $_SESSION['droit']=$new_user->getdroit();
            $_SESSION['email']=$new_user->getemail();
            header("Location: ../droit.php");

        }
        else
        {
            $_SESSION['message']="Mauvaises informations";
            header("Location: ../Views/signin.php");

        }
    }
?>
