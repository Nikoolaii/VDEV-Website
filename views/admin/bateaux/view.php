<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateau.php";

$id = $params['id'];

$bateau = Bateau::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/bateaux" class="text-blue-500 underline">Tous les bateaux</a>

  <h1 class="text-3xl">Informations Bateau N°<?= $bateau->{'id'} ?></h1>

  <p>Nom: <?= $bateau->{'nom'} ?></p>
  <p>Type: <?= $bateau->{'type'} ?></p>

  <?php if ($bateau->{'type'} == 'Voyageur') : ?>
    <p>Longueur: <?= $bateau->{'longueur'} ?? 'Aucune' ?></p>
    <p>Largeur: <?= $bateau->{'largeur'} ?? 'Aucune' ?></p>
    <p>Vitesse: <?= $bateau->{'vitesse'} ?? 'Aucune' ?></p>
  <?php endif; ?>

  <?php if ($bateau->{'type'} == 'Fret') : ?>
    <p>Poids Max: <?= $bateau->{'poids_max'} ?? 'Aucun' ?></p>
  <?php endif; ?>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/bateaux/<?= $bateau->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/bateaux/<?= $bateau->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>