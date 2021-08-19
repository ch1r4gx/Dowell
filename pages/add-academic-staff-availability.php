<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php
check_access(['uc', 'lecturer', 'tutor']);
$AVAILABILITIES = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
?>

<div class="container mt-5">

    <!-- Heading -->
    <h1>Add new Availability</h1>
    <hr class="mb-4">

    <form action="/assignment-2/actions/add-academic-staff-availability.php" method="post">

        <input type="hidden" name="academic_staff" value="<?php echo $_SESSION["user"]['id']; ?>">

        <!-- Select Day -->
        <div class="form-group">
            <select name="available_day" class="custom-select availability-select" required>
                <?php foreach ($AVAILABILITIES as $availability) { ?>
                    <option value="<?php echo $availability; ?>">
                        <?php echo to_title($availability); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Add Availability</button>
    </form>
</div>

<?php include_once('../_partials/scripts.php') ?>
<?php include_once('../_partials/footer.php') ?>
