<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-categories.php";

$bateauxCategories = BateauxCategories::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les Bateaux-Catégories</h1>

  <a href="/admin/bateaux-categories/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un Bateau-Catégorie</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">Id bateau</th>
        <th class="py-2">Lettre catégorie</th>
        <th class="py-2">Capacité max</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bateauxCategories as $bc) : ?>
        <tr>
          <td>
            <a href="/admin/bateaux/<?= $bc->{'bateau_id'} ?>" class="text-blue-500 underline">
              <?= $bc->{'bateau_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/categories/<?= $bc->{'categorie_lettre'} ?>" class="text-blue-500 underline">
              <?= $bc->{'categorie_lettre'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2"><?= $bc->{'capacite_max'} ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/bateaux-categories/<?= $bc->{'bateau_id'} ?>/<?= $bc->{'categorie_lettre'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/bateaux-categories/<?= $bc->{'bateau_id'} ?>/<?= $bc->{'categorie_lettre'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/bateaux-categories/<?= $bc->{'bateau_id'} ?>/<?= $bc->{'categorie_lettre'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>