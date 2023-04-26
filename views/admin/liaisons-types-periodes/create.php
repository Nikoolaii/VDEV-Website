<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison-types-periodes.php";
include_once __DIR__ . "/../../../controllers/liaison.php";
include_once __DIR__ . "/../../../controllers/type.php";
include_once __DIR__ . "/../../../controllers/periode.php";

$error = false;

$liaisons = Liaison::findAll();
$types = Type::findAll();
$periodes = Periode::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['id_liaison']) || !isset($_POST['id_type']) || !isset($_POST['id_periode']) || !isset($_POST['tarif'])) {
    header("Location: /admin/liaisons-types-periodes/create");
    exit();
  }

  $idLiaison = $_POST['id_liaison'];
  $idType = $_POST['id_type'];
  $idPeriode = $_POST['id_periode'];
  $tarif = $_POST['tarif'];

  $findLTP = LiaisonTypesPeriodes::findOne($idLiaison, $idType, $idPeriode);

  if ($findLTP != false) {
    $error = true;
  } else {
    LiaisonTypesPeriodes::create($idLiaison, $idType, $idPeriode, $tarif);

    header("Location: /admin/liaisons-types-periodes");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/liaisons-types-periodes" class="text-blue-500 underline">Tous les liaisons-types-periodes</a>

  <h1 class="text-3xl">Création d'un liaison-type-periode</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <?php if ($error) : ?>
      <p class="text-red-500">Ce liaison-type-periode a déjà été créé</p>
    <?php endif; ?>

    <div class="flex flex-col items-start">
      <label for="id_liaison">Id liaison</label>
      <select name="id_liaison" id="id_liaison" required>
        <option value="" disabled selected>Choisir une liaison</option>
        <?php foreach ($liaisons as $liaison) : ?>
          <option value="<?= $liaison->{'id'} ?>"><?= $liaison->{'id'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="id_type">Id type</label>
      <select name="id_type" id="id_type" required>
        <option value="" disabled selected>Choisir un type</option>
        <?php foreach ($types as $type) : ?>
          <option value="<?= $type->{'id'} ?>"><?= $type->{'id'} ?> - <?= $type->{'libelle'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="id_periode">Id période</label>
      <select name="id_periode" id="id_periode" required>
        <option value="" disabled selected>Choisir une période</option>
        <?php foreach ($periodes as $periode) : ?>
          <option value="<?= $periode->{'id'} ?>"><?= $periode->{'id'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="tarif">Tarif</label>
      <input type="number" name="tarif" id="tarif" value="<?= $_POST['tarif'] ?? 0 ?>" required min="0">
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>