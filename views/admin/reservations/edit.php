<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservation.php";
include_once __DIR__ . "/../../../controllers/traversee.php";
include_once __DIR__ . "/../../../controllers/user.php";

$traversees = Traversee::findAll();
$users = User::findAll();

$id = $params['id'];

$res = Reservation::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email']) || !isset($_POST['adresse']) || !isset($_POST['code_postal']) || !isset($_POST['ville'])) {
    header("Location: /admin/reservations/$id/edit");
    exit();
  }

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $adresse = $_POST['adresse'];
  $codePostal = $_POST['code_postal'];
  $ville = $_POST['ville'];

  Reservation::update($id, $nom, $prenom, $email, $adresse, $codePostal, $ville, $res->{'traversee_id'}, $res->{'user_id'});

  header("Location: /admin/reservations/$id");
} else {
  $res = Reservation::findOne($id);
  if (!$res) {
    header("Location: /admin/reservations");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de la réservation <?= $_POST['id'] ?? $res->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? $res->{'nom'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?? $res->{'prenom'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? $res->{'email'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" value="<?= $_POST['adresse'] ?? $res->{'adresse'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="code_postal">Code postal</label>
      <input type="text" name="code_postal" id="code_postal" value="<?= $_POST['code_postal'] ?? $res->{'code_postal'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" value="<?= $_POST['ville'] ?? $res->{'ville'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/reservations/<?= $res->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>