<?php

session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');

check_post_req();

$data        = filter_input_array(INPUT_POST);
$table_name  = trim($data['table_name']);
$id          = trim($data['id']);
$redirect_to = trim($data['redirect_to']);

$sql = "DELETE FROM $table_name WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    redirect($redirect_to);
} else {
    $_SESSION["errors"] = ["Error: " . $sql . " - " . $conn->error];
    redirect('/assignment-2/pages/error.php');
}
