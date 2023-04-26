<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/periode.php";

$id = $params['id'];

$periode = Periode::findOne($id);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/periodes" class="text-blue-500 underline">Toutes les périodes</a>

  <h1 class="text-3xl">Informations Période <?= $periode->{'id'} ?></h1>

  <p>Debut: <?= $periode->{'debut'} ?></p>
  <p>Fin: <?= $periode->{'fin'} ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/periodes/<?= $periode->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/periodes/<?= $periode->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>