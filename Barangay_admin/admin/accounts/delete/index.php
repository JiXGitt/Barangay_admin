<?php

session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/config/assets_path.php';
require_once '../../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_not_admin();

// get the id from the url
$id = $_GET['id'];

require_once '../../../app/config/Connection.php';

// get the connection
$conn = DBConnection();

// sql query
$sql = "DELETE FROM accounts WHERE user_id = ?";

// prepare the statement
$stmt = $conn->prepare($sql);

// bind the parameters
$stmt->bind_param('i', $id);

// execute the statement
$stmt->execute();

// close the connection
CloseConnection($conn);

// redirect to the list page
if ($stmt) {
    $_SESSION['success'] = 'User deleted successfully!';
    header('location: ' . ACCOUNTS_PATH['list']);
}