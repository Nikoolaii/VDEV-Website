<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once __DIR__ . "/../database/data-source.php";

$newLiaisons = DataSource::newPort($_POST['portName']);
header('Location: /admin');
