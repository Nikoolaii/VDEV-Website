<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/traversee.php";

$id = $params['id'];

$traversee = traversee::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST["date"])) {
    header("Location: /admin/traversees/$id/edit");
    exit();
  }

  $date = new DateTime($_POST["date"]);
  $heure = $date->format("H:i:s");

  Traversee::update($id, $date, $heure, $traversee->{'bateau_id'}, $traversee->{'liaison_id'});

  header("Location: /admin/traversees/$id");
} else {
  $traversee = traversee::findOne($id);
  if (!$traversee) {
    header("Location: /admin/traversees");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de la traversée <?= $_POST['id'] ?? $traversee->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="date">Date et heure</label>
      <input type="datetime-local" name="date" id="date" value="<?= $_POST['date'] ?? ($traversee->{'date'} . ' ' . $traversee->{'heure'}) ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/traversees/<?= $traversee->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>