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
// On se connecte.
mysql_connect("localhost", "root", "");
mysql_select_db("db");
if(isset($_POST['message'])) //On a tapé le message.
{ 
// On récupère les 5 dernières news
$news = mysql_query('SELECT contenu,timestamp FROM news ORDER BY id DESC LIMIT 0, 5');
 
$fichier_message = '<html>
<head>
   <title>Newsletter de aeria-app</title>
</head>
<body bgcolor="black">
<font face="verdana"><font color="white"><font size="5"><p align="center"><font color="red"><u>Balzac61</u></font></p></font>
<font size="3">' . $_POST['message'] . '<br /><br />
<p align="left">Voici les dernières news de aeria-app :<br /><ul>'; //On définit le message.
 
    while($donnee = mysql_fetch_assoc($news)) 
    {
    $fichier_message .= '<li>'.$donnee["contenu"].'(le'.date("D, d M Y H:i:s",$donnee["timestamp"]).')</li>'; //On ajoute les news au message.
    }
 
$fichier_message .= '</ul></body>
</html>'; //On termine le message.
 
 
//On récupère de la table newsletter les personnes inscrites.
$liste_vrac = mysql_query("SELECT email FROM newsletter");
 
//On définit la liste des inscrits.
$liste = 'julienw5@hotmail.com';
    while ($donnees = mysql_fetch_assoc($liste_vrac))
    {
    $liste .= ','; //On sépare les adresses par une virgule.
    $liste .= $donnees['email'];
    }
$message = $fichier_message;
$destinataire = 'julienw5@hotmail.com'; //On adresse une copie a l'administrateur.
 
$date = date("d/m/Y");
 
$objet = "Newsletter de aeria-app du $date"; //On définit l'objet qui contient la date.
 
//On définit le reste des paramètres.
$headers  = 'MIME-Version: 1.0' . '\r\n';
$headers .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
$headers .= 'From: julienw5@hotmail.com' . '\r\n'; //On définit l'expéditeur.
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
 
$liste_inscrits_vrac = mysql_query("SELECT email FROM newsletter"); //On récupère la table newsletter en vrac.
    while ($donnees = mysql_fetch_assoc($liste_inscrits_vrac))
    {
?>
 
<tr>
<td><?php echo ($donnees['email']); ?></td>
</tr>
 
<?php
    }
?>
</table>
</body>
</html>