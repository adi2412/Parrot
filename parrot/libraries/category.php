<?php

class category {
  /**
   * Create a category
   */
  public function submit($title) {
    // check if logged in again as a safety net
    // the first check is mainly just to redirect
    // pesky users
    $query = database::getInstance()->query("SELECT * FROM " . database::getTableName('Category') . " WHERE `title`='$title'");
    $rows = $query->fetchAll();
    $checkTitle;
    foreach ($rows as $row) {
      $checkTitle = $row['title'];
    }
    if (auth::isLoggedIn() && $checkTitle !== $title && auth::isAdmin()) {
      // strip the HTML tags... Markdown only
      $title = strip_tags($title);
      $query = database::getInstance()->query("INSERT INTO " . database::getTableName('Category') . " (title) VALUES ('$title')");
    } else {
      // not logged in or not admin
    }
  }

  /**
   * Deletes a category
   */
  public function delete($slug) {
    // check if logged in again as an admin as a
    // safety net the first check is mainly just
    //to redirect pesky users
    $title = discussion::decode_title($slug);
    if (auth::isAdmin()) {
        $query = database::getInstance()->query("DELETE FROM " . database::getTableName('Category') . " WHERE `title`='$title'");
        $query->execute();
    } else {
      // not an admin
    }
  }
}
