<?php
include_once __DIR__ . '/../controllers/secteur.php';

$secteurs = Secteur::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Secteurs</h1>

  <div class="flex flex-col items-center gap-4">
    <?php foreach ($secteurs as $secteur) : ?>
      <a href="/secteur/<?= $secteur->id ?>" class="text-xl font-bold hover:text-blue-500"><?= $secteur->nom ?></a>
    <?php endforeach; ?>
  </div>
</div>