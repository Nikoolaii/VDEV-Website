<?php
include_once __DIR__ . "/../database/data-source.php";

if (!isset($_SESSION)) {
  session_start();
}
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (!$user->{"admin"}) {
  header('Location: /');
}

$result = DataSource::showLiaison();

echo '<div class="flex flex-col">';
echo '<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">';
echo '<div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">';
echo '<div class="overflow-hidden">';
echo '<table class="min-w-full">';
echo '<thead class="border-b">';
echo '<tr>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
            ID
          </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
            Port de départ
          </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
            Port d\'arrivée
          </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
        Distance
      </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
      Modifier
    </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
    Supprimer
  </th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($result as $value) {

  echo '<tr class="border-b">';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' . $value->{'id'} . '</td>';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' . $value->{'depart'} . '</td>';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' . $value->{'arrivee'} . '</td>';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">' . $value->{'distance'} . '</td>';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><img src = "../assets/cross.svg" alt="My Happy SVG" class="w-5 h-5"/></td>';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><img src = "../assets/bin.svg" alt="My Happy SVG" class="w-5 h-5"/></td>';
  echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
?>

<h1 class="text-2xl font-bold text-blue-500">Nombre de réservations</h1>
<?php
$result = DataSource::getNBResa();
echo $result[0];
?>