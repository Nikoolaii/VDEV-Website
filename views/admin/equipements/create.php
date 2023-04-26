<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/equipement.php";

if (isset($_POST['create'])) {
  if (!isset($_POST["nom"])) {
    header("Location: /admin/equipements/create");
    exit();
  }

  $nom = $_POST["nom"];

  Equipement::create($nom);

  header("Location: /admin/equipements");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/equipements" class="text-blue-500 underline">Tous les équipements</a>

  <h1 class="text-3xl">Création d'un équipement</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? '' ?>" required>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>