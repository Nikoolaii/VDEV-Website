<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservations-types.php";

$idRes = $params['idReservation'];
$idType = $params['idType'];

$rt = ReservationsTypes::findOne($idRes, $idType);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/reservations-types" class="text-blue-500 underline">Tous les Réservations-Types</a>

  <h1 class="text-3xl">Informations Réservation <?= $rt->{'reservation_id'} ?> - Type <?= $rt->{'type_id'} ?></h1>

  <p>Capacité Quantité: <?= $rt->{'quantite'} ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/reservations-types/<?= $rt->{'reservation_id'} ?>/<?= $rt->{'type_id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/reservations-types/<?= $rt->{'reservation_id'} ?>/<?= $rt->{'type_id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>