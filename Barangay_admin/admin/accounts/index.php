<?php

session_start();

require_once '../../app/config/env.php';
require_once '../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_auth_user_level($_SESSION['user']['user_level'], 1, ACCOUNTS_PATH['list']);

redirect_not_admin();
