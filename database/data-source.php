<?php
class DataSource
{
  public ?PDO $database = null;

  function __construct()
  {
    try {
      $this->database = new PDO("mysql:host=localhost;port=8889;dbname=vdev", "root", "root");
      $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      $this->database = null;
      if ($_SERVER['REQUEST_URI'] !== "/database-error") {
        header("Location: /database-error");
      }
    }
  }

  public function validateUser(string $email, string $password)
  {
    $result = $this->database->query("SELECT * FROM `user` WHERE email = '$email';")->fetch();
    return $result["password"] === md5($password) ? $result : null;
  }

  public function createUser(string $email, string $password, string $firstName, string $lastName)
  {

    $req = $this->database->prepare("INSERT INTO `user` (email, password, first_name, last_name, admin) VALUES (:email, :password, :firstName, :lastName, 0);");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':password', $password, PDO::PARAM_STR);
    $req->bindValue(':firstName', $firstName, PDO::PARAM_STR);
    $req->bindValue(':lastName', $lastName, PDO::PARAM_STR);
    $req->execute();
  }

  public function userAlreadyExist(string $email)
  {
    $req = $this->database->prepare("SELECT * FROM user WHERE email = ':email';");
    $req->bindValue(':email', $email, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function collectRegion()
  {
    $result = $this->database->query("SELECT * FROM `secteur`;")->fetchAll();
    return $result;
  }

  public function collectLiaison(string $regionID)
  {
    $req = $this->database->prepare("SELECT l.id,distance,secteurId,p1.nom AS depart, p2.nom AS arrivee, imglink
    FROM port p1 INNER JOIN liaison l ON p1.id = l.departID
    LEFT JOIN  port p2 ON p2.id = l.arriveeID WHERE secteurId = :id;");
    $req->bindValue(':id', $regionID, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function collectTraversee(string $liaisonID)
  {
    $req = $this->database->prepare("SELECT * FROM traversee WHERE liaisonId = :id AND date > CURRENT_DATE;");
    $req->bindValue(':id', $liaisonID, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function showLiaison()
  {
    $req = $this->database->prepare("SELECT l.id,distance,secteurId,p1.nom AS depart, p2.nom AS arrivee, imglink
    FROM port p1 INNER JOIN liaison l ON p1.id = l.departID
    LEFT JOIN  port p2 ON p2.id = l.arriveeID");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
  }

  public function getNBResa()
  {
    $req = $this->database->prepare("SELECT COUNT(*) FROM reservation");
    $req->execute();
    return $req->fetch(PDO::FETCH_NUM);
  }
  public function validateReservation(string $nom, string $prenom, string $adresse, string $ville, string $cp, int $traversees, string $typeId, int $userId, int $nbAdulte, int $nbJunior, int $nbEnfant, int $nbFourgon, int $nbCC, int $nbCamion, int $nbVoiture4, int $nbVoiture5, int $nbAnimaux)
  {
    $req = $this->database->prepare("INSERT INTO `reservation`(nom,prenom,addresse,code_postal,ville,typeId,traverseeId,userId,nbAdulte,nbJunior,nbEnfant,nbFourgon,nbCC,nbCamion,nbVoiture4,nbVoiture5,nbAnimaux)VALUES(:fName,:lName,:adress,:cp,:city,:region,:liaison,:traversee,:adult,:junior,:baby,:fourgon,:cc,:camion,:voiture4,:voiture5,:animals");
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
