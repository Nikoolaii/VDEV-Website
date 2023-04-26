<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/traversee.php";

$traversees = Traversee::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les traversées</h1>

  <a href="/admin/traversees/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer une traversée</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Date</th>
        <th class="py-2">Heure</th>
        <th class="py-2">Bateau Id</th>
        <th class="py-2">Liaison Id</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($traversees as $traversee) : ?>
        <tr>
          <td><?= $traversee->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $traversee->{'date'} ?></td>
          <td class="border-l px-4 py-2"><?= $traversee->{'heure'} ?? 'Aucune' ?></td>
          <td class="border-l px-4 py-2">
            <a href="/admin/bateaux/<?= $traversee->{'bateau_id'} ?>" class="text-blue-500 underline">
              <?= $traversee->{'bateau_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/liaisons/<?= $traversee->{'liaison_id'} ?>" class="text-blue-500 underline">
              <?= $traversee->{'liaison_id'} ?>
            </a>
          </td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/traversees/<?= $traversee->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/traversees/<?= $traversee->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/traversees/<?= $traversee->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>