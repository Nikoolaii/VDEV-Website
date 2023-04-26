<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservation.php";

$reservations = Reservation::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les réservations</h1>

  <a href="/admin/reservations/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer une réservation</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Nom</th>
        <th class="py-2">Prénom</th>
        <th class="py-2">Email</th>
        <th class="py-2">Adresse</th>
        <th class="py-2">Code postal</th>
        <th class="py-2">Ville</th>
        <th class="py-2">Traversée Id</th>
        <th class="py-2">Utilisateur Id</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($reservations as $res) : ?>
        <tr>
          <td><?= $res->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $res->{'nom'} ?></td>
          <td class="border-l px-4 py-2"><?= $res->{'prenom'} ?></td>
          <td class="border-l px-4 py-2"><?= $res->{'email'} ?></td>
          <td class="border-l px-4 py-2"><?= $res->{'adresse'} ?></td>
          <td class="border-l px-4 py-2"><?= $res->{'code_postal'} ?></td>
          <td class="border-l px-4 py-2"><?= $res->{'ville'} ?></td>
          <td class="border-l px-4 py-2">
            <a href="/admin/traversees/<?= $res->{'traversee_id'} ?>" class="text-blue-500 underline">
              <?= $res->{'traversee_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/users/<?= $res->{'user_id'} ?>" class="text-blue-500 underline">
              <?= $res->{'user_id'} ?>
            </a>
          </td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/reservations/<?= $res->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/reservations/<?= $res->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/reservations/<?= $res->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>