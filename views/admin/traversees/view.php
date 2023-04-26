<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/traversee.php";

$id = $params['id'];

$traversee = traversee::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/traversees" class="text-blue-500 underline">Toutes les traversées</a>

  <h1 class="text-3xl">Informations traversée <?= $traversee->{'id'} ?></h1>

  <p>Date: <?= $traversee->{'date'} ?></p>
  <p>Heure: <?= $traversee->{'heure'} ?? 'Aucune' ?></p>
  <p>Bateau Id: <a href="/admin/bateaux/<?= $traversee->{'bateau_id'} ?>" class="text-blue-500 underline">
      <?= $traversee->{'bateau_id'} ?>
    </a>
  </p>
  <p>Liaison Id: <a href="/admin/liaisons/<?= $traversee->{'liaison_id'} ?>" class="text-blue-500 underline">
      <?= $traversee->{'liaison_id'} ?>
    </a>
  </p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/traversees/<?= $traversee->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/traversees/<?= $traversee->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>