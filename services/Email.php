<?php
namespace JeanForteroche\Services;

class Email
{
    static public function contactEmail($name, $email, $subject, $text)
    {        
        $to = 'bonjour@valantyn.fr';

        $headers = 'MIME-Version: 1.0' . "\n";
        $headers = 'From: Jean Forteroche <jeanmchz@world-376.fr.planethoster.net>'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";

        $message =' <table style="width:100%">
                        <tr><td>Expediteur : '.$name.'</td></tr>
                        <tr><td>Email : '.$email.'</td></tr>
                        <tr><td>Message : '.$text.'</td></tr>
            
                    </table>';
        
        $email = mail($to, $subject, $message, $headers);

        if ($email) {
            echo 'Votre message a bien été envoyé.';
        } else {
            echo 'Échec de l\'envoi.';
        }
    }
}