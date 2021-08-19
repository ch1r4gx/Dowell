<?php

session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');
include_once('../db/db_functions.php');

check_post_req();

$data  = filter_input_array(INPUT_POST);
$id    = trim($data['id']);
$available_day = trim($data['available_day']);

edit_table_data($conn, 'availability', "available_day='$available_day'", "id='$id'");

redirect('/assignment-2/pages/profile.php');
