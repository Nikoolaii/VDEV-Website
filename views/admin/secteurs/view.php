<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/secteur.php";

$id = $params['id'];

$secteur = Secteur::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/secteurs" class="text-blue-500 underline">Tous les secteurs</a>

  <h1 class="text-3xl">Informations secteur <?= $secteur->{'id'} ?></h1>

  <p>Nom: <?= $secteur->{'nom'} ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/secteurs/<?= $secteur->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/secteurs/<?= $secteur->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>