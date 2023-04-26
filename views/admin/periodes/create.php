<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/periode.php";

if (isset($_POST['create'])) {
  if (!isset($_POST['debut']) || !isset($_POST['fin'])) {
    header("Location: /admin/periodes/create");
    exit();
  }

  $debut = new DateTime($_POST['debut']);
  $fin = new DateTime($_POST['fin']);

  Periode::create($debut, $fin);

  header("Location: /admin/periodes");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/periodes" class="text-blue-500 underline">Toutes les périodes</a>

  <h1 class="text-3xl">Création d'une période</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="debut">Début</label>
      <input type="date" name="debut" id="debut" value="<?= $_POST['debut'] ?? null ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="fin">Fin</label>
      <input type="date" name="fin" id="fin" value="<?= $_POST['fin'] ?? null ?>" required>
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>