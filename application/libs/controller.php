<?php

class Controller {

  public $db = null;

  function __construct() {
    if(!isset($_SESSION['account'])) {
      session_start();
    }

    $this->openDatabaseConnection();
  }

  // Session Account
  public function getSessionAccount() {
    if(isset($_SESSION['account']) && $_SESSION['account'] != '') {
      if(isset($_SESSION['account'][0])) {
        $sql = 'SELECT * FROM arhiva_ulbs_accounts WHERE username = :username';
        $query = $this->db->prepare($sql);
        $query->execute(array(':username' => $_SESSION['account'][0]));
        $a = $query->fetch();
        if($a->email == $_SESSION['account'][1]) {
          return $a;
        } else {
          $_SESSION['account'] = null;
          return null;
        }
      }
    }
  }

  private function openDatabaseConnection() {
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
    $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
  }

  public function loadModel($model_name) {
    require 'application/models/' . strtolower($model_name) . '.php';
    return new $model_name($this->db);
  }

}

?>
