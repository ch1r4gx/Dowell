<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>

<div class="container">
    <form action="/assignment-2/actions/signin.php" id="form-signin" method="post" class="mt-4">

        <!-- Staff/Student ID -->
        <div class="form-group">
            <label for="staff-student-id">Staff/Student ID</label>
            <input type="text" class="form-control" id="staff-student-id" name="staff-student-id" placeholder="Enter Your ID" required>
        </div>

        <!-- Pwd -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../_partials/scripts.php') ?>
<script>
    $("#form-signin").validate();
</script>
<?php include_once('../_partials/footer.php') ?>
