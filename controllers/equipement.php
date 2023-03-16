<?php
include_once __DIR__ . "/../database/data-source.php";

class Equipement
{
  public static function create(string $nom): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `equipement` (nom) VALUES (:nom)");
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function update(int $id, string $nom): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `equipement` SET nom = :nom WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `equipement` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `equipement` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `equipement`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
