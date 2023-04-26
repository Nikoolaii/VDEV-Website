<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/reservations-types.php";

$idRes = $params['idReservation'];
$idType = $params['idType'];

$rt = ReservationsTypes::findOne($idRes, $idType);

if (isset($_POST["edit"])) {
  if (!isset($_POST["quantite"])) {
    header("Location: /admin/reservations-types/$idRes/$idType/edit");
    exit();
  }

  $quantite = $_POST["quantite"];

  ReservationsTypes::update($idRes, $idType, $quantite);

  header("Location: /admin/reservations-types/$idRes/$idType");
} else {
  $rt = ReservationsTypes::findOne($idRes, $idType);
  if (!$rt) {
    header("Location: /admin/reservations-types");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de réservation <?= $rt->{'reservation_id'} ?> type <?= $rt->{'type_id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="quantite">Quantité</label>
      <input type="number" name="quantite" id="quantite" value="<?= $rt->{'quantite'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/reservations-types/<?= $rt->{'reservation_id'} ?>/<?= $rt->{'type_id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>