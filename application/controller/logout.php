<?php

class Logout extends Controller {

  public function index() {
  	$logout_model = $this->loadModel('LogoutModel');
    $logout_model->logoutAccount();

  	header('location: ' . URL);
  }

}

?>
