<?php include_once('./_partials/header.php') ?>
<?php include_once('./_partials/navbar.php') ?>
<?php include_once('./others/functions.php'); ?>

<?php

if (array_key_exists("user", $_SESSION)) {
    $_SESSION["success"] = [
        'messages' => [
            "You are already logged in!"
        ],
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
    // enrolled-students.php
    redirect('/assignment-2/pages/success.php');
}

?>

<div class="d-flex mx-auto justify-content-center" style="margin-top: 100px; width: 50vw">
    <div>
        <a href="/assignment-2/pages/signin.php" class="btn btn-secondary mr-4" id="navigate-sign-in">
            Sign In
        </a>
        <a href="/assignment-2/pages/signup.php" class="btn btn-primary">
            Sign Up
        </a>
    </div>
</div>
<?php include_once('./_partials/scripts.php') ?>
<?php include_once('./_partials/footer.php') ?>
