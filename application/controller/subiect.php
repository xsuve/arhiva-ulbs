<?php

class Subiect extends Controller {

  public function index($slug) {
    if(isset($slug) && $slug != null) {
      $account = $this->getSessionAccount();

      if($account != null) {
        $subiect_model = $this->loadModel('SubiectModel');
        $subiect = $subiect_model->getSubiectData($slug);

        if($subiect) {
          $materie_data = $subiect_model->getMaterieData($subiect->materie_id);
          $account_data = $subiect_model->getAccountData($subiect->account_id);
          $time = $subiect_model->formatSubiectTime($subiect->date_time);
          $subiect_thanks = count($subiect_model->getSubiectThanks($subiect->id));
          $subiect_thanked = $subiect_model->subiectThanked($account->id, $subiect->id);

          require 'application/views/subiect/_templates/header.php';
          require 'application/views/_templates/alert.php';
          require 'application/views/_templates/navbar.php';
          require 'application/views/subiect/index.php';
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

  // Post
  public function post() {
    $account = $this->getSessionAccount();

    $subiect_model = $this->loadModel('SubiectModel');
    if($account != null) {
      if(isset($_POST['submit_post'])) {
        $post_subiect = $subiect_model->postSubiect($account->id, $_POST['specializare_id'], $_POST['materie_id'], $_POST['anul'], $_POST['semestrul'], $_POST['description'], $_FILES['image']);

        if(!isset($post_subiect['error']) && isset($post_subiect['slug'])) {
          header('location: ' . URL . 'subiect/' . $post_subiect['slug']);
        } else {
          if(isset($post_subiect['error'])) {
            $_SESSION['alert'] = $post_subiect['error'];
            header('location: ' . URL . 'subiect/post');
          } else {
            header('location: ' . URL . 'subiect/post');
          }
        }
      } else {
        $home_model = $this->loadModel('HomeModel');

        $specializari = $home_model->getSpecializari();

        require 'application/views/_templates/header.php';
        require 'application/views/_templates/alert.php';
        require 'application/views/_templates/navbar.php';
        require 'application/views/subiect/post.php';
        require 'application/views/_templates/footer.php';
      }
    } else {
      header('location: ' . URL);
    }
  }

  // Get Materii
  public function getMaterii($specializare_id, $anul, $semestrul) {
    $subiect_model = $this->loadModel('SubiectModel');
    $materii = $subiect_model->getMaterii($specializare_id, $anul, $semestrul);

    echo json_encode($materii);
  }

  // Download
  public function download($slug) {
    $subiect_model = $this->loadModel('SubiectModel');
    $subiect = $subiect_model->getSubiectData($slug);

    if($subiect) {
      header('Content-Type: application/octet-stream');
      header("Content-Transfer-Encoding: Binary");
      header("Content-disposition: attachment; filename=\"" . basename($subiect->image) . "\"");
      readfile($subiect->image);
    }
  }

  // Thank
  public function thank() {
    if(isset($_POST['subiect_id'])) {
      $account = $this->getSessionAccount();

      if($account != null) {
        $subiect_model = $this->loadModel('SubiectModel');
        $thank = $subiect_model->thankSubiect($account->id, $_POST['subiect_id']);

        echo json_encode($thank);
      }
    }
  }

  // Report
  public function report($slug) {
    $subiect_model = $this->loadModel('SubiectModel');
    $subiect = $subiect_model->getSubiectData($slug);

    if($subiect) {
      $materie_data = $subiect_model->getMaterieData($subiect->materie_id);

      require 'application/views/subiect/_templates/header.php';
      require 'application/views/_templates/alert.php';
      require 'application/views/subiect/report.php';
      require 'application/views/_templates/footer.php';
    } else {
      header('location: ' . URL);
    }
  }

  // Report Subiect
  public function reportSubiect() {
    $account = $this->getSessionAccount();

    $subiect_model = $this->loadModel('SubiectModel');
    if($account != null) {
      if(isset($_POST['submit_report'])) {
        $report_subiect = $subiect_model->reportSubiect($account->id, $_POST['subiect_id'], $_POST['motiv'], $_POST['details']);

        if(!isset($report_subiect['error']) && isset($report_subiect['slug'])) {
          $_SESSION['alert'] = $report_subiect['success'];
          header('location: ' . URL . 'subiect/' . $report_subiect['slug']);
        } else {
          if(isset($report_subiect['error'])) {
            $_SESSION['alert'] = $report_subiect['error'];
            header('location: ' . URL);
          } else {
            header('location: ' . URL);
          }
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
