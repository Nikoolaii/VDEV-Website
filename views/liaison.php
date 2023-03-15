<?php
include_once __DIR__ . '/../controllers/utils.php';

$secteurId = $params['secteurId'];

$liaisons = getLiaisonsBySecteurId($secteurId);
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Liaisons</h1>

  <table class="w-full text-left">
    <thead class="border-b">
      <tr>
        <th>Code</th>
        <th class="border-l pl-2">Distance</th>
        <th class="border-l pl-2">Départ</th>
        <th class="border-l pl-2">Arrivée</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($liaisons as $liaison) : ?>
        <tr>
          <td><?= $liaison->id ?></td>
          <td class="border-l pl-2 py-2"><?= $liaison->distance ?></td>
          <td class="border-l pl-2 py-2"><?= $liaison->port_depart ?></td>
          <td class="border-l pl-2 py-2"><?= $liaison->port_arrivee ?></td>
          <td class="border-l pl-2 py-2">
            <a href="/liaison/<?= $liaison->id ?>" class="text-blue-500">Voir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="flex flex-col items-center gap-4">
  </div>
</div>