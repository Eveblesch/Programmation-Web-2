<?php
session_start();
require "Models/user.php";
//https://osr-etudiant.unistra.fr/~eblesch/PW_final/WEB/droit.php
if(empty($_SESSION['test']))
{

    $g=$bdd->prepare('SELECT intitule FROM TOPIC');
    $g->execute();
    $h=$g->fetch();
    $_SESSION['test']=$h['intitule'];

    $query=$bdd->prepare('SELECT id FROM TOPIC WHERE intitule=:intitule2');
    $query->bindParam(":intitule2",$h['intitule']);
    $query->execute();
    $tab=$query->fetch();

    $count2=$bdd->prepare("SELECT COUNT(*) AS total FROM TOPIC_NOTE WHERE id_topic='".$tab["id"]."'");
    $count2->execute(array($tab["id"]));
    $req3=$count2->fetch(PDO::FETCH_ASSOC);
    $_SESSION['nbre_votes']=$req3["total"];
}

$droit=$_SESSION['droit'];
if($droit>=0)
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
            <title>Forum</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="CSS/droit.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    </head>
    <body>
    <header> FORUM </header>

<!-----------------------RECUPERATION DU DROIT---------------------------------->
    <?php
        if($droit==1)
            $recup_droit="Utilisateur";
        else if($droit==2)
            $recup_droit="Moderateur";
        else if($droit==3)
            $recup_droit="Administrateur";
    $_SESSION["recup_droit"]=$recup_droit;
    ?>

<!-----------------------BARRE DE NAVIGATION HOZIZONTALE------------------------>
    <div id="corps">
        <?php
        if($droit==0) //VISITEUR
        {      ?>
        <div class="horiznav">
                <ul>
                	<li><a href="Views/signup.php">Créer un compte</a></li>
                    <li><a href="Views/signin.php">Se connecter</a></li>
                </ul>
        </div>

<?php   }

        if($droit>=1) //UTILISATEUR
        { ?>
        <div class="horiznav">
            <ul>
                <li><a href="Controleurs/signout.php">Se déconnecter</a></li>
                <li><a><?php echo $_SESSION["pseudo"]." (".$recup_droit.")"; ?></a></li>
                <li><a href="Views/profil.php">Profil</a></li>
                <li><a href="Views/affichage_categorie.php">Catégories</a></li>
                <li><a href="Views/affichage_topic.php">Topics</a></li>
                <li><a href="Views/topic.php">Ajouter un topic</a></li>

<?php
            if($droit==3)//ADMINISTRATEUR
            {
?>
                        <li><a href="Views/categorie.php">Ajouter une catégorie</a></li>

                    </ul>
                </div>
<?php
            }
            else
            {
?>
            </ul>
            </div>
<?php
            }

        }
?>
    </div>
<!---------------MENU VERTICAL (Affichage Topics et catégories)---------------------------->

<div id="sidenav">
<?php

        $query=$bdd->prepare('SELECT intitule,id FROM CATEGORIE');
        $query->execute();
        while($cat=$query->fetch())
        {
                echo "<ul><b>".$cat['intitule'];

                $query2=$bdd->prepare('SELECT id,intitule FROM TOPIC WHERE id_categorie="'.$cat["id"].'"');
                $query2->execute();
                while($cat2=$query2->fetch())
                {
                     echo "<li><a href='Controleurs/actualisation.php?param1=".$cat2['intitule']."&param2=".$cat2['id']."'>".$cat2['intitule']."</a></li>";
                }
                echo "</b></ul>";
        } ?>
</div>


<!----------------------ZONE DE COMMENTAIRES--------------------------------->

