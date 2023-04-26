<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

include_once __DIR__ . "/../../../controllers/user.php";

$users = User::findAll();
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl mb-4">Les utilisateurs</h1>

  <a href="/admin/users/create" class="bg-blue-500 text-white px-4 py-2 rounded">Créer un utilisateur</a>

  <table class="w-full text-left mt-4">
    <thead class="border-b">
      <tr class="text-lg">
        <th class="py-2">ID</th>
        <th class="py-2">Email</th>
        <th class="py-2">Nom</th>
        <th class="py-2">Prénom</th>
        <th class="py-2">Admin</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?= $user->{'id'} ?></td>
          <td class="border-l px-4 py-2"><?= $user->{'email'} ?></td>
          <td class="border-l px-4 py-2"><?= $user->{'last_name'} ?></td>
          <td class="border-l px-4 py-2"><?= $user->{'first_name'} ?></td>
          <td class="border-l px-4 py-2"><?= $user->{'admin'} ? 'Oui' : 'Non' ?></td>

          <td class="border-l px-4 py-2 flex items-center gap-2">
            <a href="/admin/users/<?= $user->{'id'} ?>" class="text-blue-500">Voir</a>
            <a href="/admin/users/<?= $user->{'id'} ?>/edit" class="text-blue-500">Modifier</a>
            <a href="/admin/users/<?= $user->{'id'} ?>/delete" class="text-red-500">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>