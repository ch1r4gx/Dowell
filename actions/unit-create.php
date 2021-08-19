<?php

session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');
include_once('../db/db_functions.php');

check_post_req();

$data             = filter_input_array(INPUT_POST);
$unit_id          = trim($data['unit-id']);
$unit_name        = trim($data['unit-name']);
$description      = trim($data['description']);
$unit_coordinator = trim($data['unit-coordinator']);
$unit_lecturer    = trim($data['unit-lecturer']);
$semester         = trim($data['semester']);
$campus           = trim($data['campus']);

foreach ($data as $key => $value) {
    echo $key . " - " . $value;
    echo "\n";
    echo "</br>";
}

// Required validation
if (!($unit_id && $unit_name && $description && $unit_coordinator && $unit_lecturer && $semester && $campus)) {
    $_SESSION["errors"] = ["Please enter valid details!"];
    redirect('/assignment-2/pages/error.php');
}

// Check if unit_id already exist
$sql = "SELECT * FROM units WHERE unit_id='$unit_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION["errors"] = ["Unit ID already exist! Please use different one!"];
    redirect('/assignment-2/pages/error.php');
}

add_new_record($conn, 'units', [
    'unit_id' => $unit_id,
    'unit_name' => $unit_name,
    'description' => $description,
    'unit_coordinator' => $unit_coordinator,
    'unit_lecturer' => $unit_lecturer,
    'semester' => $semester,
    'campus' => $campus,
]);

redirect('/assignment-2/pages/unit-list.php');

exit;
