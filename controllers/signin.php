<?php
$email = $_POST["email"];
$password = $_POST["password"];

include "../database/data-source.php";

$database = new DataSource();

$result = $database->validateUser($email, $password);

if (!is_null($result)) {
  session_start();
  $_SESSION["user"] = $result;
  header("Location: /");
} else {
  header("Location: /signin");
}
