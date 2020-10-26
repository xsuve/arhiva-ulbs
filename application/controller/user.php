<?php

class User extends Controller {

  public function index($username) {
    if(isset($username) && $username != null) {
      $account = $this->getSessionAccount();

      if($account != null) {
        $user_model = $this->loadModel('UserModel');
        $user = $user_model->getUserData($username);

        if($user) {
          $subiect_model = $this->loadModel('SubiectModel');
          $user_subiecte = $user_model->getUserSubiecte($user->id);

          require 'application/views/_templates/header.php';
          require 'application/views/_templates/alert.php';
          require 'application/views/_templates/navbar.php';
          require 'application/views/user/index.php';
          require 'application/views/_templates/footer.php';
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
