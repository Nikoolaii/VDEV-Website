<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-categories.php";

$id = $params['id'];
$lettre = $params['lettre'];

$bc = BateauxCategories::findOne($id, $lettre);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/bateaux-categories" class="text-blue-500 underline">Tous les Bateaux-Catégories</a>

  <h1 class="text-3xl">Informations Bateaux <?= $bc->{'bateau_id'} ?> - Catégorie <?= $bc->{'categorie_lettre'} ?></h1>

  <p>Capacité max: <?= $bc->{'capacite_max'} ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/bateaux-categories/<?= $bc->{'bateau_id'} ?>/<?= $bc->{'categorie_lettre'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/bateaux-categories/<?= $bc->{'bateau_id'} ?>/<?= $bc->{'categorie_lettre'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>