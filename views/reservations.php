<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user)) {
  header("Location: /signin");
  exit();
}

include_once __DIR__ . "/../controllers/utils.php";

$reservations = getUserReservations($user->id);
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-6">Mes réservations</h1>

  <table class="w-full text-left">
    <thead class="border-b">
      <tr class="text-xl border-b">
        <th class="py-2">Numéro</th>
        <th class="py-2">Date</th>
        <th class="py-2">Heure</th>
        <th class="py-2">Départ</th>
        <th class="py-2">Arrivée</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($reservations as $reservation) : ?>
        <tr>
          <td><?= $reservation->id ?></td>
          <td class="border-l pl-2 py-2"><?= $reservation->date ?></td>
          <td class="border-l pl-2 py-2"><?= $reservation->heure ?></td>
          <td class="border-l pl-2 py-2"><?= $reservation->port_depart ?></td>
          <td class="border-l pl-2 py-2"><?= $reservation->port_arrivee ?></td>
          <td class="border-l pl-2 py-2">
            <a href="/reservation/<?= $reservation->id ?>" class="text-blue-500">Voir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>