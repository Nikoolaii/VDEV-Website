<?php
include_once __DIR__ . '/../controllers/utils.php';

$liaisonId = $params['liaisonId'];
$date = isset($_GET['date']) ? new DateTime($_GET['date']) : new DateTime();

$liaison = getLiaisonWithPorts($liaisonId);
$categories = getCategoriesOfLiaison($liaisonId, $date);
$traversees = getTraverseesWithBateau($liaisonId, $date);
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="py-4 text-3xl">Horaires pour la liaison <?= $liaison->port_depart ?> - <?= $liaison->port_arrivee ?></h1>

  <form method="get" class="flex items-center gap-2 my-3">
    <p>Sélectionnez votre date</p>

    <input type="date" name="date" value="<?= $date->format('Y-m-d') ?>">

    <button type="submit" class="py-1 px-3 bg-zinc-100 border border-black">Valider</button>
  </form>

  <table class="w-full text-left">
    <thead class="border-b">
      <tr class="text-xl border-b">
        <th colspan="3" class="py-2">Traversée</th>
        <th colspan="<?= sizeof($categories) + 1; ?>" class="py-2">Places disponibles</th>
      </tr>
      <tr>
        <th>Numéro</th>
        <th class="border-l pl-2">Heure</th>
        <th class="border-l pl-2">Bateau</th>
        <?php foreach ($categories as $categorie) : ?>
          <th class="border-l pl-2">
            <div class="flex flex-col items-center">
              <span>
                <?= $categorie->lettre ?>
              </span>
              <span>
                <?= $categorie->nom ?>
              </span>
            </div>
          </th>
        <?php endforeach; ?>
        <th class="border-l"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($traversees as $traversee) : ?>
        <tr>

          <td><?= $traversee->id ?></td>
          <td class="border-l pl-2 py-2"><?= $traversee->heure ?></td>
          <td class="border-l pl-2 py-2"><?= $traversee->bateau ?></td>
          <?php foreach ($categories as $cat) : ?>
            <td class="border-l pl-2 py-2">
              <?= getPlacesForTraverseeCategorie($traversee->id, $cat->lettre); ?>
            </td>
          <?php endforeach; ?>
          <td class="border-l pl-2 py-2">
            <a href="/traversee/<?= $traversee->id ?>" class="text-blue-500">Réserver</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>