<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison-types-periodes.php";

$ltps = LiaisonTypesPeriodes::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les Liaisons-Types-Périodes</h1>

  <a href="/admin/liaisons-types-periodes/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un Liaison-Type-Période</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">Id Liaison</th>
        <th class="py-2">Id Type</th>
        <th class="py-2">Id Période</th>
        <th class="py-2">Tarif</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ltps as $ltp) : ?>
        <tr>
          <td>
            <a href="/admin/liaisons/<?= $ltp->{'liaison_id'} ?>" class="text-blue-500 underline">
              <?= $ltp->{'liaison_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/types/<?= $ltp->{'type_id'} ?>" class="text-blue-500 underline">
              <?= $ltp->{'type_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/periodes/<?= $ltp->{'periode_id'} ?>" class="text-blue-500 underline">
              <?= $ltp->{'periode_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2"><?= $ltp->{'tarif'} ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/liaisons-types-periodes/<?= $ltp->{'liaison_id'} ?>/<?= $ltp->{'type_id'} ?>/<?= $ltp->{'periode_id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/liaisons-types-periodes/<?= $ltp->{'liaison_id'} ?>/<?= $ltp->{'type_id'} ?>/<?= $ltp->{'periode_id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/liaisons-types-periodes/<?= $ltp->{'liaison_id'} ?>/<?= $ltp->{'type_id'} ?>/<?= $ltp->{'periode_id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>