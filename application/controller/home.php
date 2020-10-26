<?php

class Home extends Controller {

  public function index() {
    $account = $this->getSessionAccount();

  	$home_model = $this->loadModel('HomeModel');
    $specializari = $home_model->getSpecializari();

    require 'application/views/_templates/header.php';
    require 'application/views/_templates/alert.php';

    if($account != null) {
      if($account->specializare_id == 0) {
        require 'application/views/home/complete_profile.php';
      } else {
        $subiect_model = $this->loadModel('SubiectModel');
        $subiecte = $subiect_model->getSubiecte();

        $invitation = $home_model->getAccountInvitation($account->id);

        require 'application/views/_templates/navbar.php';
        require 'application/views/home/index.php';
      }
    } else {
      header('location: ' . URL . 'login');
    }

    require 'application/views/_templates/footer.php';
  }

}

?>
