<?php

session_start();

require_once '../../app/config/env.php';
require_once '../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

if (isset($_SESSION['user'])) {

    switch ($_SESSION['user']['user_level']) {
        case '0':
            header('Location:' . PAGE3);
            break;
        case '1':
            header('Location:' . EMPLOYEE_PATH['list']);
            break;
        case '2':
            header('Location:' . EMPLOYEE_PATH['list']);
            break;
        case '3':
            header('Location:' . MAINFOODPAGE_ALT);
            break;
    }
}