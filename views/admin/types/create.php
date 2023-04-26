<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/type.php";
include_once __DIR__ . "/../../../controllers/categorie.php";

$categories = Categorie::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['libelle']) || !isset($_POST['categorie_lettre'])) {
    header("Location: /admin/types/create");
    exit();
  }

  $libelle = $_POST['libelle'];
  $categorieLettre = $_POST['categorie_lettre'];

  Type::create($libelle, $categorieLettre);

  header("Location: /admin/types");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/types" class="text-blue-500 underline">Tous les types</a>

  <h1 class="text-3xl">Création d'un type</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="libelle">Libelle</label>
      <input type="text" name="libelle" id="libelle" value="<?= $_POST['libelle'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="categorie_lettre">Lettre catégorie</label>
      <select name="categorie_lettre" id="categorie_lettre" required>
        <option value="" disabled selected>Choisir une catégorie</option>
        <?php foreach ($categories as $cat) : ?>
          <option value="<?= $cat->{'lettre'} ?>"><?= $cat->{'lettre'} ?> - <?= $cat->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>