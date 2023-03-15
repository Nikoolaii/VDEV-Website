<?php
include_once __DIR__ . "/../database/data-source.php";

class LiaisonTypesPeriodes
{
  public static function create(int $liaisonId, int $typeId, int $periodeId, float $tarif): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `liaisons_types_periodes` (liaison_id, type_id, periode_id, tarif) VALUES (:liaison_id, :type_id, :periode_id, :tarif)");
    $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':periode_id', $periodeId, PDO::PARAM_INT);
    $req->bindValue(':tarif', $tarif, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function update(int $liaisonId, int $typeId, int $periodeId, float $tarif): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `liaisons_types_periodes` SET tarif = :tarif WHERE liaison_id = :liaison_id AND type_id = :type_id AND periode_id = :periode_id");
    $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':periode_id', $periodeId, PDO::PARAM_INT);
    $req->bindValue(':tarif', $tarif, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $liaisonId, int $typeId, int $periodeId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `liaisons_types_periodes` WHERE liaison_id = :liaison_id AND type_id = :type_id AND periode_id = :periode_id");
    $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':periode_id', $periodeId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $liaisonId, int $typeId, int $periodeId): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `liaisons_types_periodes` WHERE liaison_id = :liaison_id AND type_id = :type_id AND periode_id = :periode_id");
    $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':periode_id', $periodeId, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `liaisons_types_periodes`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
