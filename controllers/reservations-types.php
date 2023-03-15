<?php
include_once __DIR__ . "/../database/data-source.php";

class ReservationsTypes
{
  public static function create(int $reservationId, int $typeId, int $quantite): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `reservations_types` (reservation_id, type_id, quantite) VALUES (:reservation_id, :type_id, :quantite)");
    $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function update(int $reservationId, int $typeId, int $quantite): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `reservations_types` SET quantite = :quantite WHERE reservation_id = :reservation_id AND type_id = :type_id");
    $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $reservationId, int $typeId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `reservations_types` WHERE reservation_id = :reservation_id AND type_id = :type_id");
    $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $reservationId, int $typeId): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `reservations_types` WHERE reservation_id = :reservation_id AND type_id = :type_id");
    $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `reservations_types`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
