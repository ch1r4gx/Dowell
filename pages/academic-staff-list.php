<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php check_access(['dc']); ?>

<!-- NOTE: IF YOU WANT TO SHOW DESCRIPTION JUST UN-COMMENT BELOW COMMENTED LINE IN FUNCTION PARAMS -->

<!-- Get List -->
<?php
$data = get_table_data(
    $conn,
    'users',
    ['id', 'staff_student_id', 'name', 'email', 'role'],
    'role="uc" OR role="lecturer" OR role="tutor"',
    []
);
?>

<div class="container mt-5">

    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-4">Academic Staff</h1>
        <a href="/assignment-2/pages/create-academic-staff.php" type="button" class="btn btn-primary">Create - Record</a>
    </div>

    <?php if (count($data)) { ?>

        <!-- Table -->
        <table class="table table-striped table-hover">

            <!-- Headings -->
            <thead>
                <tr>
                    <!-- Omit printing `id` col -->
                    <?php foreach (array_keys($data[0]) as $index => $col_name) { ?>

                        <?php if ($col_name !== 'id') { ?>
                            <!-- Snack-case(db column name) to uppercase -->
                            <th scope="col"><?php echo to_title($col_name); ?></th>
                        <?php } ?>

                    <?php } ?>
                    <th>Actions</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                <?php foreach ($data as $index => $col) { ?>

                    <tr>

                        <!-- Omit printing `id` col -->
                        <?php foreach ($col as $col_name => $col_value) { ?>

                            <?php if ($col_name !== 'id') { ?>
                                <td><?php echo $col_value; ?></td>
                            <?php } ?>

                        <?php } ?>
                        <td class="d-flex align-items-center">
                            <form action="/assignment-2/actions/delete-record.php" method="post">
                                <input type="hidden" name="table_name" value="users">
                                <input type="hidden" name="id" value="<?php echo $col['id']; ?>">
                                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['PHP_SELF'] ?>">
                                <button type="submit" class="btn btn-link text-danger p-0 ml-2">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>


                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No records found!</p>
    <?php } ?>

    <!-- If no record found -->
</div>

<?php include_once('../_partials/scripts.php') ?>
<?php include_once('../_partials/footer.php') ?>
