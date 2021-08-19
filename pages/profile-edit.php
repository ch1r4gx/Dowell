<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php
$user_id = htmlspecialchars($_GET["id"]);

if (!is_numeric($user_id)) {
    $_SESSION["errors"] = ["Error: Unable to retrieve your record!"];
    redirect('/assignment-2/pages/error.php');
}

check_is_owner($user_id);

$user_data = get_table_data($conn, 'users', ['*'], "id=$user_id", []);

// Handle Edge Case: If query don't return any record 
if (!count($user_data)) {
    $_SESSION["errors"] = ["Error: Record not found!"];
    redirect('/assignment-2/pages/error.php');
} else {
    $user_data = array_pop($user_data);
}
?>

<div class="container mt-5">
    <!-- Heading -->
    <h1>Update Profile</h1>
    <hr class="mb-4">

    <!-- Form -->
    <form action="/assignment-2/actions/update-profile.php" id="form-update-profile" method="post">

        <!-- Staff/Student ID -->
        <div class="form-group">
            <label for="staff_student_id">Staff/Student ID</label>
            <input type="text" class="form-control" id="staff_student_id" name="staff_student_id" placeholder="Enter Your ID" required value="<?php echo $user_data['staff_student_id']; ?>">
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required value="<?php echo $user_data['name']; ?>">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="<?php echo $user_data['email']; ?>">
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $user_data['address'] ?></textarea>
        </div>

        <!-- ID Hidden field -->
        <input type="hidden" name="id" value="<?php echo $user_data['id'] ?>">

        <!-- Submit -->
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-3">Update Profile</button>
            <a href="/assignment-2/pages/profile.php" type="button" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php include_once('../_partials/scripts.php') ?>
<?php include_once('../_partials/footer.php') ?>
