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

if (isset($_POST['delete'])) {
  ReservationsTypes::delete($idRes, $idType);
  header('Location: /admin/reservations-types');
} else {
  $rt = ReservationsTypes::findOne($idRes, $idType);
  if (!$rt) {
    header('Location: /admin/reservations-types');
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <div class="flex flex-col items-center gap-4">
    <h1 class="text-3xl">Êtes-vous sûr de supprimer la réservation <?= $idRes ?> - type <?= $idType ?> ?</h1>

    <form method="post" class="flex flex-col items-center gap-2">
      <button type="submit" name="delete" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
      <a href="/admin/reservations-types/<?= $idRes ?>/<?= $idType ?>" class="bg-zinc-300 px-4 py-2 rounded">Annuler</a>
    </form>
  </div>
</div>