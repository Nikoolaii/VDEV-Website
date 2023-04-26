<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/liaison-types-periodes.php";

$idLiaison = $params['idLiaison'];
$idType = $params['idType'];
$idPeriode = $params['idPeriode'];

$ltp = LiaisonTypesPeriodes::findOne($idLiaison, $idType, $idPeriode);

if (isset($_POST["edit"])) {
  if (!isset($_POST["tarif"])) {
    header("Location: /admin/liaisons-types-periodes/$idLiaison/$idType/$idPeriode/edit");
    exit();
  }

  $tarif = $_POST["tarif"];

  LiaisonTypesPeriodes::update($idLiaison, $idType, $idPeriode, $tarif);

  header("Location: /admin/liaisons-types-periodes/$idLiaison/$idType/$idPeriode");
} else {
  $ltp = LiaisonTypesPeriodes::findOne($idLiaison, $idType, $idPeriode);
  if (!$ltp) {
    header("Location: /admin/liaisons-types-periodes");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de liaison <?= $ltp->{'liaison_id'} ?> - type <?= $ltp->{'type_id'} ?> - période <?= $ltp->{'periode_id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="tarif">Tarif</label>
      <input type="number" name="tarif" id="tarif" value="<?= $ltp->{'tarif'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/liaisons-types-periodes/<?= $ltp->{'liaison_id'} ?>/<?= $ltp->{'type_id'} ?>/<?= $ltp->{'periode_id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>