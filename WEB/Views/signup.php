<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Créer un compte</title>
        <link rel="stylesheet" type="text/css" href="../CSS/signup.css"/>
    </head>
    <body>
        <div class="container">
            <h1>Créer un compte</h1>
            <form method="post" action="../Controleurs/adduser.php">
                <input name="login" type="text" placeholder="Login" /></br>
                <input name="mdp" type="password" placeholder="Mot de passe" /></br>
                <input name="pseudo" type="text" placeholder="Pseudo" /></br>
                <input name="email" type="email" placeholder="Email" /></br>
                <button>Créer</button>        
            </form>
            <?php echo $_SESSION["message"];?>

            </br><a href="../Views/signin.php">Se connecter</a>
        </div>
    </body>
</html>

