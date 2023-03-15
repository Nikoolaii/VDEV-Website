<?php
include_once __DIR__ . "/../database/data-source.php";

class Categorie
{
  public static function create(string $lettre, string $nom): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `categorie` (lettre, nom) VALUES (:lettre, :nom)");
    $req->bindValue(':lettre', $lettre, PDO::PARAM_STR);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function update(string $lettre, string $nom): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `categorie` SET nom = :nom WHERE lettre = :lettre");
    $req->bindValue(':lettre', $lettre, PDO::PARAM_STR);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function delete(string $lettre): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `categorie` WHERE lettre = :lettre");
    $req->bindValue(':lettre', $lettre, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function findOne(string $lettre): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `categorie` WHERE lettre = :lettre");
    $req->bindValue(':lettre', $lettre, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `categorie`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
