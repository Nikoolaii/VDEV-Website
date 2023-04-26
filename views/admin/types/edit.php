<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/type.php";

$id = $params['id'];

$type = Type::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST["libelle"])) {
    header("Location: /admin/types/$id/edit");
    exit();
  }

  $libelle = $_POST["libelle"];

  Type::update($id, $libelle, $type->{'categorie_lettre'});

  header("Location: /admin/types/$id");
} else {
  $type = type::findOne($id);
  if (!$type) {
    header("Location: /admin/types");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour du type <?= $_POST['id'] ?? $type->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="libelle">Libelle</label>
      <input type="text" name="libelle" id="libelle" value="<?= $_POST['libelle'] ?? $type->{'libelle'} ?>" required>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/types/<?= $type->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>