<?php
include_once __DIR__ . '/utils/router.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MarieTeam</title>
  <link rel="stylesheet" href="/styles/output.css">
  <link rel="stylesheet" href="/styles/global.css">
  <link rel="icon" href="assets/logo.ico" />
</head>

<body class="bg-zinc-50">
  <?php
  require __DIR__ . '/components/appbar.php';

  echo "<div class=\"pt-16\">";
  $router = new Router();

  $router->add('/', __DIR__ . '/views/home.php');

  $router->add('/cookies', __DIR__ . '/views/cookies.php');

  $router->add('/signin', __DIR__ . '/views/signin.php');
  $router->add('/signup', __DIR__ . '/views/signup.php');

  $router->add('/secteur', __DIR__ . '/views/secteur.php');
  $router->add('/secteur/{secteurId}', __DIR__ . '/views/liaison.php');
  $router->add('/liaison/{liaisonId}', __DIR__ . '/views/horaires.php');
  $router->add('/traversee/{traverseeId}', __DIR__ . '/views/tarif.php');

  $router->add('/reservations', __DIR__ . '/views/reservations.php');
  $router->add('/reservation/{reservationId}', __DIR__ . '/views/reservation.php');

  $router->add('/admin', __DIR__ . '/views/admin/index.php');

  $router->add('/admin/bateaux', __DIR__ . '/views/admin/bateaux/index.php');
  $router->add('/admin/bateaux/create', __DIR__ . '/views/admin/bateaux/create.php');
  $router->add('/admin/bateaux/{id}', __DIR__ . '/views/admin/bateaux/view.php');
  $router->add('/admin/bateaux/{id}/edit', __DIR__ . '/views/admin/bateaux/edit.php');
  $router->add('/admin/bateaux/{id}/delete', __DIR__ . '/views/admin/bateaux/delete.php');

  $router->add('/admin/categories', __DIR__ . '/views/admin/categories/index.php');
  $router->add('/admin/categories/create', __DIR__ . '/views/admin/categories/create.php');
  $router->add('/admin/categories/{lettre}', __DIR__ . '/views/admin/categories/view.php');
  $router->add('/admin/categories/{lettre}/edit', __DIR__ . '/views/admin/categories/edit.php');
  $router->add('/admin/categories/{lettre}/delete', __DIR__ . '/views/admin/categories/delete.php');

  $router->add('/admin/bateaux-categories', __DIR__ . '/views/admin/bateaux-categories/index.php');
  $router->add('/admin/bateaux-categories/create', __DIR__ . '/views/admin/bateaux-categories/create.php');
  $router->add('/admin/bateaux-categories/{id}/{lettre}', __DIR__ . '/views/admin/bateaux-categories/view.php');
  $router->add('/admin/bateaux-categories/{id}/{lettre}/edit', __DIR__ . '/views/admin/bateaux-categories/edit.php');
  $router->add('/admin/bateaux-categories/{id}/{lettre}/delete', __DIR__ . '/views/admin/bateaux-categories/delete.php');

  $router->add('/admin/equipements', __DIR__ . '/views/admin/equipements/index.php');
  $router->add('/admin/equipements/create', __DIR__ . '/views/admin/equipements/create.php');
  $router->add('/admin/equipements/{id}/{lettre}', __DIR__ . '/views/admin/equipements/view.php');
  $router->add('/admin/equipements/{id}/{lettre}/edit', __DIR__ . '/views/admin/equipements/edit.php');
  $router->add('/admin/equipements/{id}/{lettre}/delete', __DIR__ . '/views/admin/equipements/delete.php');


  $router->notFound(__DIR__ . '/views/404.php');
  echo "</div>";

  require __DIR__ . '/components/footer.php';
  ?>
</body>

</html>