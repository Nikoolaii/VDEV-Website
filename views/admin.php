<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/../database/data-source.php";

if (!isset($_SESSION)) {
  session_start();
}
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if (!$user->{"admin"}) {
  header('Location: /');
}
?>
<h1 class="text-2xl font-bold text-blue-500">Nouvelle liaison</h1>
<?php
$result = DataSource::showLiaison();
$resultPorts = DataSource::collectPorts();
$resultSecteurs = DataSource::collectSecteur();

echo '<form method="POST" action="/../controllers/newLiaison.php">';
echo '<div class="flex flex-col">';
echo '<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">';
echo '<div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">';
echo '<div class="overflow-hidden">';
echo '<table class="min-w-full">';
echo '<thead class="border-b">';
echo '<tr>';
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
        Secteur
      </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
        Image link
      </th>';
echo '<th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
      Valider
    </th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr class="border-b">';
echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">';
echo '<select id="portDepart" name="portDepart" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">';
foreach ($resultPorts as $port) {
  echo '<option value="' . $port->{'id'} . '">' . $port->{'nom'} . '</option>';
}
echo '</select></td>';
echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">';
echo '<select id="portArrivee" name="portArrivee" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">';
foreach ($resultPorts as $port) {
  echo '<option value="' . $port->{'id'} . '">' . $port->{'nom'} . '</option>';
}
echo '</select></td>';
echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="number" name="distance" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></input></td>';
echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">';
echo '<select id="secteurId" name="secteurId" class="w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">';
foreach ($resultSecteurs as $port) {
  echo '<option value="' . $port->{'id'} . '">' . $port->{'nom'} . '</option>';
}
echo '</select></td>';
echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="text" name="link" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></input></td>';
echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><label>
<input type="submit" name="image" value="Valider">
<img src = "../assets/check.svg" alt="My Happy SVG" class="w-5 h-5"/> 
</label></td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</form>';
?>
<h1 class="text-2xl font-bold text-blue-500">Les liaisons</h1>
<?php
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
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><img src = "../assets/edit.svg" alt="My Happy SVG" class="w-5 h-5"/></td>';
  echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><img src = "../assets/bin.svg" alt="My Happy SVG" class="w-5 h-5"/></td>';
  echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
?>


<h1 class="text-2xl font-bold text-blue-500">Nouveau port</h1>
<form action="/../controllers/newPort.php" method="post">
  <input type="text" name="portName" class="w-80% rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></input>
  <button type="submit" class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
    Ajouter un nouveau port
  </button>
</form>

<h1 class="text-2xl font-bold text-blue-500">Nombre de réservations</h1>
<?php
$result = DataSource::getNBResa();
echo $result[0];
?>