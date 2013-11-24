<?php

class info {
  /**
   * Updates the site info
   */
  public function update($title, $description, $theme) {
    // check if logged in again as a safety net
    // the first check is mainly just to redirect
    // pesky users
    if (auth::isLoggedIn() && auth::isAdmin()) {
      database::getInstance()->query("UPDATE `" . DB_PREFIX . "Meta` SET `title` = '$title', `description` = '$description', `theme` = '$theme'");
    } else {
      // not logged in / not admin
    }
  }
}

?>