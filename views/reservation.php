<?php
include_once __DIR__ . '/../controllers/utils.php';

$reservationId = $params['reservationId'];

if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

$reservation = getReservation($reservationId);

if (is_null($user) || $reservation->{'user_id'} != $user->{'id'}) {
  header("Location: /");
  exit();
}

$details = getReservationDetails($reservationId);
$date = new DateTime($reservation->date);
$prixTotal = 0;

foreach ($details as $detail) {
  $prixTotal += $detail->prix;
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Réservation N°<?= $reservation->id ?></h1>

  <p class="text-lg">Liaison <?= $reservation->port_arrivee ?> - <?= $reservation->port_depart ?></p>
  <p class="text-lg">Départ le <?= $date->format('d/m/Y') ?> à <?= $reservation->heure ?></p>

  <h3 class="text-2xl mt-3">Informations personnelles</h3>
  <p class="text-lg">Nom : <?= $reservation->nom ?></p>
  <p class="text-lg">Prénom : <?= $reservation->prenom ?></p>
  <p class="text-lg">Adresse : <?= $reservation->adresse ?></p>
  <p class="text-lg">Code postal : <?= $reservation->code_postal ?></p>
  <p class="text-lg">Ville : <?= $reservation->ville ?></p>

  <h3 class="text-2xl mt-3">Détails de la réservation</h3>
  <table class="table-auto">
    <thead>
      <tr>
        <th class="px-4 py-2">Type</th>
        <th class="px-4 py-2">Quantité</th>
        <th class="px-4 py-2">Prix</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($details as $detail) : ?>
        <tr>
          <td class="border px-4 py-2"><?= $detail->libelle ?></td>
          <td class="border px-4 py-2"><?= $detail->quantite ?></td>
          <td class="border px-4 py-2"><?= number_format($detail->prix, 2) ?> €</td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td class="border px-4 py-2 font-semibold" colspan="2">Total</td>
        <td class="border px-4 py-2 text-right"><?= number_format($prixTotal, 2) ?> €</td>
      </tr>
    </tbody>
</div>