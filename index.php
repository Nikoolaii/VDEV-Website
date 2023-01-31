<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MarieTeam</title>
  <link rel="stylesheet" href="styles/output.css">
  <link rel="stylesheet" href="styles/global.css">
</head>

<body class="bg-zinc-50">
  <?php
  require __DIR__ . '/components/appbar.php';

  $request = $_SERVER['REQUEST_URI'];

  echo "<div class=\"pt-16\">";
  switch ($request) {
    case '/':
      require __DIR__ . '/views/home.php';
      break;
    case '/database-error':
      require __DIR__ . '/views/database-error.php';
      break;
    case '/conditions-utilisations':
      require __DIR__ . '/views/condition-utilisation.php';
      break;
    case '/cookies':
      require __DIR__ . '/views/cookies.php';
      break;
    case '/reservation':
      require __DIR__ . '/views/reservation.php';
      break;
    case '/donnees-personnelles':
      require __DIR__ . '/views/donnees-personnelles.php';
      break;
    case '/signin':
      require __DIR__ . '/views/signin.php';
      break;
    case '/signup':
      require __DIR__ . '/views/signup.php';
      break;
    case '/liaisons':
      require __DIR__ . '/views/traversee.php';
      break;
    case '/tarif':
      require __DIR__ . '/views/tarif.php';
      break;
    case '/admin':
      require __DIR__ . '/views/tarif.php';
      break;
    default:
      require __DIR__ . '/views/404.php';
      break;
  }
  echo "</div>";

  require __DIR__ . '/components/footer.php';
  ?>
</body>

</html>