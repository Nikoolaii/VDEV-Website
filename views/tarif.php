<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . '/../utils/functions.php';
if (is_null(getReservationDetails($_POST))) {
  // $result = DataSource::validateReservation($_POST['fName'], $_POST['lName'], $_POST['adress'], $_POST['city'], $_POST['cp'], $_POST['region'], $_POST['liaison'], $_POST['traversee'], $_POST['adult'], $_POST['junior'], $_POST['baby'], $_POST['fourgon'], $_POST['cc'], $_POST['camion'], $_POST['voiture4'], $_POST['voiture5'], $_POST['animals']);
  header('Location: /reservation');
}

include_once __DIR__ . "/../database/data-source.php";

$tarif = DataSource::getTarif($_POST['traversee']);
$pAdulte = $tarif->{"pAdulte"};
$pJunior = $tarif->{"pJunior"};
$pEnfant = $tarif->{"pEnfant"};
$pFourgon = $tarif->{"pFourgon"};
$pCC = $tarif->{"pCC"};
$pCamion = $tarif->{"pCamion"};
$pVoiture4 = $tarif->{"pVoiture4"};
$pVoiture5 = $tarif->{"pVoiture5"};
$pAnimaux = $tarif->{"pAnimaux"};

$nbAdulte = $_POST['adult'];
$nbJunior = $_POST['junior'];
$nbBaby = $_POST['baby'];
$nbFourgon = $_POST['fourgon'];
$nbCC = $_POST['cc'];
$nbCamion = $_POST['camion'];
$nbVoiture4 = $_POST['voiture4'];
$nbVoiture5 = $_POST['voiture5'];
$nbAnimals = $_POST['animals'];
?>

<h1 class="text-2xl font-bold text-blue-500">Récapitulatif des tarifs</h1>
<?php
echo '<p>Adulte : ' . $nbAdulte . '</p>';
echo '<p class="italic text-gray-500">' . $pAdulte . '€ : ' . $nbAdulte * $pAdulte . '€</p>';
echo '<p>Junior : ' . $nbJunior . '</p>';
echo '<p class="italic text-gray-500">' . $pJunior . '€ : ' . $nbJunior * $pJunior . '€</p>';
echo '<p>Baby : ' . $nbBaby . '</p>';
echo '<p class="italic text-gray-500">' . $pEnfant . '€ : ' . $nbBaby * $pEnfant . '€</p>';
echo '<p>Fourgon : ' . $nbFourgon . '</p>';
echo '<p class="italic text-gray-500">' . $pFourgon . '€ : ' . $nbFourgon * $pFourgon . '€</p>';
echo '<p>Camping Car : ' . $nbCC . '</p>';
echo '<p class="italic text-gray-500">' . $pCC . '€ : ' . $nbCC * $pCC . '€</p>';
echo '<p>Camion : ' . $nbCamion . '</p>';
echo '<p class="italic text-gray-500">' . $pCamion . '€ : ' . $nbCamion * $pCamion . '€</p>';
echo '<p>Voiture long.inf.4m : ' . $nbVoiture4 . '</p>';
echo '<p class="italic text-gray-500">' . $pVoiture4 . '€ : ' . $nbVoiture4 * $pVoiture4 . '€</p>';
echo '<p>Voiture long.inf.5m : ' . $nbVoiture5 . '</p>';
echo '<p class="italic text-gray-500">' . $pVoiture5 . '€ : ' . $nbVoiture5 * $pVoiture5 . '€</p>';
echo '<p>Animals : ' . $nbAnimals . '</p>';
echo '<p class="italic text-gray-500">' . $pAnimaux . '€ : ' . $nbAnimals * $pAnimaux . '€</p>';

echo '<br /><hr /><br />';
echo '<p> Montant Total :';
$MontantTotal = $nbAdulte * $pAdulte + $nbJunior * $pJunior + $nbBaby * $pEnfant + $nbFourgon * $pFourgon + $nbCC * $pCC + $nbCamion * $pCamion + $nbVoiture4 * $pVoiture4 + $nbVoiture5 * $pVoiture5 + $nbAnimals * $pAnimaux;
echo '<p class="italic text-gray-500">' . $MontantTotal . '€</p>';
?>
<a href="/"><button type="submit" class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
    Valider la réservation ma reservation
  </button></a>
<br>