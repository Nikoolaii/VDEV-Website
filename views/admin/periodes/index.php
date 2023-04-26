<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/periode.php";

$periodes = Periode::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les périodes</h1>

  <a href="/admin/periodes/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer une période</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Début</th>
        <th class="py-2">Fin</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($periodes as $periode) : ?>
        <tr>
          <td><?= $periode->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $periode->{'debut'} ?></td>
          <td class="border-l px-4 py-2"><?= $periode->{'fin'} ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/periodes/<?= $periode->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/periodes/<?= $periode->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/periodes/<?= $periode->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>