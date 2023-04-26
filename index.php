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
  $router->add('/admin/equipements/{id}', __DIR__ . '/views/admin/equipements/view.php');
  $router->add('/admin/equipements/{id}/edit', __DIR__ . '/views/admin/equipements/edit.php');
  $router->add('/admin/equipements/{id}/delete', __DIR__ . '/views/admin/equipements/delete.php');

  $router->add('/admin/bateaux-voyageur-equipements', __DIR__ . '/views/admin/bateaux-voyageur-equipements/index.php');
  $router->add('/admin/bateaux-voyageur-equipements/create', __DIR__ . '/views/admin/bateaux-voyageur-equipements/create.php');
  $router->add('/admin/bateaux-voyageur-equipements/{idBateau}/{idEquipement}', __DIR__ . '/views/admin/bateaux-voyageur-equipements/view.php');
  $router->add('/admin/bateaux-voyageur-equipements/{idBateau}/{idEquipement}/delete', __DIR__ . '/views/admin/bateaux-voyageur-equipements/delete.php');

  $router->add('/admin/liaisons', __DIR__ . '/views/admin/liaisons/index.php');
  $router->add('/admin/liaisons/create', __DIR__ . '/views/admin/liaisons/create.php');
  $router->add('/admin/liaisons/{id}', __DIR__ . '/views/admin/liaisons/view.php');
  $router->add('/admin/liaisons/{id}/edit', __DIR__ . '/views/admin/liaisons/edit.php');
  $router->add('/admin/liaisons/{id}/delete', __DIR__ . '/views/admin/liaisons/delete.php');

  $router->add('/admin/periodes', __DIR__ . '/views/admin/periodes/index.php');
  $router->add('/admin/periodes/create', __DIR__ . '/views/admin/periodes/create.php');
  $router->add('/admin/periodes/{id}', __DIR__ . '/views/admin/periodes/view.php');
  $router->add('/admin/periodes/{id}/edit', __DIR__ . '/views/admin/periodes/edit.php');
  $router->add('/admin/periodes/{id}/delete', __DIR__ . '/views/admin/periodes/delete.php');

  $router->add('/admin/liaisons-types-periodes', __DIR__ . '/views/admin/liaisons-types-periodes/index.php');
  $router->add('/admin/liaisons-types-periodes/create', __DIR__ . '/views/admin/liaisons-types-periodes/create.php');
  $router->add('/admin/liaisons-types-periodes/{idLiaison}/{idType}/{idPeriode}', __DIR__ . '/views/admin/liaisons-types-periodes/view.php');
  $router->add('/admin/liaisons-types-periodes/{idLiaison}/{idType}/{idPeriode}/edit', __DIR__ . '/views/admin/liaisons-types-periodes/edit.php');
  $router->add('/admin/liaisons-types-periodes/{idLiaison}/{idType}/{idPeriode}/delete', __DIR__ . '/views/admin/liaisons-types-periodes/delete.php');

  $router->add('/admin/ports', __DIR__ . '/views/admin/ports/index.php');
  $router->add('/admin/ports/create', __DIR__ . '/views/admin/ports/create.php');
  $router->add('/admin/ports/{id}', __DIR__ . '/views/admin/ports/view.php');
  $router->add('/admin/ports/{id}/edit', __DIR__ . '/views/admin/ports/edit.php');
  $router->add('/admin/ports/{id}/delete', __DIR__ . '/views/admin/ports/delete.php');

  $router->add('/admin/reservations', __DIR__ . '/views/admin/reservations/index.php');
  $router->add('/admin/reservations/create', __DIR__ . '/views/admin/reservations/create.php');
  $router->add('/admin/reservations/{id}', __DIR__ . '/views/admin/reservations/view.php');
  $router->add('/admin/reservations/{id}/edit', __DIR__ . '/views/admin/reservations/edit.php');
  $router->add('/admin/reservations/{id}/delete', __DIR__ . '/views/admin/reservations/delete.php');

  $router->add('/admin/reservations-types', __DIR__ . '/views/admin/reservations-types/index.php');
  $router->add('/admin/reservations-types/create', __DIR__ . '/views/admin/reservations-types/create.php');
  $router->add('/admin/reservations-types/{idReservation}/{idType}', __DIR__ . '/views/admin/reservations-types/view.php');
  $router->add('/admin/reservations-types/{idReservation}/{idType}/edit', __DIR__ . '/views/admin/reservations-types/edit.php');
  $router->add('/admin/reservations-types/{idReservation}/{idType}/delete', __DIR__ . '/views/admin/reservations-types/delete.php');

  $router->add('/admin/secteurs', __DIR__ . '/views/admin/secteurs/index.php');
  $router->add('/admin/secteurs/create', __DIR__ . '/views/admin/secteurs/create.php');
  $router->add('/admin/secteurs/{id}', __DIR__ . '/views/admin/secteurs/view.php');
  $router->add('/admin/secteurs/{id}/edit', __DIR__ . '/views/admin/secteurs/edit.php');
  $router->add('/admin/secteurs/{id}/delete', __DIR__ . '/views/admin/secteurs/delete.php');

  $router->add('/admin/types', __DIR__ . '/views/admin/types/index.php');
  $router->add('/admin/types/create', __DIR__ . '/views/admin/types/create.php');
  $router->add('/admin/types/{id}', __DIR__ . '/views/admin/types/view.php');
  $router->add('/admin/types/{id}/edit', __DIR__ . '/views/admin/types/edit.php');
  $router->add('/admin/types/{id}/delete', __DIR__ . '/views/admin/types/delete.php');

  $router->add('/admin/traversees', __DIR__ . '/views/admin/traversees/index.php');
  $router->add('/admin/traversees/create', __DIR__ . '/views/admin/traversees/create.php');
  $router->add('/admin/traversees/{id}', __DIR__ . '/views/admin/traversees/view.php');
  $router->add('/admin/traversees/{id}/edit', __DIR__ . '/views/admin/traversees/edit.php');
  $router->add('/admin/traversees/{id}/delete', __DIR__ . '/views/admin/traversees/delete.php');

  $router->add('/admin/users', __DIR__ . '/views/admin/users/index.php');
  $router->add('/admin/users/create', __DIR__ . '/views/admin/users/create.php');
  $router->add('/admin/users/{id}', __DIR__ . '/views/admin/users/view.php');
  $router->add('/admin/users/{id}/edit', __DIR__ . '/views/admin/users/edit.php');
  $router->add('/admin/users/{id}/delete', __DIR__ . '/views/admin/users/delete.php');

  $router->notFound(__DIR__ . '/views/404.php');
  echo "</div>";

  require __DIR__ . '/components/footer.php';
  ?>
</body>

</html>