<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservation.php";

$id = $params['id'];

$res = Reservation::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/reservations" class="text-blue-500 underline">Toutes les réservations</a>

  <h1 class="text-3xl">Informations Réservation <?= $res->{'id'} ?></h1>

  <p>Nom: <?= $res->{'nom'} ?></p>
  <p>Prénom: <?= $res->{'prenom'} ?></p>
  <p>Email: <?= $res->{'email'} ?></p>
  <p>Adresse: <?= $res->{'adresse'} ?></p>
  <p>Code Postal: <?= $res->{'code_postal'} ?></p>
  <p>Ville: <?= $res->{'ville'} ?></p>
  <p>
    Traversée id: <a href="/admin/traversees/<?= $res->{'traversee_id'} ?>" class="text-blue-500 underline">
      <?= $res->{'traversee_id'} ?>
    </a>
  </p>
  <p>
    Utilisateur id: <a href="/admin/users/<?= $res->{'user_id'} ?>" class="text-blue-500 underline">
      <?= $res->{'user_id'} ?>
    </a>
  </p>


  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/reservations/<?= $res->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/reservations/<?= $res->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>