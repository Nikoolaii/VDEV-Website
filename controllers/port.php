<?php
include_once __DIR__ . "/../database/data-source.php";

class Port
{
  public static function create(string $nom): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `port` (nom) VALUES (:nom)");
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function update(int $id, string $nom): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `port` SET nom = :nom WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `port` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `port` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `port`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
