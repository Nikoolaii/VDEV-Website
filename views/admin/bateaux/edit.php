<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateau.php";

$id = $params['id'];

$bateau = Bateau::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST["nom"])) {
    header("Location: /admin/bateaux/$id/edit");
    exit();
  }

  $nom = $_POST["nom"];
  $longueur = floatval($_POST["longueur"]);
  $longueur = $longueur > 0 ? $longueur : null;
  $largeur = floatval($_POST["largeur"]);
  $longueur = $longueur > 0 ? $longueur : null;
  $vitesse = floatval($_POST["vitesse"]);
  $vitesse = $vitesse > 0 ? $vitesse : null;
  $poids_max = floatval($_POST["poids_max"]);
  $poids_max = $poids_max > 0 ? $poids_max : null;

  Bateau::update($id, $nom, $longueur, $largeur, $vitesse, $poids_max);

  header("Location: /admin/bateaux/$id");
} else {
  $bateau = Bateau::findOne($id);
  if (!$bateau) {
    header("Location: /admin/bateaux");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour du bateau N°<?= $bateau->{'id'} ?></h1>

  <p>Type de bateau: <?= $bateau->{'type'} ?></p>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? $bateau->{'nom'} ?>" required>
    </div>

    <?php if ($bateau->{'type'} == 'Voyageur') : ?>
      <div class="flex flex-col items-start">
        <label for="longueur">Longueur</label>
        <input type="number" name="longueur" id="longueur" value="<?= $_POST['longueur'] ?? $bateau->{'longueur'} ?>">
      </div>

      <div class="flex flex-col items-start">
        <label for="largeur">Largeur</label>
        <input type="number" name="largeur" id="largeur" value="<?= $_POST['largeur'] ?? $bateau->{'largeur'} ?>">
      </div>

      <div class="flex flex-col items-start">
        <label for="vitesse">Vitesse</label>
        <input type="number" name="vitesse" id="vitesse" value="<?= $_POST['vitesse'] ?? $bateau->{'vitesse'} ?>">
      </div>
    <?php endif; ?>

    <?php if ($bateau->{'type'} == 'Fret') : ?>
      <div class="flex flex-col items-start">
        <label for="poids_max">Poids Max</label>
        <input type="number" name="poids_max" id="poids_max" value="<?= $_POST['poids_max'] ?? $bateau->{'poids_max'} ?>">
      </div>
    <?php endif; ?>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/bateaux/<?= $bateau->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>