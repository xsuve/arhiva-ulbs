<?php

class Login extends Controller {

  public function index() {
    $account = $this->getSessionAccount();

    if($account == null) {
      require 'application/views/_templates/header.php';
      require 'application/views/_templates/alert.php';
      require 'application/views/login/index.php';
    } else {
      header('location: ' . URL);
    }
  }

  // Reset Password
  public function reset($username = null, $reset_token = null) {
    if($username != null && $reset_token != null) {
      $username = strip_tags($username);
      $reset_token = strip_tags($reset_token);

      require 'application/views/_templates/header.php';
      require 'application/views/_templates/alert.php';
      require 'application/views/login/reset.php';
    } else {
      header('location: ' . URL);
    }
  }

  // Reset Password
  public function resetPassword() {
    if(isset($_POST['submit_reset'])) {
      $login_model = $this->loadModel('LoginModel');
      $reset_password = $login_model->resetPassword($_POST['username'], $_POST['reset_token'], $_POST['old_password'], $_POST['new_password'], $_POST['confirm_new_password']);

      if(isset($reset_password) && $reset_password != null) {
        $_SESSION['alert'] = $reset_password;
        header('location: ' . URL . 'reset');
      } else {
        header('location: ' . URL . 'forgot');
      }
    } else {
      header('location: ' . URL);
    }
  }

  // Forgot Password
  public function forgot() {
    $account = $this->getSessionAccount();

    if($account == null) {
      require 'application/views/_templates/header.php';
      require 'application/views/_templates/alert.php';
      require 'application/views/login/forgot.php';
    } else {
      header('location: ' . URL);
    }
  }

  // Forgot Password
  public function forgotPassword() {
    $account = $this->getSessionAccount();

    if($account == null) {
      if(isset($_POST['submit_forgot'])) {
        $login_model = $this->loadModel('LoginModel');
        $forgot_password = $login_model->forgotPassword($_POST['email']);

        if(isset($forgot_password) && $forgot_password != null) {
          $_SESSION['alert'] = $forgot_password;
          header('location: ' . URL . 'forgot');
        } else {
          header('location: ' . URL . 'forgot');
        }
      } else {
        header('location: ' . URL);
      }
    } else {
      header('location: ' . URL);
    }
  }

  // Log In Account
  public function loginAccount() {
    $account = $this->getSessionAccount();

    if($account == null) {
      if(isset($_POST['submit_login'])) {
        $login_model = $this->loadModel('LoginModel');
        $login_account = $login_model->loginAccount($_POST['username'], $_POST['password']);

        if(isset($login_account) && $login_account != null) {
          $_SESSION['alert'] = $login_account;
          header('location: ' . URL . 'login');
        } else {
          header('location: ' . URL . 'login');
        }
      } else {
        header('location: ' . URL);
      }
    }
  }

  // Activate Account
  public function activateAccount($username, $activate_token) {
    if(isset($username) && isset($activate_token)) {
      $login_model = $this->loadModel('LogInModel');
      $activate_account = $login_model->activateAccount($username, $activate_token);

      if(isset($activate_account) && $activate_account != null) {
        $_SESSION['alert'] = $activate_account;
        header('location: ' . URL . 'login');
      } else {
        header('location: ' . URL . 'login');
      }
    }
  }

  // Complete Profile
  public function completeProfile() {
    $account = $this->getSessionAccount();

    if($account->specializare_id == 0) {
      if(isset($_POST['submit_complete_profile'])) {
        $login_model = $this->loadModel('LoginModel');
        $complete_profile = $login_model->completeProfile($_POST['specializare'], $_POST['anul'], $account->id);

        if(isset($complete_profile) && $complete_profile != null) {
          $_SESSION['alert'] = $complete_profile;
          header('location: ' . URL);
        } else {
          header('location: ' . URL);
        }
      } else {
        header('location: ' . URL);
      }
    } else {
      header('location: ' . URL);
    }
  }

}

?>
