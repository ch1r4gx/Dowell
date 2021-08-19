<?php

session_start();
include_once('../others/functions.php');

check_post_req();

unset($_SESSION['user']);
redirect('/assignment-2/index.php');
