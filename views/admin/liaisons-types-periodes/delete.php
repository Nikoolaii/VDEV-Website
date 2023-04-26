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

if (isset($_POST['delete'])) {
  LiaisonTypesPeriodes::delete($idLiaison, $idType, $idPeriode);
  header('Location: /admin/liaisons-types-periodes');
} else {
  $ltp = LiaisonTypesPeriodes::findOne($idLiaison, $idType, $idPeriode);
  if (!$ltp) {
    header('Location: /admin/liaisons-types-periodes');
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <div class="flex flex-col items-center gap-4">
    <h1 class="text-3xl">Êtes-vous sûr de supprimer la liaison <?= $idLiaison ?> - type <?= $idType ?> - période <?= $idPeriode ?> ?</h1>

    <form method="post" class="flex flex-col items-center gap-2">
      <button type="submit" name="delete" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
      <a href="/admin/liaisons-types-periodes/<?= $idLiaison ?>/<?= $idType ?>/<?= $idPeriode ?>" class="bg-zinc-300 px-4 py-2 rounded">Annuler</a>
    </form>
  </div>
</div>