
<?php
session_start();
$subject = htmlentities($_POST['objet']);
$txt = htmlentities($_POST['email']);

$to = "administrateur@hotmail.com";

$headers = "From:".$_SESSION["email"]."\n";

mail($to,$subject,$txt, $headers);

header("Location: ../Views/contact.php");
$_SESSION['envoie']="Message envoyé";
?> 