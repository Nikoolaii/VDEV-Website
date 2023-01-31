<?php
class DataSource
{
  public ?PDO $database = null;

  function __construct()
  {
    try {
      $this->database = new PDO("mysql:host=localhost;port=8889;dbname=vdev", "root", "root");
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
    return $result["password"] === md5($password) ? $result : null;
  }

  public function createUser(string $email, string $password, string $firstName, string $lastName)
  {
    $result = $this->database->query("INSERT INTO `user` (email, password, first_name, last_name) VALUES ('$email', '$password', '$firstName', '$lastName');");
    echo $result;
    return $result;
  }

  public function userAlreadyExist(string $email)
  {
    $result = $this->database->query("SELECT * FROM `user` WHERE email = '$email';")->fetch();
    if (!$result == false) {
      return false;
    } else {
      return true;
    }
  }

  public function collectRegion()
  {
    $result = $this->database->query("SELECT * FROM `secteur`;")->fetchAll();
    return $result;
  }

  public function collectTraversee(string $regionID)
  {
    $req = $this->database->prepare("SELECT * FROM `traversee` WHERE code = :id");
    $req->bindValue(':id', $regionID, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
