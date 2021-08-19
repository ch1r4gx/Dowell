<?php

session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');

check_post_req();

$data             = filter_input_array(INPUT_POST);
$staff_student_id = trim($data['staff-student-id']);
$email            = trim($data['email']);
$name             = trim($data['name']);
$password         = trim($data['password']);
$address          = trim($data['address']);
$role             = trim($data['role']);

// //////////////////////////////
// Validations
// //////////////////////////////

// Required validation
if (!($staff_student_id && $email && $name && $address && $password && $role)) {
    $_SESSION["errors"] = ["Please enter valid details!"];
    redirect('/assignment-2/pages/error.php');
}

// Email validation
if (!is_valid_email($email)) {
    $_SESSION["errors"] = ["Please enter valid email!"];
    redirect('/assignment-2/pages/error.php');
}



foreach ($data as $key => $value) {
    echo $key . " - " . $value;
    echo "\n";
    echo "</br>";
}

/*

Check:
    - staff-student-id exist
    - email exist
*/

$sql = "SELECT * FROM users WHERE email='$email' OR staff_student_id='$staff_student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION["errors"] = ["Email or Staff/Student ID already exist! Please use different pair!"];
    redirect('/assignment-2/pages/error.php');
}

// If everything is fine => Create new record

$sql = "INSERT INTO users (staff_student_id, email, name, password, address, role)
VALUES ('$staff_student_id', '$email', '$name', '$password', '$address', '$role')";

if ($conn->query($sql) === TRUE) {
    $_SESSION["success"] = [
        'messages' => [
            "You are registered successfully! Please sign in."
        ],
        'link' => [
            'label' => "Go to Signin Page",
            'path' => '/assignment-2/pages/signin.php',
        ]
    ];
    redirect('/assignment-2/pages/success.php');
} else {
    $_SESSION["errors"] = ["Error: " . $sql . " - " . $conn->error];
    redirect('/assignment-2/pages/error.php');
}
