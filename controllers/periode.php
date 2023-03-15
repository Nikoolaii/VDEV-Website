<?php
include_once __DIR__ . "/../database/data-source.php";

class Periode
{
  public static function create(DateTime $debut, DateTime $fin): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `periode` (debut, fin) VALUES (:debut, :fin)");
    $req->bindValue(':debut', $debut->format('Y-m-d H:i:s'), PDO::PARAM_STR);
    $req->bindValue(':fin', $fin->format('Y-m-d H:i:s'), PDO::PARAM_STR);
    return $req->execute();
  }

  public static function update(int $id, DateTime $debut, DateTime $fin): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `periode` SET debut = :debut, fin = :fin WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':debut', $debut->format('Y-m-d H:i:s'), PDO::PARAM_STR);
    $req->bindValue(':fin', $fin->format('Y-m-d H:i:s'), PDO::PARAM_STR);
    return $req->execute();
  }

  public static function delete(string $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `periode` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function findOne(string $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `periode` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `periode`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
