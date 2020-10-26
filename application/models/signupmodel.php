<?php

require 'public/libs/phpmailer/Exception.php';
require 'public/libs/phpmailer/PHPMailer.php';
require 'public/libs/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SignupModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Create Account
  public function signupAccount($invitation_code, $username, $email, $password) {
    if(!empty($invitation_code) && !empty($username) && !empty($email) && !empty($password)) {
      $invitation_code = strip_tags($invitation_code);
      $username = strip_tags($username);
      $email = strip_tags($email);
      $email_hash = password_hash($email, PASSWORD_DEFAULT);
      $password = password_hash(strip_tags($password), PASSWORD_DEFAULT);

      $today_date = date_create();
      $signup_date = date_format($today_date, 'Y-m-d');
      $activation_token = time() . '-' . mt_rand();
      $account_activated = 0;

      $sql_username_check = 'SELECT COUNT(id) AS accounts_with_username FROM arhiva_ulbs_accounts WHERE username = :username';
      $query_username_check = $this->db->prepare($sql_username_check);
      $query_username_check->execute(array(':username' => $username));
      $accounts_with_username = $query_username_check->fetch()->accounts_with_username;
      if($accounts_with_username == 0) {
        $sql_email_check = 'SELECT email FROM arhiva_ulbs_accounts';
        $query_email_check = $this->db->prepare($sql_email_check);
        $query_email_check->execute();
        $accounts_with_email = $query_email_check->fetchAll();

        $sql_invitation = 'SELECT * FROM arhiva_ulbs_invitations WHERE invitation_code = :invitation_code';
        $query_invitation = $this->db->prepare($sql_invitation);
        $query_invitation->execute(array(':invitation_code' => $invitation_code));
        $invitation = $query_invitation->fetch();

        if($invitation) {
          if($invitation->invitation_used == false) {
            foreach($accounts_with_email as $a) {
              if(!password_verify($email, $a->email)) {
                // Create account
                $sql_create_account = 'INSERT INTO arhiva_ulbs_accounts (username, email, password, signup_date, activation_token, account_activated, invitation_id, specializare_id, anul) VALUES (:username, :email, :password, :signup_date, :activation_token, :account_activated, :invitation_id, :specializare_id, :anul)';
                $query_create_account = $this->db->prepare($sql_create_account);
                $query_create_account->execute(array(':username' => $username, ':email' => $email_hash, ':password' => $password, ':signup_date' => $signup_date, ':activation_token' => $activation_token, ':account_activated' => $account_activated, ':invitation_id' => $invitation->id, ':specializare_id' => 0, ':anul' => 0));
                $account_id = $this->db->lastInsertId();

                if($account_id) {
                  // Create invitation
                  $sql_create_invitation = 'INSERT INTO arhiva_ulbs_invitations (account_id, invitation_code, invitation_used) VALUES (:account_id, :invitation_code, :invitation_used)';
                  $query_create_invitation = $this->db->prepare($sql_create_invitation);
                  $query_create_invitation->execute(array(':account_id' => $account_id, ':invitation_code' => $activation_token, ':invitation_used' => 0));

                  // Use invitation
                  $sql_invitation_used = 'UPDATE arhiva_ulbs_invitations SET invitation_used = :invitation_used WHERE id = :invitation_id';
                  $query_invitation_used = $this->db->prepare($sql_invitation_used);
                  $query_invitation_used->execute(array(':invitation_used' => 1, ':invitation_id' => $invitation->id));

                  $mail = new PHPMailer;

                  $mail->From = 'arhiva-ulbs@xsuve.com';
                  $mail->FromName = 'ARHIVA ULBS';
                  $mail->addAddress($email);
                  $mail->addReplyTo('arhiva-ulbs@xsuve.com', 'ARHIVA ULBS');
                  $mail->isHTML(true);

                  $message = '
                    <!DOCTYPE html>
                    <html>
                      <head>
                        <title>ARHIVA ULBS | Verificare Cont</title>
                      </head>
                      <body>
                        Pentru a verifica contul, te rugam sa urmezi link-ul de mai jos:
                        <a href="' . URL . 'login/activateaccount/' . $username . '/' . $activation_token . '">' . URL . 'login/activateaccount/' . $username . '/' . $activation_token . '</a>
                      </body>
                    </html>
                  ';

                  $mail->Subject = 'ARHIVA ULBS | Verificare Cont';
                  $mail->Body = $message;
                  $mail->AltBody = 'Link verificare cont: ' . URL . 'login/activateaccount/' . $username . '/' . $activation_token;

                  if($mail->send()) {
                    return 'Contul tău a fost creat cu succes. Folosește adresa ta de e-mail pentru a îl activa.';
                  } else {
                    return 'A aparut o eroare. Vă rugăm să ne contactati.';
                  }
                } else {
                  return 'Contul tau nu a putut fi creat.';
                }

                break;
              } else {
                return 'Această adresă de e-mail deja există.';
              }
            }
          } else {
            return 'Acest cod de invitatie a fost deja folosit.';
          }
        } else {
          return 'Acest cod de invitatie nu este valid.';
        }
      } else {
        return 'Acest nume de utilizator deja există.';
      }
    } else {
      return 'Te rugăm să completezi toate câmpurile.';
    }
  }

}

?>
