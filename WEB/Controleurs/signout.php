<?php
session_start();
session_destroy();
echo "Session supprimée </br> <a href=\"../droit.php\">Reconnexion</a>";
?>
