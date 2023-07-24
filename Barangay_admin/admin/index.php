<?php

session_start();

require_once '../app/config/env.php';
require_once '../app/config/assets_path.php';
require_once '../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_not_admin();


$title = 'Dashboard';

?>

<?php require_once '../app/src/includes/admin/header.php' ?>

<style>
    .very-small-text {
        font-size: 0.85rem;
    }

    /* cool admin background color */
    .admin-background {
        /* make admin background color more robust and unique */
        background-image: linear-gradient(315deg, #f5f5f5 0%, #e7e7e7 74%);
    }
</style>

<?php require_once '../app/src/includes/admin/panel.php' ?>

<div>
    <!-- add a descriptive content in here  -->
</div>


<?php require_once '../app/src/includes/admin/footer.php'; ?>