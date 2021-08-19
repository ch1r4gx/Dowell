<?php include_once('../_partials/header.php') ?>
<?php include_once('../_partials/navbar.php') ?>

<div class="container">
    <?php
    $errors = $_SESSION["errors"];
    unset($_SESSION['errors']);
    ?>
    <div class="mt-5">
        <?php foreach ($errors as $err) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $err; ?>
            </div>
        <?php } ?>
    </div>
    <button type="button" id="navigation-go-back" class="btn btn-primary">Go Back</button>
</div>

<?php include_once('../_partials/scripts.php') ?>
<script>
    $("#navigation-go-back").click(function(e) {
        e.preventDefault();
        window.history.back();
    });
</script>
<?php include_once('../_partials/footer.php') ?>
