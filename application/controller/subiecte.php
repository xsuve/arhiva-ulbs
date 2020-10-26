<?php

class Subiecte extends Controller {

  public function index() {
    $account = $this->getSessionAccount();

    if($account != null) {
      $home_model = $this->loadModel('HomeModel');
      $subiect_model = $this->loadModel('SubiectModel');

      $specializari = $home_model->getSpecializari();
      $subiecte = $subiect_model->getSubiecte();

      require 'application/views/_templates/header.php';
      require 'application/views/_templates/alert.php';
      require 'application/views/_templates/navbar.php';
      require 'application/views/subiecte/index.php';
      require 'application/views/_templates/footer.php';
    } else {
      header('location: ' . URL);
    }
  }

  // Search
  public function search() {
    $account = $this->getSessionAccount();

    if($account != null) {
      if(isset($_POST['submit_search'])) {
        $home_model = $this->loadModel('HomeModel');
        $subiect_model = $this->loadModel('SubiectModel');

        $specializari = $home_model->getSpecializari();

        if(isset($_POST['specializare_id'])) {
          if(isset($_POST['specializare_id']) && isset($_POST['anul'])) {
            if(isset($_POST['specializare_id']) && isset($_POST['anul']) && isset($_POST['semestrul'])) {
              if(isset($_POST['specializare_id']) && isset($_POST['anul']) && isset($_POST['semestrul']) && isset($_POST['materie_id'])) {
                $subiecte = $subiect_model->searchSubiecte($_POST['specializare_id'], $_POST['anul'], $_POST['semestrul'], $_POST['materie_id']);

                require 'application/views/_templates/header.php';
                require 'application/views/_templates/alert.php';
                require 'application/views/_templates/navbar.php';
                require 'application/views/subiecte/index.php';
                require 'application/views/_templates/footer.php';
              } else {
                $subiecte = $subiect_model->searchSubiecte($_POST['specializare_id'], $_POST['anul'], $_POST['semestrul'], '');

                require 'application/views/_templates/header.php';
                require 'application/views/_templates/alert.php';
                require 'application/views/_templates/navbar.php';
                require 'application/views/subiecte/index.php';
                require 'application/views/_templates/footer.php';
              }
            } else {
              $subiecte = $subiect_model->searchSubiecte($_POST['specializare_id'], $_POST['anul'], '', '');

              require 'application/views/_templates/header.php';
              require 'application/views/_templates/alert.php';
              require 'application/views/_templates/navbar.php';
              require 'application/views/subiecte/index.php';
              require 'application/views/_templates/footer.php';
            }
          } else {
            $subiecte = $subiect_model->searchSubiecte($_POST['specializare_id'], '', '', '');

            require 'application/views/_templates/header.php';
            require 'application/views/_templates/alert.php';
            require 'application/views/_templates/navbar.php';
            require 'application/views/subiecte/index.php';
            require 'application/views/_templates/footer.php';
          }
        } else {
          header('location: ' . URL . 'subiecte');
        }
      } else {
        header('location: ' . URL . 'subiecte');
      }
    } else {
      header('location: ' . URL);
    }
  }

}

?>
