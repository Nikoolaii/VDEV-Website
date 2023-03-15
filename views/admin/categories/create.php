<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/categorie.php";

$errorLettre = false;

if (isset($_POST['create'])) {
  if (!isset($_POST["lettre"]) || !isset($_POST["nom"])) {
    header("Location: /admin/categories/create");
    exit();
  }

  $lettre = $_POST["lettre"];
  $nom = $_POST["nom"];

  $findCategorie = Categorie::findOne($lettre);

  if ($findCategorie != false) {
    $errorLettre = true;
  } else {
    Categorie::create($lettre, $nom);

    header("Location: /admin/categories");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/categories" class="text-blue-500 underline">Toutes les catégories</a>

  <h1 class="text-3xl">Création d'une catégorie</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="lettre">Lettre</label>
      <input type="text" name="lettre" id="lettre" value="<?= $_POST['lettre'] ?? '' ?>" required maxlength="1">
      <?php if ($errorLettre) : ?>
        <p class="text-red-500">Cette lettre est déjà utilisée</p>
      <?php endif; ?>
    </div>

    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? '' ?>" required>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>