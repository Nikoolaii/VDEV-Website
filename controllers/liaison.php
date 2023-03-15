<?php
include_once __DIR__ . "/../database/data-source.php";

class Liaison
{
  public static function create(float $distance, ?string $imageLink, int $secteurId, int $departId, int $arriveeId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `liaison` (distance, image_link, secteur_id, depart_id, arrivee_id) VALUES (:distance, :image_link, :secteur_id, :depart_id, :arrivee_id)");
    $req->bindValue(':distance', $distance, PDO::PARAM_INT);
    $req->bindValue(':image_link', $imageLink, PDO::PARAM_STR);
    $req->bindValue(':secteur_id', $secteurId, PDO::PARAM_INT);
    $req->bindValue(':depart_id', $departId, PDO::PARAM_INT);
    $req->bindValue(':arrivee_id', $arriveeId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function update(int $id, float $distance, ?string $imageLink, int $secteurId, int $departId, int $arriveeId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `liaison` SET distance = :distance, image_link = :image_link, secteur_id = :secteur_id, depart_id = :depart_id, arrivee_id = :arrivee_id WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':distance', $distance, PDO::PARAM_INT);
    $req->bindValue(':image_link', $imageLink, PDO::PARAM_STR);
    $req->bindValue(':secteur_id', $secteurId, PDO::PARAM_INT);
    $req->bindValue(':depart_id', $departId, PDO::PARAM_INT);
    $req->bindValue(':arrivee_id', $arriveeId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `liaison` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `liaison` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `liaison`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
