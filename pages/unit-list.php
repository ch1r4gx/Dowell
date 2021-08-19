<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php check_access(['dc']); ?>

<!-- NOTE: IF YOU WANT TO SHOW DESCRIPTION JUST UN-COMMENT BELOW COMMENTED LINE IN FUNCTION PARAMS -->

<!-- Get List -->
<?php
$data = get_table_data(
    $conn,
    'units',
    [
        'units.id',
        'units.unit_id',
        'units.unit_name',
        'units.description',
        'us_coordinator.name as coordinator',
        'us_lecturer.name as lecturer',
        'semesters.name as semester',
        'campuses.name as campus'
    ],
    '',
    [
        ['join_type' => '', 'join_on' => 'users us_coordinator', 'match_col' => 'units.unit_coordinator=us_coordinator.id'],
        ['join_type' => '', 'join_on' => 'users us_lecturer', 'match_col' => 'units.unit_lecturer=us_lecturer.id'],
        ['join_type' => '', 'join_on' => 'semesters', 'match_col' => 'units.semester=semesters.id'],
        ['join_type' => '', 'join_on' => 'campuses', 'match_col' => 'units.campus=campuses.id'],
    ]
);
?>

<div class="container mt-5">

    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-4">Units</h1>
        <a href="/assignment-2/pages/unit-create.php" type="button" class="btn btn-primary">Create Record</a>
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

                            <?php if ($col_name === 'description') { ?>

                                <!-- Desc col btn for dialog -->
                                <td>
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#description<?php echo $col['id']; ?>">
                                        Description
                                    </button>

                                    <!-- Description Modal -->
                                    <div class="modal fade" id="description<?php echo $col['id']; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $col['unit_name']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $col_value; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            <?php } elseif ($col_name === 'unit_id') { ?>
                                <td>
                                    <a href="/assignment-2/pages/unit-details.php?id=<?php echo $col['id']; ?>"><?php echo $col_value; ?></a>
                                </td>
                            <?php } elseif ($col_name !== 'id') { ?>
                                <td><?php echo $col_value; ?></td>
                            <?php } ?>

                        <?php } ?>
                        <td class="d-flex align-items-center">
                            <a href="/assignment-2/pages/unit-edit.php?id=<?php echo $col['id']; ?>">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form action="/assignment-2/actions/delete-record.php" method="post">
                                <input type="hidden" name="table_name" value="units">
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
