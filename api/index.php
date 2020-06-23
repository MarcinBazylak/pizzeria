<?php

include '../includes/db.php';
include '../includes/functions.php';
require_once '../models/model.php';
require_once 'autoload.php';

$pizza = new Pizza();
$result = $pizza->getAll() ?? '';


$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

print json_encode($rows);

?>