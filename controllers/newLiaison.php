<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/../database/data-source.php";
$portDepart = $_POST['portDepart'];
$portArrive = $_POST['portArrivee'];
$distance = $_POST['distance'];
$link = $_POST['link'];
$secteurId = $_POST['secteurId'];


$newLiaisons = DataSource::newLiaison($_POST['portDepart'], $_POST['portArrivee'],  $_POST['distance'],  $_POST['link'],  $_POST['secteurId']);
header('Location: /admin');
