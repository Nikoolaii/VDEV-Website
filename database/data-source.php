<?php
include_once __DIR__ . '/../config/config.php';

class DataSource extends PDO
{
  private static $_instance;

  public function __construct()
  {
  }

  public static function getInstance(): PDO
  {

    if (!isset(self::$_instance)) {

      try {
        self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        self::$_instance->query("SET CHARACTER SET utf8");
      } catch (PDOException $e) {
        echo $e;
      }
    }
    return self::$_instance;
  }

  public static function validateUser(string $email, string $hashPassword)
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT * FROM `user` WHERE email = :email");
    $req->bindValue(":email", $email, PDO::PARAM_STR);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_OBJ);
    return $result->{"password"} === md5($hashPassword) ? $result : null;
  }

  public static function createUser(string $email, string $password, string $firstName, string $lastName)
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("INSERT INTO `user` (email, password, first_name, last_name, admin) VALUES (:email, :password, :firstName, :lastName, 0)");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':password', $password, PDO::PARAM_STR);
    $req->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $req->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $req->execute();
  }

  public static function checkUserExist(string $email)
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_OBJ);
    return $result ? true : false;
  }

  public static function collectSecteur()
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT * FROM `secteur`");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public static function collectLiaison(string $secteurId)
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT l.id, distance, secteurId, p1.nom AS depart, p2.nom AS arrivee, imglink FROM port p1 INNER JOIN liaison l ON p1.id = l.departID LEFT JOIN port p2 ON p2.id = l.arriveeID WHERE secteurId = :id");
    $req->bindValue(':id', $secteurId, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public static function collectTraversee(string $liaisonId)
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT * FROM traversee WHERE liaisonId = :id AND date > CURRENT_DATE");
    $req->bindValue(':id', $liaisonId, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public static function showLiaison()
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT l.id, distance, secteurId, p1.nom AS depart, p2.nom AS arrivee, imglink FROM port p1 INNER JOIN liaison l ON p1.id = l.departId LEFT JOIN  port p2 ON p2.id = l.arriveeId");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public static function getNBResa()
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("SELECT COUNT(*) FROM reservation");
    $req->execute();
    return $req->fetch(PDO::FETCH_NUM);
  }

  public static function validateReservation(string $nom, string $prenom, string $adresse, string $ville, string $cp, int $traversees, string $typeId, int $userId, int $nbAdulte, int $nbJunior, int $nbEnfant, int $nbFourgon, int $nbCC, int $nbCamion, int $nbVoiture4, int $nbVoiture5, int $nbAnimaux)
  {
    $pdo = self::getInstance();
    $req = $pdo->prepare("INSERT INTO `reservation`(nom,prenom,addresse,code_postal,ville,typeId,traverseeId,userId,nbAdulte,nbJunior,nbEnfant,nbFourgon,nbCC,nbCamion,nbVoiture4,nbVoiture5,nbAnimaux)VALUES(:fName,:lName,:adress,:cp,:city,:region,:liaison,:traversee,:adult,:junior,:baby,:fourgon,:cc,:camion,:voiture4,:voiture5,:animals)");
    $req->bindValue(':fName', $nom, PDO::PARAM_STR);
    $req->bindValue(':lName', $prenom, PDO::PARAM_STR);
    $req->bindValue(':adress', $adresse, PDO::PARAM_STR);
    $req->bindValue(':city', $ville, PDO::PARAM_STR);
    $req->bindValue(':cp', $cp, PDO::PARAM_INT);
    $req->bindValue(':region', $traversees, PDO::PARAM_INT);
    $req->bindValue(':liaison', $typeId, PDO::PARAM_INT);
    $req->bindValue(':traversee', $userId, PDO::PARAM_INT);
    $req->bindValue(':adult', $nbAdulte, PDO::PARAM_INT);
    $req->bindValue(':junior', $nbJunior, PDO::PARAM_INT);
    $req->bindValue(':baby', $nbEnfant, PDO::PARAM_INT);
    $req->bindValue(':fourgon', $nbFourgon, PDO::PARAM_INT);
    $req->bindValue(':cc', $nbCC, PDO::PARAM_INT);
    $req->bindValue(':camion', $nbCamion, PDO::PARAM_INT);
    $req->bindValue(':voiture4', $nbVoiture4, PDO::PARAM_INT);
    $req->bindValue(':voiture5', $nbVoiture5, PDO::PARAM_INT);
    $req->bindValue(':animals', $nbAnimaux, PDO::PARAM_INT);
    $req->execute();
  }
}
