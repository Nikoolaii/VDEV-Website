<?php

include "../data-source.php";

$id = $_POST['id'];
$database = new DataSource();

$result = $database->collectLiaison($id);

echo json_encode($result);
