<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateaux-categories.php";
include_once __DIR__ . "/../../../controllers/categorie.php";
include_once __DIR__ . "/../../../controllers/bateau.php";

$error = false;

$categories = Categorie::findAll();
$bateaux = Bateau::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['id']) || !isset($_POST["lettre"]) || !isset($_POST["capacite_max"])) {
    header("Location: /admin/bateaux-categories/create");
    exit();
  }

  $id = $_POST["id"];
  $lettre = $_POST["lettre"];
  $capaciteMax = $_POST["capacite_max"];

  $findBC = BateauxCategories::findOne($id, $lettre);

  if ($findBC != false) {
    $error = true;
  } else {
    BateauxCategories::create($id, $lettre, $capaciteMax);

    header("Location: /admin/bateaux-categories");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/bateaux-categories" class="text-blue-500 underline">Tous les bateaux-catégories</a>

  <h1 class="text-3xl">Création d'un bateau-catégorie</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <?php if ($error) : ?>
      <p class="text-red-500">Ce bateau-catégorie a déjà été créé</p>
    <?php endif; ?>

    <div class="flex flex-col items-start">
      <label for="id">Id bateau</label>
      <select name="id" id="id" required>
        <option value="" disabled selected>Choisir un bateau</option>
        <?php foreach ($bateaux as $bateau) : ?>
          <option value="<?= $bateau->{'id'} ?>"><?= $bateau->{'id'} ?> - <?= $bateau->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="lettre">Lettre catégorie</label>
      <select name="lettre" id="lettre" required>
        <option value="" disabled selected>Choisir une catégorie</option>
        <?php foreach ($categories as $categorie) : ?>
          <option value="<?= $categorie->{'lettre'} ?>"><?= $categorie->{'lettre'} ?> - <?= $categorie->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="capacite_max">Capacité max</label>
      <input type="number" name="capacite_max" id="capacite_max" value="<?= $_POST['capacite_max'] ?? '' ?>" required min="0">
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>