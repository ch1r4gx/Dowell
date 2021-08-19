<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>
<?php include_once('../db/db_functions.php') ?>
<?php include_once('../others/functions.php') ?>

<?php
$AVAILABILITIES = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
$user_id = $_SESSION["user"]['id'];

// Get User Data
$user = get_table_data(
    $conn,
    'users',
    [
        'id',
        'staff_student_id as your_id',
        'name',
        'email',
        'address',
        'role'
    ],
    "id='$user_id'",
    []
);

// Get Availability
$availabilities = get_table_data(
    $conn,
    'availability',
    [
        'id',
        'available_day'
    ],
    "academic_staff='$user_id'",
    []
);

// Handle Edge Case: If query don't return any record 
if (!count($user)) {
    $_SESSION["errors"] = ["Error: Record not found!"];
    redirect('/assignment-2/pages/error.php');
} else {
    $user = array_pop($user);
}
?>

<div class="container mt-5">

    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Your Profile</h1>
            <h6 class="text-muted"><?php echo $user['your_id']; ?></h6>
        </div>
        <div>
            <a href="/assignment-2/pages/profile-edit.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
    <hr class="mb-4">


    <!-- Profile Details Table -->
    <table class="table table-borderless">
        <tbody>
            <?php
            foreach ($user as $col => $val) {
                if ($col === 'id') continue
            ?>
                <tr>
                    <th><?php echo to_title($col); ?></th>
                    <td><?php echo $val; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Availability if academic Staff other than DC -->
    <?php if (!($_SESSION["user"]['role'] === 'student' || $_SESSION["user"]['role'] === 'dc')) { ?>

        <!-- Heading -->
        <h3 class="mt-5">Your Availability</h3>
        <hr class="mb-4">

        <!-- Availability Data -->
        <div>
            <table class="table table-borderless">
                <tbody>
                    <?php foreach ($availabilities as $availability) { ?>
                        <tr>
                            <!-- Select -->
                            <td width="300px">
                                <select class="custom-select availability-select" required disabled data-id="<?php echo $availability['id']; ?>">
                                    <?php foreach ($AVAILABILITIES as $availability_arr) { ?>
                                        <option value="<?php echo $availability_arr; ?>" <?php echo ($availability_arr === $availability['available_day'])  ? "selected" : ""; ?>>
                                            <?php echo to_title($availability_arr); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label class="error d-none" data-id="<?php echo $availability['id']; ?>">Selected day is already reserved!</label>
                            </td>

                            <!-- Actions -->
                            <td class="d-flex align-items-center">
                                <form action="/assignment-2/actions/update-academic-staff-availability.php" method="post" data-id="<?php echo $availability['id']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $availability['id']; ?>">
                                    <input type="hidden" name="available_day" data-select-value="<?php echo $availability['id']; ?>">
                                    <i class="bx bx-pencil edit-availability text-primary cursor-pointer" data-id="<?php echo $availability['id']; ?>"></i>
                                </form>
                                <form action="/assignment-2/actions/delete-record.php" method="post">
                                    <input type="hidden" name="table_name" value="availability">
                                    <input type="hidden" name="id" value="<?php echo $availability['id']; ?>">
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
        </div>

        <a href="/assignment-2/pages/add-academic-staff-availability.php" class="btn btn-primary" style="margin-left:11px">Add New</a>
    <?php } ?>
</div>

<?php include_once('../_partials/scripts.php') ?>
<script>
    // Functions
    var find_duplicates = function(arr) {
        return arr.filter(function(item, index) {
            return arr.indexOf(item) != index;
        })
    }

    var select = null
    var id = null
    $(".edit-availability").click(function(e) {
        e.preventDefault();
        id = $(this).data("id");
        select = $('select[data-id=' + id + ']').removeAttr("disabled");
    });

    $(".availability-select").change(function(e) {
        e.preventDefault();
        var selected_day = $(this).children("option:selected").val();

        var all_select = $(".availability-select");

        var selected_values = [];
        all_select.each(function(index, value) {
            selected_values.push($(value).children("option:selected").val());
        });

        // Get duplicates
        var duplicates = find_duplicates(selected_values);

        // If duplicates found => show err
        // Else submit form
        if (duplicates.length) {
            // style=color:red;margin-top:7px;margin-bottom:0
            $('label[data-id=' + id + ']').removeClass('d-none');
        } else {
            $('input[data-select-value=' + id + ']').val(selected_day);
            $('form[data-id=' + id + ']').submit();
        }

        // var selected_values = [];
        // for (let index = 0; index < all_select.length; index++) {
        //     $select_val = all_select[index].children("option:selected").val();
        //     selected_values.push($select_val);
        // }
        // console.log('selected_values :>> ', selected_values);
    });
</script>
<?php include_once('../_partials/footer.php') ?>
