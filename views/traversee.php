<?php
include_once __DIR__ . "/../database/data-source.php";
$resultSecteur = DataSource::collectSecteur();

$data = [];

for ($i = 0; $i < count($resultSecteur); $i++) {
  $data[]["secteur"] = $resultSecteur[$i];

  $resultLiaison = DataSource::collectLiaison($resultSecteur[$i]->{'id'});

  foreach ($resultLiaison as $valueLiaison) {
    $data[$i]["liaisons"][] = $valueLiaison;
  }
}
?>

<div class="w-full lg:h-auto text-center">
  <h1 class="text-2xl font-bold text-blue-500 m-4">Voici la liste de nos liaison</h1>

  <?php foreach ($data as $secteur) : ?>
    <p><?= $secteur['secteur']->{'nom'} ?></p>

    <?php foreach ($secteur['liaisons'] as $liaison) : ?>
      <div class="flex justify-center">
        <div class="rounded-lg shadow-lg bg-white max-w-sm">
          <img class="rounded-t-lg" src="<?= $liaison->{'imglink'} ?>" alt="" />

          <div class="p-6">
            <h5 class="text-gray-900 text-xl font-medium mb-2"><?= $liaison->{'depart'} ?> - <?= $liaison->{'arrivee'} ?></h5>
            <a href="/reservation"><button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Réserver</button></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <br><br>
  <?php endforeach; ?>
</div>