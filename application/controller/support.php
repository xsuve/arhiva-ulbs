<?php

class Support extends Controller {

  public function index() {
    require 'application/views/_templates/header.php';
    require 'application/views/_templates/alert.php';
    require 'application/views/support/index.php';
  }

  // Contact Support
  public function contactSupport() {
    $support_model = $this->loadModel('SupportModel');
    if(isset($_POST['submit_contact'])) {
      $contact_support = $support_model->contactSupport($_POST['username'], $_POST['subject'], $_POST['message']);

      if(isset($contact_support) && $contact_support != null) {
        $_SESSION['alert'] = $contact_support;
        header('location: ' . URL . 'support');
      } else {
        header('location: ' . URL);
      }
    }
  }

}

?>
