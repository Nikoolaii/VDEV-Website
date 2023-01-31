<?php
class DataSource
{
  public ?PDO $database = null;

  function __construct()
  {
    try {
      $this->database = new PDO("mysql:host=localhost;port=5432;dbname=vdev", "root", "root");
      $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      $this->database = null;
      if ($_SERVER['REQUEST_URI'] !== "/database-error") {
        header("Location: /database-error");
      }
    }
  }

  public function validateUser(string $email, string $password)
  {
    $result = $this->database->query("SELECT * FROM `user` WHERE email = '$email';")->fetch();
    return $result["password"] === $password ? $result : null;
  }

  public function createUser(string $email, string $password, string $firstName, string $lastName)
  {
    // $result = $this->database->query("SELECT * FROM `user` WHERE email = '$email';");
    // var_dump($result);
    // return $result;

    echo 'zizi';
  }
}
