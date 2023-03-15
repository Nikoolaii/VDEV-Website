<?php
include_once __DIR__ . '/../database/data-source.php';

function getLiaisonsBySecteurId(int $secteurId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT liaison.id AS id, distance, port_depart.nom AS port_depart, port_arrivee.nom AS port_arrivee
  FROM liaison
  INNER JOIN port port_depart ON liaison.depart_id = port_depart.id
  INNER JOIN port port_arrivee ON liaison.arrivee_id = port_arrivee.id
  WHERE secteur_id = :secteur_id");
  $req->bindValue(':secteur_id', $secteurId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function getLiaisonWithPorts(int $liaisonId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT liaison.id AS id, port_depart.nom AS port_depart, port_arrivee.nom AS port_arrivee
  FROM liaison
  INNER JOIN port port_depart ON liaison.depart_id = port_depart.id
  INNER JOIN port port_arrivee ON liaison.arrivee_id = port_arrivee.id
  WHERE liaison.id = :liaison_id");
  $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetch(PDO::FETCH_OBJ);
}

function getTraverseesWithBateau(int $liaisonId, DateTime $date)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT traversee.id AS id, heure, b.nom AS bateau
  FROM traversee
  INNER JOIN bateau b on traversee.bateau_id = b.id
  WHERE liaison_id = :liaison_id
  AND date = :date");
  $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
  $req->bindValue(':date', $date->format('Y-m-d'), PDO::PARAM_STR);
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function getPlacesForTraverseeCategorie(int $traverseeId, string $categorie)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT capacite_max
  FROM bateaux_categories
  INNER JOIN traversee t on bateaux_categories.bateau_id = t.bateau_id
  WHERE id = :traversee_id AND categorie_lettre = :categorie");
  $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
  $req->bindValue(':categorie', $categorie, PDO::PARAM_STR);
  $req->execute();

  $capaciteMax = $req->fetch(PDO::FETCH_OBJ);

  if ($capaciteMax == false) {
    return null;
  }

  $capaciteMax = $capaciteMax->{'capacite_max'};

  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT SUM(quantite) as capacite
  FROM reservations_types
  INNER JOIN reservation r on reservations_types.reservation_id = r.id
  INNER JOIN type ty on reservations_types.type_id = ty.id
  INNER JOIN traversee tr on r.traversee_id = tr.id
  INNER JOIN categorie c on ty.categorie_lettre = c.lettre
  WHERE tr.id = :traversee_id AND ty.categorie_lettre = :categorie");
  $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
  $req->bindValue(':categorie', $categorie, PDO::PARAM_STR);
  $req->execute();


  $capacite = $req->fetch(PDO::FETCH_OBJ)->{'capacite'};

  if ($capacite == null) {
    $capacite = 0;
  }

  return $capaciteMax - $capacite;
}

function getCategoriesOfLiaison(int $liaisonId, DateTime $date)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT lettre, nom
  FROM categorie
  INNER JOIN bateaux_categories bc on categorie.lettre = bc.categorie_lettre
  INNER JOIN traversee t on bc.bateau_id = t.bateau_id
  WHERE t.liaison_id = :liaison_id
  AND t.date = :date
  GROUP BY lettre");
  $req->bindValue(':liaison_id', $liaisonId, PDO::PARAM_INT);
  $req->bindValue(':date', $date->format('Y-m-d'), PDO::PARAM_STR);
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function getTraverseeWithFullInformations(int $traverseeId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT port_depart.nom as port_depart, port_arrivee.nom as port_arrivee, date, heure
  FROM traversee
  INNER JOIN bateau b on traversee.bateau_id = b.id
  INNER JOIN liaison l on traversee.liaison_id = l.id
  INNER JOIN port port_depart on l.depart_id = port_depart.id
  INNER JOIN port port_arrivee on l.arrivee_id = port_arrivee.id
  WHERE traversee.id = :traversee_id");
  $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetch(PDO::FETCH_OBJ);
}

function getTarifsForTraversee(int $traverseeId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT libelle, tarif, capacite_max, ty.id as type_id
  FROM bateaux_categories
  INNER JOIN type ty on bateaux_categories.categorie_lettre = ty.categorie_lettre
  INNER JOIN liaisons_types_periodes ltp on ty.id = ltp.type_id
  INNER JOIN traversee t on bateaux_categories.bateau_id = t.bateau_id AND ltp.liaison_id = t.liaison_id
  INNER JOIN periode p on ltp.periode_id = p.id
  WHERE t.id = :traversee_id
  AND p.debut <= t.date AND p.fin >= t.date");
  $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function createReservation(string $nom, string $prenom, string $email, string $adresse, string $codePostal, string $ville, int $traverseeId, array $quantites, ?int $userId): ?int
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("INSERT INTO reservation (nom, prenom, adresse, code_postal, ville, traversee_id, user_id) VALUES (:nom, :prenom, :adresse, :code_postal, :ville, :traversee_id, :user_id)");
  $req->bindValue(':nom', $nom, PDO::PARAM_STR);
  $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
  $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
  $req->bindValue(':code_postal', $codePostal, PDO::PARAM_STR);
  $req->bindValue(':ville', $ville, PDO::PARAM_STR);
  $req->bindValue(':traversee_id', $traverseeId, PDO::PARAM_INT);
  $req->bindValue(':user_id', $userId, PDO::PARAM_INT);
  $result = $req->execute();

  if (!$result) {
    return null;
  }

  $reservationId = $pdo->lastInsertId();

  foreach ($quantites as $typeId => $quantite) {
    $req = $pdo->prepare("INSERT INTO reservations_types (reservation_id, type_id, quantite) VALUES (:reservation_id, :type_id, :quantite)");
    $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
    $req->bindValue(':type_id', $typeId, PDO::PARAM_INT);
    $req->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $result = $req->execute();

    if (!$result) {
      return null;
    }
  }

  if ($userId == null) {
    $req = $pdo->prepare("SELECT id FROM user WHERE email = :email");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch(PDO::FETCH_OBJ);

    if ($user != false) {
      $req = $pdo->prepare("UPDATE reservation SET user_id = :user_id WHERE id = :reservation_id");
      $req->bindValue(':user_id', $user->{'id'}, PDO::PARAM_INT);
      $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
      $result = $req->execute();
    }
  }

  return $reservationId;
}

function getReservation(int $reservationId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT reservation.id, reservation.nom, prenom, adresse, code_postal, ville, user_id, date, heure, port_depart.nom as port_depart, port_arrivee.nom as port_arrivee
  FROM reservation
  INNER JOIN traversee t on reservation.traversee_id = t.id
  INNER JOIN liaison l on t.liaison_id = l.id
  INNER JOIN bateau b on t.bateau_id = b.id
  INNER JOIN port port_depart on l.depart_id = port_depart.id
  INNER JOIN port port_arrivee on l.depart_id = port_arrivee.id
  WHERE reservation.id = :reservation_id");
  $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetch(PDO::FETCH_OBJ);
}

function getReservationDetails(int $reservationId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT libelle, quantite, (quantite * tarif) as prix
  FROM reservations_types
  INNER JOIN reservation r on reservations_types.reservation_id = r.id
  INNER JOIN traversee t on r.traversee_id = t.id
  INNER JOIN liaisons_types_periodes ltp on reservations_types.type_id = ltp.type_id and t.liaison_id = ltp.liaison_id
  INNER JOIN periode p on ltp.periode_id = p.id
  INNER JOIN type ty on ltp.type_id = ty.id
  WHERE reservation_id = :reservation_id
  AND p.debut <= t.date AND p.fin >= t.date");
  $req->bindValue(':reservation_id', $reservationId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function getUserReservations(int $userId)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT reservation.id, date, heure, port_depart.nom as port_depart, port_arrivee.nom as port_arrivee
  FROM reservation
  INNER JOIN traversee t on reservation.traversee_id = t.id
  INNER JOIN liaison l on t.liaison_id = l.id
  INNER JOIN port port_depart on l.depart_id = port_depart.id
  INNER JOIN port port_arrivee on l.arrivee_id = port_arrivee.id
  WHERE user_id = :user_id");
  $req->bindValue(':user_id', $userId, PDO::PARAM_INT);
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function addUserIdOnReservations(string $email)
{
  $pdo = DataSource::getInstance();
  $req = $pdo->prepare("SELECT id FROM user WHERE email = :email");
  $req->bindValue(':email', $email, PDO::PARAM_STR);
  $req->execute();
  $user = $req->fetch(PDO::FETCH_OBJ);

  if ($user != false) {
    $req = $pdo->prepare("UPDATE reservation SET user_id = :user_id WHERE user_id IS NULL AND email = :email");
    $req->bindValue(':user_id', $user->{'id'}, PDO::PARAM_INT);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();
  }
}
