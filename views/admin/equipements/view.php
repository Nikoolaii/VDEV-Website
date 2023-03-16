<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/categorie.php";

$lettre = $params['lettre'];

$categorie = Categorie::findOne($lettre);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/categories" class="text-blue-500 underline">Toutes les catégories</a>

  <h1 class="text-3xl">Informations Catégorie <?= $categorie->{'lettre'} ?></h1>

  <p>Nom: <?= $categorie->{'nom'} ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/categories/<?= $categorie->{'lettre'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/categories/<?= $categorie->{'lettre'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>