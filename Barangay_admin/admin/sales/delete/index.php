<?php

session_start();

require_once  '../../../app/config/env.php';
require_once __DIR__ . '../../../../app/config/assets_path.php';
require_once '../../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_not_admin();

require_once __DIR__ . '../../../../app/src/sales/SalesController.class.php';

// get the id from the url
$sales_id = $_GET['id'];

$sales_del = SalesController::removeSales('sales_id', $sales_id);

if ($sales_del) {
    redirect_with_params(SALES_PATH['list'], ['message' => 'Employee deleted successfully!']);

    CloseConnection($conn);
}

else {
    redirect_with_params(SALES_PATH['list'], ['message' => 'Employee not deleted!']);
}