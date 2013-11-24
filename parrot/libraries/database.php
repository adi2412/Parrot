<?php

// code credit goes to
// https://github.com/anandkunal/ToroPHP/blob/master/examples/blog/lib/mysql.php
class database {
  private static $instance = NULL;

  private function __construct() { }
  private function __clone() { }

  /**
   * Gets the DB instance
   */
  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new PDO('mysql:host=' . DB_URL . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return self::$instance;
  }
}

?>