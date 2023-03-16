<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/categorie.php";

$lettre = $params['lettre'];

$categorie = Categorie::findOne($lettre);

if (isset($_POST["edit"])) {
  if (!isset($_POST["nom"])) {
    header("Location: /admin/categories/$lettre/edit");
    exit();
  }

  $nom = $_POST["nom"];

  Categorie::update($lettre, $nom);

  header("Location: /admin/categories/$lettre");
} else {
  $categorie = Categorie::findOne($lettre);
  if (!$categorie) {
    header("Location: /admin/categories");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de la catégorie <?= $_POST['lettre'] ?? $categorie->{'lettre'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? $categorie->{'nom'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/categories/<?= $categorie->{'lettre'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>