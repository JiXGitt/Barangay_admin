<?php

session_start();

require_once '../app/config/env.php';
require_once '../app/config/assets_path.php';
require_once '../app/core/Redirect.php';
require_once '../app/src/auth/UserController.class.php';


redirect_all();

$title = 'Auth | Register Account';

$username = '';

// handle form submission
if (isset($_POST['submit'])) {

    $username = $_POST[USERNAME[0]];
    $user_password = $_POST[PASSWORD[0]];
    $confirm_password = $_POST['confirm-password'];

    $user = new UserController($username, $user_password);
    $user->set_confirm_password($confirm_password);

    $errors = $user->validateFormRegister();

    if (empty($errors)) {
        $user->register();
    }
}

?>

<?php require_once '../app/src/includes/auth/header.inc.php' ?>

<div class="center">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h1>Register</h1>
        <div class="txt_field">
            <input type="text" name="<?= USERNAME[0] ?>" value="<?= $username ?>" required>
            <span></span>
            <label><?= USERNAME[1] ?></label>
        </div>
        <!-- output username error -->
        <?php if (isset($errors['username'])) : ?>
            <div class="error">
                <?= $errors['username'] ?>
            </div>
        <?php endif ?>

        <div class="txt_field">
            <input type="password" name="<?= PASSWORD[0] ?>" required>
            <span></span>
            <label><?= PASSWORD[1] ?></label>
        </div>
        <!-- output password error -->
        <?php if (isset($errors['user_password'])) : ?>
            <div class="error">
                <?= $errors['user_password'] ?>
            </div>
        <?php endif ?>

        <div class="txt_field">
            <input type="password" name="confirm-password" required>
            <span></span>
            <label>Confirm Password</label>
        </div>

        <!-- output confirm password error -->
        <?php if (isset($errors['confirm_password'])) : ?>
            <div class="error">
                <?= $errors['confirm_password'] ?>
            </div>
        <?php endif ?>


        <input type="submit" name="submit" value="Register">

        <div class="signup_link">
            already have an account? <a href="<?= LOGIN ?>">Login</a>
        </div>
    </form>
</div>


<?php require_once '../app/src/includes/auth/footer.inc.php' ?>