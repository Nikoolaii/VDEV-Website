<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/secteur.php";

$secteurs = Secteur::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les secteurs</h1>

  <a href="/admin/secteurs/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un secteur</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Nom</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($secteurs as $secteur) : ?>
        <tr>
          <td><?= $secteur->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $secteur->{'nom'} ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/secteurs/<?= $secteur->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/secteurs/<?= $secteur->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/secteurs/<?= $secteur->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>