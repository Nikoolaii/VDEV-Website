<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-voyageur-equipement.php";

$idBateau = $params['idBateau'];
$idEquipement = $params['idEquipement'];

$bve = BateauVoyageurEquipement::findOne($idBateau, $idEquipement);
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/bateaux-voyageur-equipements" class="text-blue-500 underline">Tous les Bateaux-Voyageur-Equipements</a>

  <h1 class="text-3xl">Informations Bateaux <?= $bve->{'bateau_voyageur_id'} ?> - Equipement <?= $bve->{'equipement_id'} ?></h1>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/bateaux-voyageur-equipements/<?= $bve->{'bateau_voyageur_id'} ?>/<?= $bve->{'equipement_id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>