<div class="commentaires">

	<?php
	echo "<h1>".$_SESSION['test'];
        $util=new User($_SESSION["login"],null,null,null,null,null);
        $util->getInfo();

		$a=$bdd->prepare('SELECT id,note_moy FROM TOPIC WHERE intitule=:intitule2');
		$a->bindParam(':intitule2',$_SESSION['test']);
		$a->execute();
		$b=$a->fetch();

        //SUPPRESSION D'UN TOPIC PAR L'ADMINISTRATEUR
        if($droit>=2)
            echo "<a href='Controleurs/supp_topic.php?topic=".$b['id']."' class='bouton' type='submit'><i class='far fa-trash-alt'></i></a></h1>";
        else
            echo "</h1>";

		$query=$bdd->prepare('SELECT id,intitule,id_utilisateur, date_ecriture, note_totale FROM COMMENTAIRE WHERE id_topic=:id_topic2');
		$query->bindParam(':id_topic2',$b['id']);
		$query->execute();

        //AFFICHAGE COMMENTAIRES
        while($topic=$query->fetch())
		{
    		$query2=$bdd->prepare('SELECT login FROM UTILISATEUR WHERE id=:id2');
            $query2->bindParam(':id2',$topic['id_utilisateur']);
            $query2->execute();
            $topic2=$query2->fetch();


             //SUPPRESSION DE SON PROPRE COMMENTAIRE (OU TOUS SI ADMIN ou MODO)
            if($droit>0)
            {
                if(!isset($topic2['login']))
                {
                   echo "<li class='cmt'>"."<b> Anonyme -  ".$topic['date_ecriture']."</b>";
                }
                else
                {
                    echo "<li class='cmt'>"."<b>".$topic2['login']."  -  ".$topic['date_ecriture']."</b>";

                }
                if($topic['id_utilisateur']==$util->getid()||$droit>=2)
                {
                    echo "<a href='Controleurs/supp_commentaire.php?nom=".$topic['id']."' class='bouton' type='submit'>&nbsp;&nbsp;<i class='far fa-trash-alt'></i></a>";

                }
                    echo "<br>".$topic['intitule']."</li>";

                    //NOTATION DU COMMENTAIRE
                    echo "<a href='Controleurs/commentaire_note.php?id_com=".$topic["id"]."&id_uti=".$util->getid()."&signe=1'><i class='far fa-thumbs-up'></i></a>".$commentaire["note_totale"]."&nbsp;&nbsp;&nbsp;". $topic['note_totale'] ."&nbsp;&nbsp;&nbsp;<a href='Controleurs/commentaire_note.php?id_com=".$topic["id"]."&id_uti=".$util->getid()."&signe=2'><i class='far fa-thumbs-down'></i></a>";


                    //VALIDATION OU NON DU COMMENTAIRE
                        if($topic['note_totale']>0)
                            echo "<div id='ok'><i class='far fa-check-circle'></i></div></br>";
                        else
                            echo "<div id='pasOk'><i class='fa fa-close'></i></div></br>";

            }

            else
            {
                echo "<li class='cmt'>"."<b>".$topic2['login']."  -  ".$topic['date_ecriture']."</b>";
                echo "<br>".$topic['intitule']."</li>";
            }

		}
	?>

        <!------------------------ZONE POUR ECRIRE UN COMMENTAIRE---------------->

<?php if($droit>0)
{ ?>
    <form method = "post" action="Controleurs/add_commentaire.php">
    		<textarea type="text" placeholder="Entrez un nouveau commentaire..." name="commentaire" rows="4" cols="48"></textarea>
    		</br>
            <button>Envoyer</button>
    </form>

        <!---------------------- ZONE DE NOTATION------------------------------->
    <div class="etoiles">
        <?php if($droit>0)
        {?>
        <h2>Notez ce Topic !</h2>
        <h3>
        <?php
        if($b["note_moy"]==0)
            echo "Note Moyenne : Pas de note";
        else
            echo "Note Moyenne : ".$b["note_moy"]." (".$_SESSION['nbre_votes']." vote(s) )";?> </h3>

        
        <a href="Controleurs/topic_note.php?param=<?php echo $b['id']; ?>&note=1&uti=<?php echo $util->getid(); ?>" title="Donner 1 étoile">☆</a>
        <a href="Controleurs/topic_note.php?param=<?php echo $b['id']; ?>&note=2&uti=<?php echo $util->getid(); ?>" title="Donner 2 étoiles">☆</a>
        <a href="Controleurs/topic_note.php?param=<?php echo $b['id']; ?>&note=3&uti=<?php echo $util->getid(); ?>" title="Donner 3 étoiles">☆</a>
        <a href="Controleurs/topic_note.php?param=<?php echo $b['id']; ?>&note=4&uti=<?php echo $util->getid(); ?>" title="Donner 4 étoiles">☆</a>
        <a href="Controleurs/topic_note.php?param=<?php echo $b['id']; ?>&note=5&uti=<?php echo $util->getid(); ?>" title="Donner 5 étoiles">☆</a>

        <?php }?>
        </br></br>
    </div>
<?php } ?>
</div>


<!------------------------FOOTER-------------------------------------->

</body>

<footer>
    <div>
    <ul>
        <li><a href="Views/contact.php">Contact</a></li>
        <li><a href="Views/apropos.php">A propos</a></li>
    </ul>
    </div>
</footer>
</html>

<?php
    }

?>
