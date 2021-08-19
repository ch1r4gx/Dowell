<?php
include_once("$path_prefix/db/db_functions.php");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">University of DoWell</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Left Side of Navbar -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/assignment-2/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if (is_role(['dc'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/assignment-2/pages/unit-list.php">Units</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/assignment-2/pages/academic-staff-list.php">Academic Staff</a>
                </li>
            <?php } ?>
            <?php if (is_role(['student'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Unit Enrollment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Timetable</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tutorial Allocation</a>
                </li>
            <?php } ?>
            <?php if (is_role(['dc', 'uc', 'lecturer', 'tutor'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/assignment-2/pages/enrolled-students.php">Enrolled Students</a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="/assignment-2/pages/_skelton.php">Skelton</a>
            </li>
        </ul>

        <!-- Right side of navbar -->
        <div class=<?php echo array_key_exists("user", $_SESSION) ? "" : "d-none" ?>>
            <div class="d-flex">
                <form action="/assignment-2/actions/signout.php" method="post">
                    <button type="submit" class="btn btn-link"><span class="text-light">Logout</span></button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/assignment-2/pages/profile.php">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
