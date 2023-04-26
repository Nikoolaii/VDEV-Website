<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison.php";

$id = $params['id'];

$liaison = Liaison::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/liaisons" class="text-blue-500 underline">Toutes les liaisons</a>

  <h1 class="text-3xl">Informations Liaison <?= $liaison->{'id'} ?></h1>

  <p>Distance: <?= $liaison->{'distance'} ?></p>
  <p>Image: <?= $liaison->{'image_link'} ?? 'Aucune' ?></p>
  <p>Secteur Id: <a href="/admin/secteurs/<?= $liaison->{'secteur_id'} ?>" class="text-blue-500 underline">
      <?= $liaison->{'secteur_id'} ?>
    </a></p>
  <p>Depart Id: <a href="/admin/ports/<?= $liaison->{'depart_id'} ?>" class="text-blue-500 underline">
      <?= $liaison->{'depart_id'} ?>
    </a></p>
  <p>Arrivee Id: <a href="/admin/ports/<?= $liaison->{'arrivee_id'} ?>" class="text-blue-500 underline">
      <?= $liaison->{'arrivee_id'} ?>
    </a></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/liaisons/<?= $liaison->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/liaisons/<?= $liaison->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>