<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/type.php";

$types = Type::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les types</h1>

  <a href="/admin/types/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un type</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Libelle</th>
        <th class="py-2">Catégorie Lettre</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($types as $type) : ?>
        <tr>
          <td><?= $type->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $type->{'libelle'} ?></td>
          <td class="border-l px-4 py-2">
            <a href="/admin/categories/<?= $type->{'categorie_lettre'} ?>" class="text-blue-500 underline">
              <?= $type->{'categorie_lettre'} ?>
            </a>
          </td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/types/<?= $type->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/types/<?= $type->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/types/<?= $type->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>