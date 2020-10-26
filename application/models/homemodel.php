<?php

class HomeModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Get Specializari
  public function getSpecializari() {
    $sql = 'SELECT * FROM arhiva_ulbs_specializari';
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  // Get Account Invitation
  public function getAccountInvitation($account_id) {
    $account_id = strip_tags($account_id);

    $sql = 'SELECT * FROM arhiva_ulbs_invitations WHERE account_id = :account_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':account_id' => $account_id));

    return $query->fetch();
  }

}

?>
