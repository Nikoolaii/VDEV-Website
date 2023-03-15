<?php
include_once __DIR__ . '/../config/config.php';

class DataSource extends PDO
{
  private static $_instance;

  public function __construct()
  {
  }

  public static function getInstance(): PDO
  {

    if (!isset(self::$_instance)) {

      try {
        self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        self::$_instance->query("SET CHARACTER SET utf8");
      } catch (PDOException $e) {
        echo $e;
      }
    }
    return self::$_instance;
  }
}
