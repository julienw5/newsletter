<?php require_once 'config.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
    <title>Envoi de la newsletter</title>
    <style type="text/css">
            h2, th, td
            {
                text-align:center;
            }
            table
            {
                border-collapse:collapse;
                border:2px solid white;
                margin:auto;
            }
            th, td
            {
                border:1px solid black;
            }
        </style>
</head>
<body>
<p align=center><font size="6"><font color="red">Envoi de la newsletter</font></font></p>
 
<?php

if(isset($_POST['message'])) //On a tapé le message.
{ 
// On récupère les 5 dernières news
// $news = mysql_query('SELECT contenu,timestamp FROM news ORDER BY id DESC LIMIT 0, 5');
 $news = $bdd->prepare('SELECT contenu,timestamp FROM news ORDER BY id DESC LIMIT 0, 5');
        $news->execute();
        $data = $pdo->fetchAll();
 
$fichier_message = '<html>
<head>
   <title>Newsletter de aeria-app</title>
</head>
<body bgcolor="black">

<font face="verdana">
    <font color="white">
        <font size="5">
            <p align="center">
                <u>
                    Coucou
                </u>
            </p>
        </font>
    </font>
    <font size="3">' . $_POST['message'] . '<br /><br />
        <p align="left">Voici les dernières news de aeria-app :<br />
        </p>
    </font>
</font>
                    <ul>'; //définition du message.

    foreach ($data as $key => $value) 
    $fichier_message .= '<li>'.$value["contenu"].'(le'.date("D, d M Y H:i:s",$value["timestamp"]).')</li>'; //ajout des news au message.
    }
 
$fichier_message .= '</ul></body>
</html>'; //Fin du message.
 
 
//Récupération de la table newsletter, les personnes inscrites.
// $liste_vrac = mysql_query("SELECT email FROM newsletter");

$liste_vrac = $bdd->prepare("SELECT email FROM newsletter");
$liste_vrac->execute();
$data = $pdo->fetchAll();
foreach ($data as $key => $value) {



//Définition de la liste des inscrits.
$liste = 'julienw5@hotmail.com';
    foreach ($data as $key => $value) 
    {
    $liste .= ','; //Séparation des adresses par une virgule.
    $liste .= $value['email'];
    }
$message = $fichier_message;
$destinataire = 'julienw5@hotmail.com'; //copie a l'administrateur.
 
$date = date("d/m/Y");
 
$objet = "Newsletter de aeria-app du $date"; //définition de l'objet qui contient la date.
 
//On définit le reste des paramètres.
$headers  = 'MIME-Version: 1.0' . '\r\n';
$headers .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
$headers .= 'From: julienw5@hotmail.com' . '\r\n'; //Définition de l'expéditeur.
$headers .= 'Bcc:' . $liste . '' . '\r\n'; //On définit les destinataires en copie cachée pour qu'ils ne puissent pas voir les adresses des autres inscrits.
 
    //On envoie l'e-mail.
    if ( mail($destinataire, $objet, $fichier_message, $headers) ) 
    {
?>
Envoi de la newsletter réussi.
<?php
    }
    else
    {
?>
Échec lors de l'envoi de la newsletter.
<?php
    }
} //Fin de la condition de validité du formulaire.
?>
<br />
<h3>Message ajouté à la newsletter</h3>
<form method="post" action="newsletter.php">
<textarea cols="30" rows="10" name="message"></textarea>
<input type="submit" value="Envoyer la newsletter" />
</form>
<br /><br /><u>Liste des inscrits :</u><br />
<table>
<tr>
<th>e-mail</th>
</tr>
<?php
 
// $liste_inscrits_vrac = mysql_query("SELECT email FROM newsletter"); //On récupère la table newsletter en vrac.
$liste_inscrits_vrac = $bdd->prepare("SELECT email FROM newsletter");
$liste_inscrits_vrac->execute();
$data = $pdo->fetchAll();
foreach ($data as $key => $value) {
?>
 
<tr>
<td><?php echo ($value['email']); ?></td>
</tr>
 
<?php
    }
?>
</table>
</body>
</html>