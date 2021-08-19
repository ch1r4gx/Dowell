<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php check_access(['dc']); ?>

<?php
$unit_id = htmlspecialchars($_GET["id"]);

if (!is_numeric($unit_id)) {
    $_SESSION["errors"] = ["Error: Unable to retrieve your record!"];
    redirect('/assignment-2/pages/error.php');
}

$data = get_table_data($conn, 'units', ['*'], "id=$unit_id", []);

// Handle Edge Case: If query don't return any record 
if (!count($data)) {
    $_SESSION["errors"] = ["Error: Record not found!"];
    redirect('/assignment-2/pages/error.php');
} else {
    $data = array_pop($data);
}

// Fetch options for form
$coordinators = get_table_data($conn, 'users', ['*'], 'role="uc"', []);
$lecturers = get_table_data($conn, 'users', ['*'], 'role="lecturer"', []);
$semesters = get_table_data($conn, 'semesters', ['*'], '', []);
$campuses = get_table_data($conn, 'campuses', ['*'], '', []);
?>

<div class="container mt-5">
    <!-- Heading -->
    <h1>Update Unit</h1>
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
    <form action="/assignment-2/actions/unit-update.php" id="form-update-unit" method="post">

        <!-- Unit DB ID -->

        <input type="hidden" value="<?php echo $data['id']; ?>" name="id">

        <!-- Unit ID -->
        <div class="form-group">
            <label for="unit-id">Unit ID</label>
            <input type="text" class="form-control" id="unit-id" name="unit-id" placeholder="Enter Unit ID" required value="<?php echo $data['unit_id']; ?>">
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="unit-name">Unit Name</label>
            <input type="text" class="form-control" id="unit-name" name="unit-name" placeholder="Enter Unit Name" required value="<?php echo $data['unit_name']; ?>">
        </div>

        <!-- description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $data['description']; ?></textarea>
        </div>

        <!-- Unit coordinator -->
        <div class="form-group">
            <label for="unit-coordinator">Select Unit Coordinator</label>
            <select class="form-control" id="unit-coordinator" name="unit-coordinator" required>
                <?php foreach ($coordinators as $coordinator) { ?>
                    <option value="<?php echo $coordinator['id']; ?>" <?php echo ($coordinator['id'] === $data['unit_coordinator'])  ? "selected" : ""; ?>><?php echo $coordinator['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Unit lecturer -->
        <div class="form-group">
            <label for="unit-lecturer">Select Unit Lecturer</label>
            <select class="form-control" id="unit-lecturer" name="unit-lecturer" required>
                <?php foreach ($lecturers as $lecturer) { ?>
                    <option value="<?php echo $lecturer['id']; ?>" <?php echo ($lecturer['id'] === $data['unit_lecturer'])  ? "selected" : ""; ?>><?php echo $lecturer['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Unit Semester -->
        <div class="form-group">
            <label for="semester">Select Unit Semester</label>
            <select class="form-control" id="semester" name="semester" required>
                <?php foreach ($semesters as $semester) { ?>
                    <option value="<?php echo $semester['id']; ?>" <?php echo ($semester['id'] === $data['semester'])  ? "selected" : ""; ?>><?php echo $semester['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Unit campus -->
        <div class="form-group">
            <label for="campus">Select Unit Campus</label>
            <select class="form-control" id="campus" name="campus" required>
                <?php foreach ($campuses as $campus) { ?>
                    <option value="<?php echo $campus['id']; ?>" <?php echo ($campus['id'] === $data['campus'])  ? "selected" : ""; ?>><?php echo $campus['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../_partials/scripts.php') ?>
<script>
    $("#form-update-unit").validate();
</script>
<?php include_once('../_partials/footer.php') ?>
