<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/user.php";

$id = $params['id'];

$user = User::findOne($id);

if (isset($_POST["edit"])) {
  if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header("Location: /admin/users/$id/edit");
    exit();
  }

  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $password = isset($_POST["password"]) ? $_POST["password"] : null;
  $admin = isset($_POST["admin"]);

  User::update($id, $email, $password, $prenom, $nom, $admin);

  header("Location: /admin/users/$id");
} else {
  $user = user::findOne($id);
  if (!$user) {
    header("Location: /admin/users");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Mise à jour de l'utilisateur <?= $_POST['id'] ?? $user->{'id'} ?></h1>

  <form method="post" class="my-4 flex flex-col gap-4">
    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? $user->{'last_name'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?? $user->{'first_name'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? $user->{'email'} ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="password">Mot de passe</label>
      <input type="text" name="password" id="password" value="<?= $_POST['password'] ?? '' ?>">
    </div>

    <div class="flex flex-col items-start">
      <label for="admin">Admin</label>
      <input type="checkbox" name="admin" id="admin" value="<?= $_POST['admin'] ?? '' ?>" <?= $user->{'admin'} ? 'checked' : '' ?>>
    </div>

    <div class="flex items-center gap-2">
      <button type="submit" name="edit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
      <a href="/admin/users/<?= $user->{'id'} ?>" class="text-blue-500">Annuler</a>
    </div>
  </form>
</div>