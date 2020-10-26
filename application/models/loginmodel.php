<?php

require 'public/libs/phpmailer/Exception.php';
require 'public/libs/phpmailer/PHPMailer.php';
require 'public/libs/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class LoginModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Login Account
  public function loginAccount($username, $password) {
    if(!empty($username) && !empty($password)) {
      $username = strip_tags($username);
      $password = strip_tags($password);

      $sql_check = 'SELECT * FROM arhiva_ulbs_accounts WHERE username = :username';
      $query_check = $this->db->prepare($sql_check);
      $query_check->execute(array(':username' => $username));
      $account = $query_check->fetch();
      if($account) {
        if(password_verify($password, $account->password)) {
          if($account->account_activated == true) {
            $_SESSION['account'] = array($account->username, $account->email);
          } else {
            return 'Acest cont nu a fost activat incă.';
          }
        } else {
          return 'Vă rugăm să încercați din nou cu informațile valide.';
        }
      } else {
        return 'Acest cont nu există.';
      }
    } else {
      return 'Te rugăm să completezi toate câmpurile.';
    }
  }

  // Reset Password
  public function resetPassword($username, $reset_token, $old_password, $new_password, $confirm_new_password) {
    if(!empty($username) && !empty($reset_token) && !empty($old_password) && !empty($new_password) && !empty($confirm_new_password)) {
      $username = strip_tags($username);
      $reset_token = strip_tags($reset_token);
      $old_password = strip_tags($old_password);
      $new_password = strip_tags($new_password);
      $confirm_new_password = strip_tags($confirm_new_password);

      $sql_username_check = 'SELECT * FROM arhiva_ulbs_accounts WHERE username = :username';
      $query_username_check = $this->db->prepare($sql_username_check);
      $query_username_check->execute(array(':username' => $username));
      $account_username = $query_username_check->fetch();
      if($account_username) {
        if(md5($account_username->activation_token) == $reset_token) {
          if($new_password == $confirm_new_password) {
            if(password_verify($old_password, $account_username->password)) {
              $new_password = password_hash($new_password, PASSWORD_DEFAULT);

              $sql_update_password = 'UPDATE arhiva_ulbs_accounts SET password = :password WHERE id = :account_id';
              $query_update_password = $this->db->prepare($sql_update_password);
              $query_update_password->execute(array(':password' => $new_password, ':account_id' => $account_username->id));

              return 'Parola a fost schimbată.';
            } else {
              return 'Parola veche este invalidă.';
            }
          } else {
            return 'Parola nouă nu corespunde cu confirmarea parolei noi.';
          }
        } else {
          return 'Cod pentru resetarea parolei este invalid.';
        }
      } else {
        return 'Aceast cont nu există.';
      }
    } else {
      return 'Te rugăm să completezi toate câmpurile.';
    }
  }

  // Forgot Password
  public function forgotPassword($email) {
    if(!empty($email)) {
      $email = strip_tags($email);

      $sql_email_check = 'SELECT * FROM arhiva_ulbs_accounts';
      $query_email_check = $this->db->prepare($sql_email_check);
      $query_email_check->execute();
      $accounts_with_email = $query_email_check->fetchAll();
      foreach($accounts_with_email as $a) {
        if(password_verify($email, $a->email)) {
          $md5 = md5($a->activation_token);

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
                <title>ARHIVA ULBS | Resetare Parola</title>
              </head>
              <body>
                Pentru a reseta parola contului, te rugam sa urmezi link-ul de mai jos:
                <a href="' . URL . 'login/reset/' . $a->username . '/' . $md5 . '">' . URL . 'login/reset/' . $a->username . '/' . $md5 . '</a>
              </body>
            </html>
          ';

          $mail->Subject = 'ARHIVA ULBS | Resetare Parola';
          $mail->Body = $message;
          $mail->AltBody = 'Link resetare parola: ' . URL . 'login/reset/' . $a->username . '/' . $md5;

          if($mail->send()) {
            return 'Folosește adresa ta de e-mail pentru a reseta parola.';
          } else {
            return 'A aparut o eroare. Vă rugăm să ne contactati.';
          }

          break;
        } else {
          return 'Această adresă de e-mail nu există.';
        }
      }
    } else {
      return 'Te rugăm să completezi toate câmpurile.';
    }
  }

  // Activate Account
  public function activateAccount($username, $activate_token) {
    if(!empty($username) && !empty($activate_token)) {
      $username = strip_tags($username);
      $activate_token = strip_tags($activate_token);

      $sql_username_check = 'SELECT * FROM arhiva_ulbs_accounts WHERE username = :username';
      $query_username_check = $this->db->prepare($sql_username_check);
      $query_username_check->execute(array(':username' => $username));
      $account = $query_username_check->fetch();
      if($account) {
        if($account->activation_token === $activate_token) {
          if($account->account_activated == 0) {
            $sql = 'UPDATE arhiva_ulbs_accounts SET account_activated = :account_activated WHERE id = :account_id';
            $query = $this->db->prepare($sql);
            $query->execute(array(':account_activated' => 1, ':account_id' => $account->id));

            return 'Contul tău a fost activat. Acum te poți loga în platformă.';
          } else {
            return 'Acest cont a fost deja activat.';
          }
        } else {
          return 'Codul de activare pentru aceast cont este invalid.';
        }
      } else {
        return 'Acest cont nu există.';
      }
    } else {
      return 'Nu s-a oferit un nume de utilizator sau un cod de activare.';
    }
  }

  // Complete Profile
  public function completeProfile($specializare_id, $anul, $account_id) {
    if(!empty($specializare_id) && !empty($anul)) {
      $specializare_id = strip_tags($specializare_id);
      $account_id = strip_tags($account_id);

      $sql_check = 'SELECT * FROM arhiva_ulbs_specializari WHERE id = :specializare_id';
      $query_check = $this->db->prepare($sql_check);
      $query_check->execute(array(':specializare_id' => $specializare_id));
      $specializare = $query_check->fetch();
      if($specializare) {
        $sql = 'UPDATE arhiva_ulbs_accounts SET specializare_id = :specializare_id, anul = :anul WHERE id = :account_id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':specializare_id' => $specializare->id, ':anul' => $anul, ':account_id' => $account_id));

        return 'Contul tău a fost actualizat.';
      } else {
        return 'Această specializare nu există.';
      }
    } else {
      return 'Te rugăm să completezi toate câmpurile.';
    }
  }

}

?>
