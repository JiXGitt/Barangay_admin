<?php

session_start();

require_once  '../../../app/config/env.php';
require_once __DIR__ . '../../../../app/config/assets_path.php';
require_once '../../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_cashiers_customers();

// get the id from the url
$employee_id = $_GET['emp_id'];

require_once '../../../app/config/Connection.php';

// get the connection
$conn = DBConnection();

$img = "SELECT emp_img FROM employee_tbl WHERE emp_id = '$employee_id'";

$result = $conn->query($img);

$row = $result->fetch_assoc();

// remove the imge from the  emp_img folder
unlink('../../../public/uploads/emp_img/' . $row['emp_img']); 

// sql query
$sql = "DELETE FROM employee_tbl WHERE emp_id = ?";

// prepare the statement
$stmt = $conn->prepare($sql);

// bind the parameters
$stmt->bind_param('i', $employee_id);

// execute the statement
$stmt->execute();

// close the connection
CloseConnection($conn);

redirect_with_params(EMPLOYEE_PATH['list'], ['success' => 'Employee deleted successfully!']);