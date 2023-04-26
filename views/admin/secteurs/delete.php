<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/secteur.php";

$id = $params['id'];

if (isset($_POST['delete'])) {
  Secteur::delete($id);
  header('Location: /admin/secteurs');
} else {
  $secteur = Secteur::findOne($id);
  if (!$secteur) {
    header('Location: /admin/secteurs');
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <div class="flex flex-col items-center gap-4">
    <h1 class="text-3xl">Êtes-vous sûr de supprimer le secteur <?= $id ?> ?</h1>

    <form method="post" class="flex flex-col items-center gap-2">
      <button type="submit" name="delete" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
      <a href="/admin/secteurs/<?= $id ?>" class="bg-zinc-300 px-4 py-2 rounded">Annuler</a>
    </form>
  </div>
</div>