<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison.php";
include_once __DIR__ . "/../../../controllers/secteur.php";
include_once __DIR__ . "/../../../controllers/port.php";

$secteurs = Secteur::findAll();
$ports = Port::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['distance']) || !isset($_POST['secteur_id']) || !isset($_POST['depart_id']) || !isset($_POST['arrivee_id'])) {
    header("Location: /admin/liaisons/create");
    exit();
  }

  $distance = $_POST["distance"];
  $secteurId = $_POST["secteur_id"];
  $departId = $_POST["depart_id"];
  $arriveeId = $_POST["arrivee_id"];

  Liaison::create($distance, null, $secteurId, $departId, $arriveeId);

  header("Location: /admin/liaisons");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/liaisons" class="text-blue-500 underline">Toutes les liaisons</a>

  <h1 class="text-3xl">Création d'une liaison</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="distance">Distance</label>
      <input type="number" name="distance" id="distance" value="<?= $_POST['distance'] ?? 0 ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="secteur_id">Id secteur</label>
      <select name="secteur_id" id="secteur_id" required>
        <option value="" disabled selected>Choisir un secteur</option>
        <?php foreach ($secteurs as $secteur) : ?>
          <option value="<?= $secteur->{'id'} ?>"><?= $secteur->{'id'} ?> - <?= $secteur->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="depart_id">Id port départ</label>
      <select name="depart_id" id="depart_id" required>
        <option value="" disabled selected>Choisir un port</option>
        <?php foreach ($ports as $port) : ?>
          <option value="<?= $port->{'id'} ?>"><?= $port->{'id'} ?> - <?= $port->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="arrivee_id">Id port arrivée</label>
      <select name="arrivee_id" id="arrivee_id" required>
        <option value="" disabled selected>Choisir un port</option>
        <?php foreach ($ports as $port) : ?>
          <option value="<?= $port->{'id'} ?>"><?= $port->{'id'} ?> - <?= $port->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>