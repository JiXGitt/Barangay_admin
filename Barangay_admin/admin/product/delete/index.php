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

$img = "SELECT img FROM main_foods_tbl WHERE id = '$id'";

$result = $conn->query($img);

$row = $result->fetch_assoc();

unlink('../../../public/uploads/' . $row['img']);

// sql query
$sql = "DELETE FROM main_foods_tbl WHERE id = ?";

// prepare the statement
$stmt = $conn->prepare($sql);

// bind the parameters

$stmt->bind_param('i', $id);

// execute the statement
$stmt->execute();

// close the connection
CloseConnection($conn);

// redirect to the list page
header('location: '. PRODUCT_PATH['list']);
