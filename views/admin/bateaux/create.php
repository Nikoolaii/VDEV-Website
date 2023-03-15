<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/bateau.php";

if (isset($_POST['create'])) {
  if (!isset($_POST["nom"])) {
    header("Location: /admin/bateaux/create");
    exit();
  }

  $type = $_POST["type"];
  $nom = $_POST["nom"];
  $longueur = floatval($_POST["longueur"]);
  $longueur = $longueur > 0 ? $longueur : null;
  $largeur = floatval($_POST["largeur"]);
  $longueur = $longueur > 0 ? $longueur : null;
  $vitesse = floatval($_POST["vitesse"]);
  $vitesse = $vitesse > 0 ? $vitesse : null;
  $poids_max = floatval($_POST["poids_max"]);
  $poids_max = $poids_max > 0 ? $poids_max : null;

  Bateau::create($nom, $type, $longueur, $largeur, $vitesse, $poids_max);

  header("Location: /admin/bateaux");
}
?>

<script src="/scripts/create-bateau.js"></script>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/bateaux" class="text-blue-500 underline">Tous les bateaux</a>

  <h1 class="text-3xl">Création d'un bateau</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="type">Type</label>
      <select name="type" id="type" onchange="onTypeChange()">
        <option value="Voyageur" selected>Voyageur</option>
        <option value="Fret">Fret</option>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?php $POST['nom'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="longueur">Longueur</label>
      <input type="number" name="longueur" id="longueur" value="<?php $POST['longueur'] ?? '' ?>">
    </div>

    <div class="flex flex-col items-start">
      <label for="largeur">Largeur</label>
      <input type="number" name="largeur" id="largeur" value="<?php $POST['largeur'] ?? '' ?>">
    </div>

    <div class="flex flex-col items-start">
      <label for="vitesse">Vitesse</label>
      <input type="number" name="vitesse" id="vitesse" value="<?php $POST['vitesse'] ?? '' ?>">
    </div>


    <div class="flex-col items-start hidden">
      <label for="poids_max">Poids Max</label>
      <input type="number" name="poids_max" id="poids_max" value="<?php $POST['poids_max'] ?? '' ?>">
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>