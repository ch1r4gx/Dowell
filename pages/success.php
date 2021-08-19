<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>

<div class="container">
    <?php
    $success = $_SESSION["success"];
    unset($_SESSION['success']);
    ?>
    <div class="mt-5">
        <?php foreach ($success['messages'] as $msg) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
    </div>
    <a href="<?php echo $success['link']['path']; ?>" class="btn btn-primary"><?php echo $success['link']['label']; ?></a>
</div>

<?php include_once('../_partials/scripts.php') ?>
<?php include_once('../_partials/footer.php') ?>
