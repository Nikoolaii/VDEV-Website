<?php
include_once __DIR__ . "/../database/data-source.php";

class Traversee
{
  public static function create(DateTime $date, string $heure, string $bateauId, string $liaisonId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `traversee` (date, heure, bateau_id, liaison_id) VALUES (:date, :heure, :bateau_id, :liaison_id)");
    $req->bindValue(':date', $date->format('Y-m-d'), PDO::PARAM_STR);
    $req->bindValue(':heure', $heure, PDO::PARAM_STR);
    $req->bindValue(':bateau_id', $bateauId, PDO::PARAM_STR);
    $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function update(int $id, DateTime $date, string $heure, string $bateauId, string $liaisonId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `traversee` SET date = :date, heure = :heure, bateau_id = :bateau_id, liaison_id = :liaison_id WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':date', $date->format('Y-m-d'), PDO::PARAM_STR);
    $req->bindValue(':heure', $heure, PDO::PARAM_STR);
    $req->bindValue(':bateau_id', $bateauId, PDO::PARAM_STR);
    $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `traversee` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `traversee` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `traversee`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
