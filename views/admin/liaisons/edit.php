<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison.php";

$id = $params['id'];

$liaison = Liaison::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST["distance"])) {
    header("Location: /admin/liaisons/$id/edit");
    exit();
  }

  $distance = $_POST["distance"];

  Liaison::update($id, $distance, $liaison->{'image_link'}, $liaison->{'secteur_id'}, $liaison->{'depart_id'}, $liaison->{'arrivee_id'});

  header("Location: /admin/liaisons/$id");
} else {
  $liaison = Liaison::findOne($id);
  if (!$liaison) {
    header("Location: /admin/liaisons");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de la liaison <?= $_POST['id'] ?? $liaison->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="distance">Distance</label>
      <input type="number" name="distance" id="distance" value="<?= $_POST['distance'] ?? $liaison->{'distance'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/liaisons/<?= $liaison->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>