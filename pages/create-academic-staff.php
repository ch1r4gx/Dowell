<?php

session_start();
include_once('../others/functions.php');

$_SESSION['academic_sign_in'] = true;

redirect('/assignment-2/pages/signup.php');
