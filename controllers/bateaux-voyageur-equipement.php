<?php
include_once __DIR__ . "/../database/data-source.php";

class BateauVoyageurEquipement
{
  public static function create(int $bateauId, int $equipementId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `bateau_voyageur_equipement` (equipement_id, bateau_voyageur_id) VALUES (:equipement_id, :bateau_voyageur_id)");
    $req->bindValue(':equipement_id', $equipementId, PDO::PARAM_INT);
    $req->bindValue(':bateau_voyageur_id', $bateauId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $bateauId, int $equipementId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `bateau_voyageur_equipement` WHERE equipement_id = :equipement_id AND bateau_voyageur_id = :bateau_voyageur_id");
    $req->bindValue(':equipement_id', $equipementId, PDO::PARAM_INT);
    $req->bindValue(':bateau_voyageur_id', $bateauId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $bateauId, int $equipementId): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `bateau_voyageur_equipement` WHERE equipement_id = :equipement_id AND bateau_voyageur_id = :bateau_voyageur_id");
    $req->bindValue(':equipement_id', $equipementId, PDO::PARAM_INT);
    $req->bindValue(':bateau_voyageur_id', $bateauId, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `bateau_voyageur_equipement`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
