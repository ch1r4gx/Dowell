<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>

<?php
$unit_id = htmlspecialchars($_GET["id"]);

if (!is_numeric($unit_id)) {
    $_SESSION["errors"] = ["Error: Unable to retrieve your record!"];
    redirect('/assignment-2/pages/error.php');
}

// $data = get_table_data($conn, 'units', ['*'], "id=$unit_id", []);
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
    "units.id='$unit_id'",
    [
        ['join_type' => '', 'join_on' => 'users us_coordinator', 'match_col' => 'units.unit_coordinator=us_coordinator.id'],
        ['join_type' => '', 'join_on' => 'users us_lecturer', 'match_col' => 'units.unit_lecturer=us_lecturer.id'],
        ['join_type' => '', 'join_on' => 'semesters', 'match_col' => 'units.semester=semesters.id'],
        ['join_type' => '', 'join_on' => 'campuses', 'match_col' => 'units.campus=campuses.id'],
    ]
);

// Handle Edge Case: If query don't return any record 
if (!count($data)) {
    $_SESSION["errors"] = ["Error: Record not found!"];
    redirect('/assignment-2/pages/error.php');
} else {
    $data = array_pop($data);
}
?>

<div class="container mt-5">

    <!-- Heading -->

    <h1><?php echo $data['unit_name']; ?></h1>
    <hr class="mb-4">

    <table class="table table-borderless">
        <tbody>
            <?php
            foreach ($data as $col => $val) {
                if ($col === 'id') continue
            ?>
                <tr>
                    <th><?php echo to_title($col); ?></th>
                    <td><?php echo $val; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include_once('../_partials/scripts.php') ?>
<?php include_once('../_partials/footer.php') ?>
