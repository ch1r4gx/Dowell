<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>

<?php
$is_academic_sign_in = false;
if (array_key_exists('academic_sign_in', $_SESSION)) {
    $is_academic_sign_in = $_SESSION["academic_sign_in"];
    unset($_SESSION['academic_sign_in']);
}

?>

<div class="container">
    <h2 class="mt-5 mb-3">Create an account</h2>
    <form action="/assignment-2/actions/signup.php" id="form-signup" method="post">

        <!-- Staff/Student ID -->
        <div class="form-group">
            <label for="staff-student-id">Staff/Student ID</label>
            <input type="text" class="form-control" id="staff-student-id" name="staff-student-id" placeholder="Enter Your ID" required>
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Sign Up As</label>
            <select class="form-control" id="role" name="role" required>

                <!-- Below line is just for development -->
                <!-- <option value="dc">Degree Coordinator</option> -->

                <!-- If DC is creating account => then blow options will be available -->
                <!-- Else we can only see student sign-in -->
                <?php if ($is_academic_sign_in) { ?>
                    <option value="uc">Unit Coordinator</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="tutor">Tutor</option>
                <?php } ?>
                <option value="student">Student</option>
            </select>
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>

        <!-- Pwd -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <!-- Pwd 2 -->
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../_partials/scripts.php') ?>
<script>
    $("#form-signup").validate({
        rules: {
            password: {
                minlength: 6
            },
            'confirm-password': {
                minlength: 6,
                equalTo: "#password"
            }
        }
    });
</script>
<?php include_once('../_partials/footer.php') ?>
