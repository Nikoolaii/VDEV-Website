<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-voyageur-equipement.php";

$bateauxVoyageurEquipements = BateauVoyageurEquipement::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les Bateaux-Voyageur-Equipements</h1>

  <a href="/admin/bateaux-voyageur-equipements/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un Bateau-Voyageur-Equipement</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">Id bateau</th>
        <th class="py-2">Id Equipement</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bateauxVoyageurEquipements as $bve) : ?>
        <tr>
          <td>
            <a href="/admin/bateaux/<?= $bve->{'bateau_voyageur_id'} ?>" class="text-blue-500 underline">
              <?= $bve->{'bateau_voyageur_id'} ?>
            </a>
          </td>
          <td class="border-l px-4 py-2">
            <a href="/admin/equipements/<?= $bve->{'equipement_id'} ?>" class="text-blue-500 underline">
              <?= $bve->{'equipement_id'} ?>
            </a>
          </td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/bateaux-voyageur-equipements/<?= $bve->{'bateau_voyageur_id'} ?>/<?= $bve->{'equipement_id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/bateaux-voyageur-equipements/<?= $bve->{'bateau_voyageur_id'} ?>/<?= $bve->{'equipement_id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>