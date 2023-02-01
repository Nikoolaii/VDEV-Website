<?php
include __DIR__ . "/../data-source.php";

$result = DataSource::collectLiaison($_POST['id']);

echo json_encode($result);
