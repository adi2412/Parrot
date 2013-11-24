<?php

class category {
  /**
   * Create a category
   */
  public function submit($title) {
    // check if logged in again as a safety net
    // the first check is mainly just to redirect
    // pesky users
    $query = database::getInstance()->query("SELECT * FROM `" . DB_PREFIX . "Category` WHERE `title`='$title'");
    $rows = $query->fetchAll();
    $checkTitle;
    foreach ($rows as $row) {
      $checkTitle = $row['title'];
    }
    if (auth::isLoggedIn() && $checkTitle !== $title && auth::isAdmin()) {
      // strip the HTML tags... Markdown only
      $title = strip_tags($title);
      $query = database::getInstance()->query("INSERT INTO `" . DB_PREFIX . "Category` (title) VALUES ('$title')");
    } else {
      // not logged in or another post already has same title
    }
  }

  /**
   * Deletes a category
   */
  public function delete($slug) {
    // check if logged in again as an admin as a 
    // safety net the first check is mainly just 
    //to redirect pesky users
    if (auth::isAdmin()) {
        $query = database::getInstance()->query("DELETE FROM `" . DB_PREFIX . "Category` WHERE `title`='$slug'");
        $query->execute();
    } else {
      // not an admin
    }
  }
}

?>