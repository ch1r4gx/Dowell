<?php

session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');
include_once('../db/db_functions.php');

check_post_req();

$data             = filter_input_array(INPUT_POST);
$id               = trim($data['id']);
$staff_student_id = trim($data['staff_student_id']);
$name             = trim($data['name']);
$email            = trim($data['email']);
$address          = trim($data['address']);

edit_table_data(
    $conn,
    'users',
    "
        staff_student_id='$staff_student_id',
        name='$name',
        email='$email',
        address='$address'
    ",
    "id='$id'"
);

redirect('/assignment-2/pages/profile.php');
