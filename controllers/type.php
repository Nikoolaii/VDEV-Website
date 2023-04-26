<?php
include_once __DIR__ . "/../database/data-source.php";

class Type
{
  public static function create(string $libelle, string $categorieLettre): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `type` (libelle, categorie_lettre) VALUES (:libelle, :categorie_lettre)");
    $req->bindValue(':libelle', $libelle, PDO::PARAM_STR);
    $req->bindValue(':categorie_lettre', $categorieLettre, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function update(int $id, string $libelle, string $categorieLettre): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `type` SET libelle = :libelle, categorie_lettre = :categorie_lettre WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':libelle', $libelle, PDO::PARAM_STR);
    $req->bindValue(':categorie_lettre', $categorieLettre, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `type` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `type` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `type`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
