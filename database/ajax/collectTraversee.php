<?php

include "../data-source.php";

$id = $_POST['id'];
$database = new DataSource();
$result = $database->collectTraversee($id);

echo json_encode($result);
