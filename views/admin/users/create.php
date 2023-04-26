<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/user.php";

if (isset($_POST['create'])) {
  if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email']) || !isset($_POST['password'])) {
    header("Location: /admin/users/create");
    exit();
  }

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $admin = isset($_POST['admin']);

  User::create($email, $password, $prenom, $nom, $admin);

  header("Location: /admin/users");
}
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/users" class="text-blue-500 underline">Tous les utilisateurs</a>

  <h1 class="text-3xl">Création d'un utilisateur</h1>

  <form method="post" class="my-4 flex flex-col items-start gap-4">
    <div class="flex flex-col items-start">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="password">Mot de passe</label>
      <input type="text" name="password" id="password" value="<?= $_POST['password'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?? '' ?>" required>
    </div>

    <div class="flex flex-col items-start">
      <label for="admin">Admin</label>
      <input type="checkbox" name="admin" id="admin" value="<?= $_POST['admin'] ?? '' ?>">
    </div>

    <button type="submit" name="create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
  </form>
</div>