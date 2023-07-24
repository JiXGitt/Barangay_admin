<?php
session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/config/assets_path.php';
require_once '../../../app/core/Redirect.php';
require_once '../../../app/libs/Image.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_not_admin();

require_once '../../../app/core/Model.php';
require_once '../../../app/src/auth/UserView.php';

$title = 'Update User Account';

// fetch the url params
$user_id = $_GET['id'];

$errors = [];
$user = [];
$user = getUserById($user_id);

$userView = new UserView();

if (isset($_POST['update'])) {
    $user = $_POST;

    $userView->setData($user);
    $errors = $userView->validateUserInAdminForm();


    if (empty($errors)) {

        $updated_user = updateUser($user);

        if ($updated_user) {
            $_SESSION['success'] = 'User '. $user['user_id']  .' account updated successfully';
            header('location: ' . ACCOUNTS_PATH['list']);
        }
    }

}


?>
<?php require_once '../../../app/src/includes/admin/header.php' ?>

<style>
    .error {
        /* styles error message based on the modern day */
        background: #f2dede;
        color: #a94442;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ebccd1;

    }

    /* animate error */
    .error {
        animation: shake 0.5s;
        /* make animation stop */
        animation-iteration-count: 1;
    }

    /* shake keyframes */
    @keyframes shake {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }

        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }

        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }

        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }

        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }

        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }

        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }

        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }

        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }

        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }

        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }
</style>

<?// require_once '../../../app/src/includes/admin/panel.php' ?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h4 fw-bold mb-3 mx-1 mx-md-4 mt-4">Update User Account</p>

                                <form class="mx-1 mx-md-4" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

                                    <?php if (isset($errors['username'])) : ?>
                                        <div class="error">
                                            <?= $errors['username'] ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>

                                        <div class="form-outline flex-fill mb-0">
                                            <input name="<?= USERNAME[0] ?>" type="text" placeholder="Enter a valid username here" id="form3Example1c" class="form-control" value="<?= $user['username'] ?>" />

                                            <label class="form-label" for="form3Example1c">
                                                Username
                                            </label>
                                        </div>
                                    </div>

                                    <!-- error message here -->
                                    <?php if (isset($errors['user_level'])) : ?>
                                        <div class="error">
                                            <?= $errors['user_level'] ?>
                                        </div>
                                    <?php endif ?>
                                    <!-- use a modern seleect option style using bootstrap -->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid  fa-person-circle-question fa-lg fa-fw me-3"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <select name="user_level" class="form-select" aria-label="Default select example">
                                             
                                                    <option value="<?= $user['user_level'] ?>" selected>

                                                        <?php if ($user['user_level'] == 0) : ?>
                                                            Cashier
                                                        <?php elseif ($user['user_level'] == 1) : ?>
                                                            Admin
                                                        <?php elseif ($user['user_level'] == 2) : ?>
                                                            Accounting/HR
                                                        <?php elseif ($user['user_level'] == 3) : ?>
                                                            Regular User
                                                            <!-- default -->
                                                        <?php else : ?>
                                                            Select User Level
                                                        <?php endif ?>
                                                    </option>
                                                <option value="0">Cashier</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Accounting/HR</option>
                                                <option value="3">Regular User</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name='update' class="btn btn-primary btn-lg">Update</button>
                                        <a href="<?= ACCOUNTS_PATH['list'] ?>" class="btn btn-danger btn-lg">Discard</a>
                                    </div>


                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="<?= IMG_ASSETS_PATH . '/Restaurant Food.png' ?>" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once '../../../app/src/includes/admin/footer.php' ?>