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

if (isset($_POST['create'])) {
  if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email']) || !isset($_POST['adresse']) || !isset($_POST['code_postal']) || !isset($_POST['ville']) || !isset($_POST['traversee_id']) || !isset($_POST['user_id'])) {
    header("Location: /admin/reservations/create");
    exit();
  }

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $adresse = $_POST['adresse'];
  $codePostal = $_POST['code_postal'];
  $ville = $_POST['ville'];
  $traverseeId = $_POST['traversee_id'];
  $userId = $_POST['user_id'];

  Reservation::create($nom, $prenom, $email, $adresse, $codePostal, $ville, $traverseeId, $userId);

  header("Location: /admin/reservations");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/reservations" class="text-blue-500 underline">Toutes les réservations</a>

  <h1 class="text-3xl">Création d'une réservation</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" value="<?= $_POST['adresse'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="code_postal">Code postal</label>
      <input type="text" name="code_postal" id="code_postal" value="<?= $_POST['code_postal'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" value="<?= $_POST['ville'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="traversee_id">Id traversee</label>
      <select name="traversee_id" id="traversee_id" required>
        <option value="" disabled selected>Choisir une traversée</option>
        <?php foreach ($traversees as $traversee) : ?>
          <option value="<?= $traversee->{'id'} ?>"><?= $traversee->{'id'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="user_id">Id utilisateur</label>
      <select name="user_id" id="user_id" required>
        <option value="" disabled selected>Choisir un utilisateur</option>
        <?php foreach ($users as $user) : ?>
          <option value="<?= $user->{'id'} ?>"><?= $user->{'id'} ?> - <?= $user->{'last_name'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>