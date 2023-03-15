<?php
include_once __DIR__ . "/../database/data-source.php";

class Bateau
{
  public static function create(string $nom, string $type, ?float $longueur, ?float $largeur, ?float $vitesse, ?float $poidsMax): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `bateau` (nom, type, longueur, largeur, vitesse, poids_max) VALUES (:nom, :type, :longueur, :largeur, :vitesse, :poids_max)");
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':type', $type, PDO::PARAM_STR);
    $req->bindValue(':longueur', $longueur, PDO::PARAM_INT);
    $req->bindValue(':largeur', $largeur, PDO::PARAM_INT);
    $req->bindValue(':vitesse', $vitesse, PDO::PARAM_INT);
    $req->bindValue(':poids_max', $poidsMax, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function update(int $id, string $nom, ?float $longueur, ?float $largeur, ?float $vitesse, ?float $poidsMax): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `bateau` SET nom = :nom, longueur = :longueur, largeur = :largeur, vitesse = :vitesse, poids_max = :poids_max WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':longueur', $longueur, PDO::PARAM_INT);
    $req->bindValue(':largeur', $largeur, PDO::PARAM_INT);
    $req->bindValue(':vitesse', $vitesse, PDO::PARAM_INT);
    $req->bindValue(':poids_max', $poidsMax, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `bateau` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `bateau` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `bateau`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
