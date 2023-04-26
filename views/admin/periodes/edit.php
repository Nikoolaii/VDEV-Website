<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/periode.php";

$id = $params['id'];

$periode = Periode::findOne($id);

$debut = new DateTime($_POST['debut'] ?? $periode->{'debut'});
$fin = new DateTime($_POST['fin'] ?? $periode->{'fin'});

if (isset($_POST["edit"])) {
  if (!isset($_POST["debut"]) || !isset($_POST["fin"])) {
    header("Location: /admin/periodes/$id/edit");
    exit();
  }

  $debut = new DateTime($_POST["debut"]);
  $fin = new DateTime($_POST["fin"]);

  Periode::update($id, $debut, $fin);

  header("Location: /admin/periodes/$id");
} else {
  $periode = Periode::findOne($id);
  if (!$periode) {
    header("Location: /admin/periodes");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de la période <?= $_POST['id'] ?? $periode->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="debut">Début</label>
      <input type="date" name="debut" id="debut" value="<?= $debut->format('Y-m-d') ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="fin">Fin</label>
      <input type="date" name="fin" id="fin" value="<?= $fin->format('Y-m-d') ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/periodes/<?= $periode->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>