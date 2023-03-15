<?php
include_once __DIR__ . '/../controllers/utils.php';

$traverseeId = $params['traverseeId'];

if (session_status() != 2) session_start();
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

$traversee = getTraverseeWithFullInformations($traverseeId);
$date = new DateTime($traversee->date);
$tarifs = getTarifsForTraversee($traverseeId);

if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["adresse"]) && isset($_POST["codePostal"]) && isset($_POST["ville"])) {
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $adresse = $_POST["adresse"];
  $codePostal = $_POST["codePostal"];
  $ville = $_POST["ville"];
  $userId = $_SESSION["user"]->{"id"} ?? null;

  $quantites = [];

  foreach ($tarifs as $tarif) {
    if (isset($_POST["quantite-$tarif->type_id"]) && $_POST["quantite-$tarif->type_id"] > 0)
      $quantites[$tarif->type_id] = $_POST["quantite-$tarif->type_id"];
  }

  $reservationId = createReservation($nom, $prenom, $email, $adresse, $codePostal, $ville, $traverseeId, $quantites, $userId);

  if ($reservationId != null) {
    header("Location: /reservation/$reservationId");
  }
}
?>

<div class="mx-auto max-w-6xl w-full">
  <h1 class="text-3xl">Tarifs pour la liaison <?= $traversee->port_arrivee ?> - <?= $traversee->port_depart ?></h1>
  <p class="text-xl"><?= $date->format('d/m/Y') ?> - <?= $traversee->heure ?></p>

  <form method="post" class="flex flex-col items-center gap-4">
    <div>
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom" value="<?= $user->{'last_name'} ?? '' ?>" required>
    </div>

    <div>
      <label for="prenom">Prénom</label>
      <input type="text" id="prenom" name="prenom" value="<?= $user->{'first_name'} ?? '' ?>" required>
    </div>

    <div>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= $user->{'email'} ?? '' ?>" required>
    </div>

    <div>
      <label for="adresse">Adresse</label>
      <input type="text" id="adresse" name="adresse" required>
    </div>

    <div>
      <label for="codePostal">Code postal</label>
      <input type="text" id="codePostal" name="codePostal" required>
    </div>

    <div>
      <label for="ville">Ville</label>
      <input type="text" id="ville" name="ville" required>
    </div>

    <?php if (is_null($user)) : ?>
      <a href="/signin" class="text-red-500 hover:underline">Créez-vous un compte ou utilisez l'adresse mail de votre compte pour pouvoir consulter votre réservation.</a>
    <?php else : ?>
      <p class="text-green-500">Vous êtes bien connecté, vous pourrez consulter votre réservation.</p>
    <?php endif; ?>

    <table class="border">
      <tbody>
        <?php foreach ($tarifs as $tarif) : ?>
          <tr class="border-b">
            <td class="px-2 py-1 text-lg font-medium"><?= $tarif->libelle ?></td>
            <td class="pr-2 pl-8 py-1"><?= $tarif->tarif ?>€</td>
            <td class="px-2 py-1 border-l">
              <input type="number" value="0" class="text-right min-w-full w-28" min="0" max="<?= $tarif->capacite_max ?>" name="quantite-<?= $tarif->type_id ?>">
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <button type="submit" class="py-1 px-3 bg-zinc-100 border border-black">Valider</button>
  </form>

</div>