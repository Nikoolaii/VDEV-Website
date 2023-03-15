<?php
include_once __DIR__ . "/../database/data-source.php";

class User
{
  public static function create(string $email, string $password, string $firstName, string $lastName, bool $admin = false): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `user` (email, password, first_name, last_name, admin) VALUES (:email, :password, :firstName, :lastName, :admin)");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $req->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $req->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $req->bindValue(':admin', $admin, PDO::PARAM_BOOL);
    return $req->execute();
  }

  public static function update(int $id, string $email, string $password, string $firstName, string $lastName, bool $admin): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `user` SET email = :email, password = :password, first_name = :firstName, last_name = :lastName, admin = :admin WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $req->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $req->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $req->bindValue(':admin', $admin, PDO::PARAM_BOOL);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `user` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `user` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findByEmail(string $email): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `user` WHERE email = :email");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `user`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ, "User");
  }
}
