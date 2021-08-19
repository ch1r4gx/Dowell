<?php
function redirect($url)
{
    header("Location: $url");
    exit();
}

function is_valid_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_valid_url($url)
{
    return preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url);
}

function to_title($str)
{
    return ucwords(join(' ', explode("_", $str)));
}

function check_post_req()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION["errors"] = ["Error: GET request is not allowed!"];
        redirect('/assignment-2/pages/error.php');
    }
}
