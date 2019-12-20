<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../CSS/signin.css"/>
</head>
    <body>
        <div class="container">
            <h2>Se connecter</h2>
            <form method = "post" action="../Controleurs/authenticate.php">
                <input type="text" title="username" placeholder="Login" name="login"/></br>
                <input type="password" title="password" placeholder="Mot de passe" name="mdp"/></br>
                <button type="submit" class="btn">Login</button></br>
                <?php echo $_SESSION['message'];?></br>
                <?php echo "</br><a href=\"signup.php\">Créer un compte</a>";?>
            </form>
        </div>
    </body>
</html>

 <?php
}
else
{
    header("Location: signup.php");
}
?>
