<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/equipement.php";

$id = $params['id'];

$equipement = Equipement::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST["nom"])) {
    header("Location: /admin/equipements/$id/edit");
    exit();
  }

  $nom = $_POST["nom"];

  Equipement::update($id, $nom);

  header("Location: /admin/equipements/$id");
} else {
  $equipement = Equipement::findOne($id);
  if (!$equipement) {
    header("Location: /admin/equipements");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de l'équipement <?= $_POST['id'] ?? $equipement->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? $equipement->{'nom'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/equipements/<?= $equipement->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>