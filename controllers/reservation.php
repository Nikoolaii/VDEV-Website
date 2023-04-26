<?php
include_once __DIR__ . "/../database/data-source.php";

class Reservation
{
  public static function create(string $nom, string $prenom, string $email, string $adresse, string $codePostal, string $ville, int $traverseeId, int $userId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("INSERT INTO `reservation` (nom, prenom, email, adresse, code_postal, ville, traversee_id, user_id) VALUES (:nom, :prenom, :email, :adresse, :code_postal, :ville, :traversee_id, :user_id)");
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $req->bindValue(':code_postal', $codePostal, PDO::PARAM_STR);
    $req->bindValue(':ville', $ville, PDO::PARAM_STR);
    $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
    $req->bindValue(':user_id', $userId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function update(int $id, string $nom, string $prenom, string $email, string $adresse, string $codePostal, string $ville, int $traverseeId, int $userId): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("UPDATE `reservation` SET nom = :nom, prenom = :prenom, email = :email, adresse = :adresse, code_postal = :code_postal, ville = :ville, traversee_id = :traversee_id, user_id = :user_id WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $req->bindValue(':code_postal', $codePostal, PDO::PARAM_STR);
    $req->bindValue(':ville', $ville, PDO::PARAM_STR);
    $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
    $req->bindValue(':user_id', $userId, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function delete(int $id): bool
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("DELETE FROM `reservation` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    return $req->execute();
  }

  public static function findOne(int $id): mixed
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `reservation` WHERE id = :id");
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
  }

  public static function findAll(): array
  {
    $pdo = DataSource::getInstance();
    $req = $pdo->prepare("SELECT * FROM `reservation`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }
}
