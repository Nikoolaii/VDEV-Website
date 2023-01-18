<?php
$links = [
  [
    "name" => "Reservation",
    "link" => "/reservation"
  ]
];

include_once "./controllers/user.php";
?>

<script src="/scripts/appbar.js"></script>

<div class="p-3 w-full fixed inset-x-0 top-0 backdrop-blur-md z-40">
  <div class="max-w-6xl mx-auto flex items-center justify-between gap-3 sm:gap-5">
    <a href="/" class="flex items-center gap-1 text-2xl cursor-pointer focus-visible:outline-none group">
      <img src="/assets/logo.svg" alt="Logo" class="w-10 group-hover:-rotate-12 group-focus-visible:-rotate-12 transition-transform duration-300">
      <h1 class="font-bold text-blue-500">MarieTeam</h1>
    </a>

    <div class="hidden md:flex items-center gap-4">
      <?php foreach ($links as $link) : ?>
        <a href="<?= $link["link"] ?>" class="hover:underline focus-visible:outline-none focus-visible:underline"><?= $link["name"] ?></a>
      <?php endforeach; ?>
    </div>

    <div class=" flex-1"></div>

    <div class="relative">
      <img src="/assets/profil.svg" alt="Profil" onclick="profilToggle()" class="w-6 cursor-pointer">

      <div id="appbar-profile-menu" class="hidden absolute right-0 w-40 mt-2 p-1 rounded-md border border-zinc-400 shadow-lg text-sm bg-zinc-50">
        <?php if (is_null($user)) : ?>
          <a href="/signin" class="w-full flex items-center px-3 py-2 rounded-md hover:bg-blue-500/70 outline-none focus-visible:bg-blue-500/70">Se connecter</a>
          <a href="/signup" class="w-full flex items-center px-3 py-2 rounded-md hover:bg-blue-500/70 outline-none focus-visible:bg-blue-500/70">S'inscrire</a>
        <?php else : ?>
          <h1 class="py-2 px-3 font-semibold">Bonjour <?= $user["first_name"] ?></h1>

          <a href="./controllers/logout.php" class="w-full flex items-center px-3 py-2 rounded-md text-red-500 hover:bg-red-500 hover:text-zinc-50 outline-none focus-visible:bg-red-500 focus-visible::text-zinc-50">Se déconnecter</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="relative md:hidden">
      <img src="/assets/bars.svg" alt="Menu" onclick="burgerMenuToggle()" class="w-6 cursor-pointer">

      <div id="appbar-burger-menu" class="hidden absolute right-0 w-40 mt-2 p-1 rounded-md border border-zinc-400 shadow-lg text-sm bg-zinc-50">
        <?php foreach ($links as $link) : ?>
          <a href="<?= $link["link"] ?>" class="w-full flex items-center px-3 py-2 rounded-md hover:bg-blue-500/70 outline-none focus-visible:bg-blue-500/70"><?= $link["name"] ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>