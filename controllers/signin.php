<?php
$email = $_POST["email"];
$password = $_POST["password"];

include_once __DIR__ . "/../database/data-source.php";

$result = DataSource::validateUser($email, $password);

if (!is_null($result)) {
  session_start();
  $_SESSION["user"] = $result;
  header("Location: /");
} else {
  header("Location: /signin");
}
