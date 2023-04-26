<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/traversee.php";
include_once __DIR__ . "/../../../controllers/bateau.php";
include_once __DIR__ . "/../../../controllers/liaison.php";

$bateaux = Bateau::findAll();
$liaisons = Liaison::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['date']) || !isset($_POST['bateau_id']) || !isset($_POST['liaison_id'])) {
    header("Location: /admin/traversees/create");
    exit();
  }

  $date = new DateTime($_POST['date']);
  $heure = $date->format('H:i:s');
  $bateauId = $_POST['bateau_id'];
  $liaisonId = $_POST['liaison_id'];

  Traversee::create($date, $heure, $bateauId, $liaisonId);

  header("Location: /admin/traversees");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/traversees" class="text-blue-500 underline">Toutes les traversées</a>

  <h1 class="text-3xl">Création d'une traversée</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="date">Date et heure</label>
      <input type="datetime-local" name="date" id="date" value="<?= $_POST['date'] ?? null ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="bateau_id">Id bateau</label>
      <select name="bateau_id" id="bateau_id" required>
        <option value="" disabled selected>Choisir un secteur</option>
        <?php foreach ($bateaux as $bateau) : ?>
          <option value="<?= $bateau->{'id'} ?>"><?= $bateau->{'id'} ?> - <?= $bateau->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="liaison_id">Id liaison</label>
      <select name="liaison_id" id="liaison_id" required>
        <option value="" disabled selected>Choisir une liaison</option>
        <?php foreach ($liaisons as $liaison) : ?>
          <option value="<?= $liaison->{'id'} ?>"><?= $liaison->{'id'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>