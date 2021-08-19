<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php check_access(['dc']); ?>

<?php

// Fetch options for form
$coordinators = get_table_data($conn, 'users', ['*'], 'role="uc"', []);
$lecturers = get_table_data($conn, 'users', ['*'], 'role="lecturer"', []);
$semesters = get_table_data($conn, 'semesters', ['*'], '', []);
$campuses = get_table_data($conn, 'campuses', ['*'], '', []);

?>

<div class="container mt-5">

    <!-- Heading -->
    <h1>Create New Unit</h1>
    <hr class="mb-4">

    <!--
        unit id
        name
        desc
        unit coordinator
        unit lecturer
        semester
        campus
    -->

    <!-- Form -->
    <form action="/assignment-2/actions/unit-create.php" id="form-create-unit" method="post">

        <!-- Unit ID -->
        <div class="form-group">
            <label for="unit-id">Unit ID</label>
            <input type="text" class="form-control" id="unit-id" name="unit-id" placeholder="Enter Unit ID" required>
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="unit-name">Unit Name</label>
            <input type="text" class="form-control" id="unit-name" name="unit-name" placeholder="Enter Unit Name" required>
        </div>

        <!-- description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <!-- Unit coordinator -->
        <div class="form-group">
            <label for="unit-coordinator">Select Unit Coordinator</label>
            <select class="form-control" id="unit-coordinator" name="unit-coordinator" required>
                <?php foreach ($coordinators as $coordinator) { ?>
                    <option value="<?php echo $coordinator['id']; ?>"><?php echo $coordinator['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Unit lecturer -->
        <div class="form-group">
            <label for="unit-lecturer">Select Unit Lecturer</label>
            <select class="form-control" id="unit-lecturer" name="unit-lecturer" required>
                <?php foreach ($lecturers as $lecturer) { ?>
                    <option value="<?php echo $lecturer['id']; ?>"><?php echo $lecturer['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Unit Semester -->
        <div class="form-group">
            <label for="semester">Select Unit Semester</label>
            <select class="form-control" id="semester" name="semester" required>
                <?php foreach ($semesters as $semester) { ?>
                    <option value="<?php echo $semester['id']; ?>"><?php echo $semester['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Unit campus -->
        <div class="form-group">
            <label for="campus">Select Unit Campus</label>
            <select class="form-control" id="campus" name="campus" required>
                <?php foreach ($campuses as $campus) { ?>
                    <option value="<?php echo $campus['id']; ?>"><?php echo $campus['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../_partials/scripts.php') ?>
<script>
    $("#form-create-unit").validate();
</script>
<?php include_once('../_partials/footer.php') ?>
