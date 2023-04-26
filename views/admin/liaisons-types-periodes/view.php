<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison-types-periodes.php";

$idLiaison = $params['idLiaison'];
$idType = $params['idType'];
$idPeriode = $params['idPeriode'];

$ltp = LiaisonTypesPeriodes::findOne($idLiaison, $idType, $idPeriode);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/liaisons-types-periodes" class="text-blue-500 underline">Tous les Liaisons-Types-Périodes</a>

  <h1 class="text-3xl">Informations Liaison <?= $ltp->{'liaison_id'} ?> - Types <?= $ltp->{'type_id'} ?> - Période <?= $ltp->{'periode_id'} ?></h1>

  <p>Tarif: <?= $ltp->{'tarif'} ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/liaisons-types-periodes/<?= $ltp->{'liaison_id'} ?>/<?= $ltp->{'type_id'} ?>/<?= $ltp->{'periode_id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/liaisons-types-periodes/<?= $ltp->{'liaison_id'} ?>/<?= $ltp->{'type_id'} ?>/<?= $ltp->{'periode_id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>