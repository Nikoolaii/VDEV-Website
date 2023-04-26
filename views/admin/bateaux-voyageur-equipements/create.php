<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-voyageur-equipement.php";
include_once __DIR__ . "/../../../controllers/bateau.php";
include_once __DIR__ . "/../../../controllers/equipement.php";

$error = false;

$bateaux = Bateau::findAll();
$equipements = Equipement::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['id_bateau']) || !isset($_POST["id_equipement"])) {
    header("Location: /admin/bateaux-categories/create");
    exit();
  }

  $idBateau = $_POST["id_bateau"];
  $idEquipement = $_POST["id_equipement"];

  $findBVE = BateauVoyageurEquipement::findOne($idBateau, $idEquipement);

  if ($findBVE != false) {
    $error = true;
  } else {
    BateauVoyageurEquipement::create($idBateau, $idEquipement);

    header("Location: /admin/bateaux-voyageur-equipements");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/bateaux-voyageur-equipements" class="text-blue-500 underline">Tous les bateaux-voyageur-equipements</a>

  <h1 class="text-3xl">Création d'un bateau-voyageur-equipement</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <?php if ($error) : ?>
      <p class="text-red-500">Ce bateau-voyageur-equipement a déjà été créé</p>
    <?php endif; ?>

    <div class="flex flex-col items-start">
      <label for="id_bateau">Id bateau</label>
      <select name="id_bateau" id="id_bateau" required>
        <option value="" disabled selected>Choisir un bateau</option>
        <?php foreach ($bateaux as $bateau) : ?>
          <option value="<?= $bateau->{'id'} ?>"><?= $bateau->{'id'} ?> - <?= $bateau->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="id_equipement">Id equipement</label>
      <select name="id_equipement" id="id_equipement" required>
        <option value="" disabled selected>Choisir un equipement</option>
        <?php foreach ($equipements as $equipement) : ?>
          <option value="<?= $equipement->{'id'} ?>"><?= $equipement->{'id'} ?> - <?= $equipement->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>