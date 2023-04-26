<?php
if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (is_null($user) || !$user->{'admin'}) {
  header("Location: /");
  exit();
}

$links = [
  [
    "name" => "Bateaux",
    "link" => "/admin/bateaux"
  ],
  [
    "name" => "Bateaux-Voyageur-Equipements",
    "link" => "/admin/bateaux-voyageur-equipements"
  ],
  [
    "name" => "Bateaux-Catégories",
    "link" => "/admin/bateaux-categories"
  ],
  [
    "name" => "Catégories",
    "link" => "/admin/categories"
  ],
  [
    "name" => "Équipements",
    "link" => "/admin/equipements"
  ],
  [
    "name" => "Liaisons-Types-Périodes",
    "link" => "/admin/liaisons-types-periodes"
  ],
  [
    "name" => "Liaisons",
    "link" => "/admin/liaisons"
  ],
  [
    "name" => "Périodes",
    "link" => "/admin/periodes"
  ],
  [
    "name" => "Ports",
    "link" => "/admin/ports"
  ],
  [
    "name" => "Réservations",
    "link" => "/admin/reservations"
  ],
  [
    "name" => "Réservations-Types",
    "link" => "/admin/reservations-types"
  ],
  [
    "name" => "Secteurs",
    "link" => "/admin/secteurs"
  ],
  [
    "name" => "Traversées",
    "link" => "/admin/traversees"
  ],
  [
    "name" => "Types",
    "link" => "/admin/types"
  ],
  [
    "name" => "Utilisateurs",
    "link" => "/admin/users"
  ]
];
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="py-4 text-3xl">Administration</h1>

  <ul class="list-disc list-inside">
    <?php foreach ($links as $link) : ?>
      <li>
        <a href="<?= $link["link"] ?>" class="text-blue-500"><?= $link["name"] ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>