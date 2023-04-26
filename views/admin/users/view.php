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
?>

<div class="mx-auto max-w-6xl w-full">
  <a href="/admin/users" class="text-blue-500 underline">Tous les utilisateurs</a>

  <h1 class="text-3xl">Informations utilisateur <?= $user->{'id'} ?></h1>

  <p>Email: <?= $user->{'email'} ?></p>
  <p>Nom: <?= $user->{'last_name'} ?></p>
  <p>Prénom: <?= $user->{'first_name'} ?></p>
  <p>Admin: <?= $user->{'admin'} ? 'Oui' : 'Non' ?></p>

  <div class="flex items-center gap-2 mt-4">
    <a href="/admin/users/<?= $user->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
    <a href="/admin/users/<?= $user->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
  </div>
</div>