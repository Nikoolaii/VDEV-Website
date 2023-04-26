<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/type.php";

$id = $params['id'];

$type = Type::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/types" class="text-blue-500 underline">Tous les types</a>

  <h1 class="text-3xl">Informations type <?= $type->{'id'} ?></h1>

  <p>Libelle: <?= $type->{'libelle'} ?></p>
  <p>Catégorie Lettre: <a href="/admin/categories/<?= $type->{'categorie_lettre'} ?>" class="text-blue-500 underline">
      <?= $type->{'categorie_lettre'} ?>
    </a>
  </p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/types/<?= $type->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/types/<?= $type->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>