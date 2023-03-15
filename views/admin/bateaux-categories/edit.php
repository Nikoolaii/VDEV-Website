<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-categories.php";

$id = $params['id'];
$lettre = $params['lettre'];

$bc = BateauxCategories::findOne($id, $lettre);

if (isset($_POST["edit"])) {
  if (!isset($_POST["capacite_max"])) {
    header("Location: /admin/bateaux-categories/$id/$lettre/edit");
    exit();
  }

  $capacite_max = $_POST["capacite_max"];

  BateauxCategories::update($id, $lettre, $capacite_max);

  header("Location: /admin/bateaux-categories/$id/$lettre");
} else {
  $bc = BateauxCategories::findOne($id, $lettre);
  if (!$bc) {
    header("Location: /admin/categories");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de bateau <?= $bc->{'bateau_id'} ?> catégorie <?= $bc->{'categorie_lettre'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="capacite_max">Capacité max</label>
      <input type="number" name="capacite_max" id="capacite_max" value="<?= $bc->{'capacite_max'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/bateaux-categories/<?= $bc->{'bateau_id'} ?>/<?= $bc->{'categorie_lettre'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>