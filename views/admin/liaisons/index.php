<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison.php";

$liaisons = Liaison::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les liaisons</h1>

  <a href="/admin/liaisons/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer une liaison</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Distance</th>
        <th class="py-2">Image</th>
        <th class="py-2">Secteur Id</th>
        <th class="py-2">Depart Id</th>
        <th class="py-2">Arrivee Id</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($liaisons as $liaison) : ?>
        <tr>
          <td><?= $liaison->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $liaison->{'distance'} ?></td>
          <td class="border-l px-4 py-2"><?= $liaison->{'image_link'} ?? 'Aucune' ?></td>
          <td class="border-l px-4 py-2">
            <a href="/admin/secteurs/<?= $liaison->{'secteur_id'} ?>" class="text-blue-500 underline">
              <?= $liaison->{'secteur_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/ports/<?= $liaison->{'depart_id'} ?>" class="text-blue-500 underline">
              <?= $liaison->{'depart_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/ports/<?= $liaison->{'arrivee_id'} ?>" class="text-blue-500 underline">
              <?= $liaison->{'arrivee_id'} ?>
            </a>
          </td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/liaisons/<?= $liaison->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/liaisons/<?= $liaison->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/liaisons/<?= $liaison->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>