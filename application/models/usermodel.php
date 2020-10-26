<?php

class UserModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Get User Data
  public function getUserData($username) {
    $username = strip_tags($username);

    $sql = 'SELECT * FROM arhiva_ulbs_accounts WHERE username = :username';
    $query = $this->db->prepare($sql);
    $query->execute(array(':username' => $username));

    return $query->fetch();
  }

  // Get User Subiecte
  public function getUserSubiecte($user_id) {
    $user_id = strip_tags($user_id);

    $sql = 'SELECT * FROM arhiva_ulbs_subiecte WHERE account_id = :user_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':user_id' => $user_id));

    return $query->fetchAll();
  }

}

?>
