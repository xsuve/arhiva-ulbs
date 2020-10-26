<?php

class LogoutModel {

  // Logout Account
  public function logoutAccount() {
    session_destroy();
    session_unset();
  }
}

?>
