<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/equipement.php";

$errorLettre = false;

if (isset($_POST['create'])) {
  if (!isset($_POST["id"]) || !isset($_POST["nom"]) || !isset($_POST("bateauVoyageurId"))) {
    header("Location: /admin/equipements/create");
    exit();
  }

  $id = $_POST["id"];
  $nom = $_POST["nom"];
  $bateauVoyageurId = $_POST("bateauVoyageurId");

  $findEquipement = Equipement::findOne($id);

  if ($findEquipement != false) {
    $errorLettre = true;
  } else {
    Equipement::create($lettre, $nom);

    header("Location: /admin/categories");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/categories" class="text-blue-500 underline">Tous les équipements</a>

  <h1 class="text-3xl">Création d'un équipement</h1>

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