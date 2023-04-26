<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservations-types.php";

$rts = ReservationsTypes::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les Réservations-Types</h1>

  <a href="/admin/reservations-types/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un Réservation-Type</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">Id bateau</th>
        <th class="py-2">Id Type</th>
        <th class="py-2">Quantité</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rts as $rt) : ?>
        <tr>
          <td>
            <a href="/admin/reservations/<?= $rt->{'reservation_id'} ?>" class="text-blue-500 underline">
              <?= $rt->{'reservation_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/types/<?= $rt->{'type_id'} ?>" class="text-blue-500 underline">
              <?= $rt->{'type_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2"><?= $rt->{'quantite'} ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/reservations-types/<?= $rt->{'reservation_id'} ?>/<?= $rt->{'type_id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/reservations-types/<?= $rt->{'reservation_id'} ?>/<?= $rt->{'type_id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/reservations-types/<?= $rt->{'reservation_id'} ?>/<?= $rt->{'type_id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>