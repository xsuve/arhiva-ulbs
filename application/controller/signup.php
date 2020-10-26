<?php

class Signup extends Controller {

  public function index() {
    $account = $this->getSessionAccount();

    if($account == null) {
      require 'application/views/_templates/header.php';
      require 'application/views/_templates/alert.php';
      require 'application/views/signup/index.php';
    } else {
      header('location: ' . URL);
    }
  }

  // Sign Up Account
  public function signupAccount() {
    $account = $this->getSessionAccount();

    if($account == null) {
      if(isset($_POST['submit_signup'])) {
        $signup_model = $this->loadModel('SignUpModel');
        $signup_account = $signup_model->signupAccount(trim($_POST['invitation_code']), $_POST['username'], $_POST['email'], $_POST['password']);

        if(isset($signup_account) && $signup_account != null) {
          $_SESSION['alert'] = $signup_account;
          header('location: ' . URL . 'signup');
        } else {
          header('location: ' . URL . 'signup');
        }
      }
    } else {
      header('location: ' . URL);
    }
  }
}

?>
