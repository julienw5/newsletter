<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
    <title>La newsletter de Aeria-app</title>
</head>
<body>
 <?php
    if(isset($_GET['email'])) // On vérifie que la variable $_GET['email'] existe.
    {
 
        if( !empty($_POST['email']) AND $_GET['email']==1 AND isset($_POST['new'])) /* variable $_POST['email'] contient quelque chose et variable $_GET['email'] égale à 1 et variable $_POST['new'] existe. */
        {
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) // vérifie e-mail valide.
        {
 
            if($_POST['new']==0) // $_POST['new'] est égale à 0 veut dire s'inscrire.
            {
 
            // paramètres de l'e-mail inscription validation.
            $email = $_POST['email'];
            $message = 'Pour valider votre inscription à la newsletter de Aeria-app, <a href="http://www.aeria-app.be/newsletter/inscription.php?tru=1&amp;email='.$email.'">cliquez ici</a>.';
 
            $destinataire = $email;
            $objet = "Inscription à la newsletter de Aeria-app" ;
 
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: julienw5@hotmail.com' . "\r\n";
                if ( mail($destinataire, $objet, $message, $headers) ) // envoie l'e-mail.
                {
 
                echo "Pour valider votre inscription, veuillez cliquer sur le lien dans l'e-mail que nous venons de vous envoyer.";
                }
                else
                {
                echo "Il y a eu une erreur lors de l'envoi du mail pour votre inscription.";
                }
            }
            elseif($_POST['new']==1) // if variable $_POST['new'] est égale à 1, = désinscrire.
            {
 
            //paramètres de l'e-mail désinscription validation.
            $email = $_POST['email'];
            $message = 'Pour valider votre désinscription de la newsletter de aeria-app.be, <a href="http://www.aeria-app.be/newsletter/desinscription.php?tru=1&amp;email='.$email.'">cliquez ici</a>.';
 
            $destinataire = $email;
            $objet = "Désinscription de la newsletter de aeria-app" ;
 
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: julienw5@hotmail.com' . "\r\n";
                if ( mail($destinataire, $objet, $message, $headers) ) 
                {
 
                echo "Pour valider votre désinscription, veuillez cliquer sur le lien dans l'e-mail que nous venons de vous envoyer.";
                }
                else
                {
                echo "Il y a eu une erreur lors de l'envoi du mail pour votre désinscription.";
                }
            }
            else
            {
            echo "Il y a eu une erreur !";
            }
        }
        else
        {
        echo "Vous n\'avez pas entré une adresse e-mail valide ! Veuillez recommencer !";
        }
        }
        else
        {
        echo "Il y a eu une erreur.";
        }
    }
    else // Si les champs n'ont pas été remplis.
    {
?>
<!-- Inscription à la newsletter premiere page -->
La newsletter :
<form method="post" action="index.php?email=1">
Adresse e-mail : <input type="text" name="email" size="25" /><br />
<input type="radio" name="new" value="0" />S''inscrire
<input type="radio" name="new" value="1" />Se désinscrire<br />
<input type="submit" value="Envoyer" name="submit" /> <input type="reset" name="reset" value="Effacer" />
</form>
<?php
    }
?>
</body>
</html>