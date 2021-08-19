<?php
session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');
include_once('../db/db_functions.php');

check_post_req();

$data  = filter_input_array(INPUT_POST);
$academic_staff = trim($data['academic_staff']);
$available_day  = trim($data['available_day']);

$data = get_table_data($conn, 'availability', ['id'], "academic_staff='$academic_staff' AND available_day='$available_day'", []);

if (count($data)) {
    $_SESSION["errors"] = ["Error: This slot is already occupied!"];
    redirect('/assignment-2/pages/error.php');
}

add_new_record($conn, 'availability', [
    'academic_staff' => $academic_staff,
    'available_day' => $available_day,
]);

redirect('/assignment-2/pages/profile.php');
