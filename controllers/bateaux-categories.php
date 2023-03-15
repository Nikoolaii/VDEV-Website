<?php
include_once __DIR__ . "/../database/data-source.php";

class BateauxCategories
{
  public static function create(int $bateauId, string $categorieLettre, int $capaciteMax): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `bateaux_categories` (bateau_id, categorie_lettre, capacite_max) VALUES (:bateau_id, :categorie_lettre, :capacite_max)");
    $req->bindValue(':bateau_id', $bateauId, PDO::PARAM_INT);
    $req->bindValue(':categorie_lettre', $categorieLettre, PDO::PARAM_STR);
    $req->bindValue(':capacite_max', $capaciteMax, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function update(int $bateauId, string $categorieLettre, int $capaciteMax): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `bateaux_categories` SET capacite_max = :capacite_max WHERE bateau_id = :bateau_id AND categorie_lettre = :categorie_lettre");
    $req->bindValue(':bateau_id', $bateauId, PDO::PARAM_INT);
    $req->bindValue(':categorie_lettre', $categorieLettre, PDO::PARAM_STR);
    $req->bindValue(':capacite_max', $capaciteMax, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $bateauId, string $categorieLettre): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `bateaux_categories` WHERE bateau_id = :bateau_id AND categorie_lettre = :categorie_lettre");
    $req->bindValue(':bateau_id', $bateauId, PDO::PARAM_INT);
    $req->bindValue(':categorie_lettre', $categorieLettre, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function findOne(int $bateauId, string $categorieLettre): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `bateaux_categories` WHERE bateau_id = :bateau_id AND categorie_lettre = :categorie_lettre");
    $req->bindValue(':bateau_id', $bateauId, PDO::PARAM_INT);
    $req->bindValue(':categorie_lettre', $categorieLettre, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `bateaux_categories`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
