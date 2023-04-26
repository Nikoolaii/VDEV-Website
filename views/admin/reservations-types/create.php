<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservations-types.php";
include_once __DIR__ . "/../../../controllers/reservation.php";
include_once __DIR__ . "/../../../controllers/type.php";

$error = false;

$reservations = Reservation::findAll();
$types = Type::findAll();

if (isset($_POST['create'])) {
  if (!isset($_POST['id_reservation']) || !isset($_POST["id_type"]) || !isset($_POST["quantite"])) {
    header("Location: /admin/reservations-types/create");
    exit();
  }

  $idReservation = $_POST['id_reservation'];
  $idType = $_POST['id_type'];
  $quantite = $_POST['quantite'];

  $findRT = ReservationsTypes::findOne($idReservation, $idType);

  if ($findRT != false) {
    $error = true;
  } else {
    ReservationsTypes::create($idReservation, $idType, $quantite);

    header("Location: /admin/reservations-types");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/reservations-types" class="text-blue-500 underline">Tous les réservations-types</a>

  <h1 class="text-3xl">Création d'un réservation-type</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <?php if ($error) : ?>
      <p class="text-red-500">Ce réservation-type a déjà été créé</p>
    <?php endif; ?>

    <div class="flex flex-col items-start">
      <label for="id_reservation">Id Réservation</label>
      <select name="id_reservation" id="id_reservation" required>
        <option value="" disabled selected>Choisir une réservation</option>
        <?php foreach ($reservations as $reservation) : ?>
          <option value="<?= $reservation->{'id'} ?>"><?= $reservation->{'id'} ?> - <?= $reservation->{'nom'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="id_type">Id Type</label>
      <select name="id_type" id="id_type" required>
        <option value="" disabled selected>Choisir une catégorie</option>
        <?php foreach ($types as $type) : ?>
          <option value="<?= $type->{'id'} ?>"><?= $type->{'id'} ?> - <?= $type->{'libelle'} ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="flex flex-col items-start">
      <label for="quantite">Quantité</label>
      <input type="number" name="quantite" id="quantite" value="<?= $_POST['quantite'] ?? 0 ?>" required min="0">
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>