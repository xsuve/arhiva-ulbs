<?php

require 'public/libs/phpmailer/Exception.php';
require 'public/libs/phpmailer/PHPMailer.php';
require 'public/libs/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SupportModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Contact Support
  public function contactSupport($username, $subject, $message) {
    if(!empty($subject) && !empty($message)) {
      $username = strip_tags($username);
      $subject = strip_tags($subject);
      $message = strip_tags($message);

      $mail = new PHPMailer;

      $mail->From = 'arhiva-ulbs@xsuve.com';
      $mail->FromName = 'ARHIVA ULBS';
      $mail->addAddress('georgebaba99@yahoo.com');
      $mail->addReplyTo('arhiva-ulbs@xsuve.com', 'ARHIVA ULBS');
      $mail->isHTML(true);

      $message = '
        <!DOCTYPE html>
        <html>
          <head>
            <title>ARHIVA ULBS | Contact Support</title>
          </head>
          <body>
            ' . (!empty($username) ? "Utilizator: " . $username : "") . '
            <br><br>
            Subiect: ' . $subject . '
            <br><br>
            Mesaj: ' . $message . '
          </body>
        </html>
      ';

      $mail->Subject = 'ARHIVA ULBS | Contact Support';
      $mail->Body = $message;
      $mail->AltBody = '';

      if($mail->send()) {
        return 'Mesajul tău a fost trimis cu succes.';
      } else {
        return 'Mesajul tău nu a fost trimis.';
      }

    } else {
      return 'Te rugăm să completezi toate câmpurile.';
    }
  }

}

?>
