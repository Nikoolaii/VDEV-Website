<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateau.php";

$bateaux = Bateau::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les bateaux</h1>

  <a href="/admin/bateaux/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un bateau</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">Id</th>
        <th class="py-2">Nom</th>
        <th class="py-2">Type</th>
        <th class="py-2">Longueur</th>
        <th class="py-2">Largeur</th>
        <th class="py-2">Vitesse</th>
        <th class="py-2">Poids Max</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bateaux as $bateau) : ?>
        <tr>
          <td><?= $bateau->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $bateau->{'nom'} ?></td>
          <td class="border-l px-4 py-2"><?= $bateau->{'type'} ?></td>
          <td class="border-l px-4 py-2"><?= $bateau->{'longueur'} ?? 'X' ?></td>
          <td class="border-l px-4 py-2"><?= $bateau->{'largeur'} ?? 'X' ?></td>
          <td class="border-l px-4 py-2"><?= $bateau->{'vitesse'} ?? 'X' ?></td>
          <td class="border-l px-4 py-2"><?= $bateau->{'poids_max'} ?? 'X' ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/bateaux/<?= $bateau->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/bateaux/<?= $bateau->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/bateaux/<?= $bateau->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>