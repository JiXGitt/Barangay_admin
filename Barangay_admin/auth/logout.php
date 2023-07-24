<!-- logout -->
<?php
session_start();
require_once '../app/src/auth/UserController.class.php';

// redirect to login page if not logged in
redirect_not_authenticated_user($_SESSION['user'], LOGIN);


$user = UserController::logout();
// unset employee data in session
unset($_SESSION['employee_data']);
redirect_not_authenticated_user($_SESSION['user'], LOGIN);