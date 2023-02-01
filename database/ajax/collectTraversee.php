<?php
include __DIR__ . "/../data-source.php";

$result = DataSource::collectTraversee($_POST['id']);

echo json_encode($result);
