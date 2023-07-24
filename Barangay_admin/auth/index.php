<?php

session_start();

require_once '../app/core/Redirect.php';
require_once '../app/config/env.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_all();