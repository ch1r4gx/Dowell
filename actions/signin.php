<?php

session_start();
include_once('../db/db_conn.php');
include_once('../others/functions.php');

check_post_req();

$data             = filter_input_array(INPUT_POST);
$staff_student_id = trim($data['staff-student-id']);
$password         = trim($data['password']);


// Validation
if (!($staff_student_id && $password)) {
    $_SESSION["errors"] = ["Please enter valid details!"];
    redirect('/assignment-2/pages/error.php');
}

foreach ($data as $key => $value) {
    echo $key . " - " . $value;
    echo "</br>";
}

$q = "SELECT * FROM users WHERE staff_student_id='$staff_student_id' AND password='$password'";

$result = $conn->query($q);

// `num_rows` is > 0 then user exist in DB
if ($result->num_rows > 0) {
    $_SESSION["user"] = $result->fetch_assoc();
    $_SESSION["success"] = [
        'messages' => [
            "You are signed in successfully!"
        ],
        // 'link' => [
        //     'label' => "Check Timetable",
        //     'path' => '/assignment-2/pages/timetable.php',
        // ]
    ];
    if ($_SESSION['user']['role'] === 'student') {
        $_SESSION['success']['link'] = [
            'label' => "Check Timetable",
            'path' => '/assignment-2/pages/timetable.php',
        ];
    } else {
        $_SESSION['success']['link'] = [
            'label' => "Check Enrolled Students",
            'path' => '/assignment-2/pages/enrolled-students.php',
        ];
    }
    redirect('/assignment-2/pages/success.php');
} else {
    $_SESSION["errors"] = ["You are not registered yet!"];
    redirect('/assignment-2/pages/error.php');
}


// if ($result->num_rows === 0) {
//     echo json_encode(array("success" => FALSE, "msg" => "No record found!"));
// } else if ($result->num_rows === 1) {
//     // ? Check What `$result->fetch_row()[0]` returns. Maybe it return id of that row
//     $_SESSION["userId"] = $result->fetch_row()[0];
//     echo json_encode(array("success" => TRUE, "msg" => 'Success!'));
// } else {
//     echo json_encode(array("success" => FALSE, "msg" => $result->fetch_row()));
// }
