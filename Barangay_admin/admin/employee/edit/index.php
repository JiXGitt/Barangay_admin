<?php
session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/config/assets_path.php';
require_once '../../../app/core/Redirect.php';
require_once '../../../app/libs/Image.php';


redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_cashiers_customers();

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_cashiers_customers();

require_once '../../../app/src/employee/EmployeeController.class.php';

$title = 'Employee Edit Payroll';

// fetch the url params
$employee_id = $_GET['emp_id'];

// get the connection
$conn = DBConnection();

// get the Id and create a form to edit the product
$sql = "SELECT * FROM employee_tbl WHERE emp_id = ?";
// prepare the statement
$stmt = $conn->prepare($sql);
// bind the string parameters
$stmt->bind_param('i', $employee_id);
// execute the statement
$stmt->execute();
// get the result
$result = $stmt->get_result();
// fetch the data
$emp = $result->fetch_assoc();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $employeeController = new EmployeeController();
    $emp = $_POST;
    $emp_img = $_FILES['emp_img'];

    if (isset($_POST['calculate'])) {
        $errors = $employeeController->validateData($emp);

        if (empty($errors)) {

            $emp['pag_ibig_contrib'] = 100;
            // ===================== CALCULATIONS =====================

            // total basic pay
            $emp['total_basicpay'] = $emp['basicPay_rate_per_hr'] * $emp['basicPay_hrs_per_cutOff'];

            // total honorarium
            $emp['total_hono_pay'] = $emp['hono_rate_per_hr'] * $emp['hono_hrs_per_cutOff'];

            // total other income
            $emp['total_other_income_pay'] = $emp['other_income_rate_per_hr'] * $emp['other_income_num_of_hrs_per_cutOff'];


            // calculate phil health contirbutaion for 2023
            $emp['phil_health_contrib'] = $emp['total_basicpay'] * 0.0275;

            // calculate sss_contrib contribution for 2023
            if ($emp['total_basicpay'] <= 10000) {
                $emp['sss_contrib'] = $emp['total_basicpay'] * 0.11;
            } else {
                $emp['sss_contrib'] = 10000 * 0.11;
            }

            // calculate income tax contribution for 2023
            if ($emp['total_basicpay'] <= 250000) {
                $emp['tax_val'] = 0;
            } else if ($emp['total_basicpay'] <= 400000) {
                $emp['tax_val'] = ($emp['total_basicpay'] - 250000) * 0.2;
            } else if ($emp['total_basicpay'] <= 800000) {
                $emp['tax_val'] = ($emp['total_basicpay'] - 400000) * 0.25 + 30000;
            } else if ($emp['total_basicpay'] <= 2000000) {
                $emp['tax_val'] = ($emp['total_basicpay'] - 800000) * 0.3 + 130000;
            } else if ($emp['total_basicpay'] <= 8000000) {
                $emp['tax_val'] = ($emp['total_basicpay'] - 2000000) * 0.32 + 490000;
            } else {
                $emp['tax_val'] = ($emp['total_basicpay'] - 8000000) * 0.35 + 2410000;
            }

            // total regular deductions
            $total_regular_deductions = $emp['sss_contrib'] + $emp['phil_health_contrib'] + $emp['pag_ibig_contrib'] + $emp['tax_val'];

            // total other deductions
            $total_other_deductions = $emp['sss_loan'] + $emp['pag_ibig_loan'] + $emp['fac_savings_deposit'] + $emp['fac_savings_loan'] + $emp['salary_loan'] + $emp['others'];

            // total income
            $total_income = $emp['basicPay_hrs_per_cutOff'] + $emp['total_hono_pay'] + $emp['total_other_income_pay'];

            // total deductions
            $emp['total_deduction'] = $total_regular_deductions  + $total_other_deductions;

            // gross income
            $emp['gross_income'] = $emp['total_basicpay'] + $emp['total_hono_pay'] + $emp['total_other_income_pay'];

            // net income
            $emp['net_income'] = $emp['gross_income'] - $emp['total_deduction'];

            // ===================== END CALCULATIONS =====================
        }
    }

    if (isset($_POST['save'])) {
        // empty data
        $errors = $employeeController->validateData($emp);

        if (empty($errors)) {

            $image = new ImageUpload($emp_img);

            $errors = $image->validateImage();

            if (empty($errors)) {

                $fileDestination = '../../../public/uploads/emp_img/';
                $new_img = $image->uploadImage($fileDestination);

                $emp['emp_img'] = $new_img;

                $insertEmployee = $employeeController->updateEmployee($emp);

                if ($insertEmployee) {
                    redirect_with_params(EMPLOYEE_PATH['list'] . '/', ['message' => 'Employee updated successfully', 'alert' => 'success']);
                } else {
                    $errors['error_name'] = 'Something went wrong';
                }
            }
        }
    }

    if (isset($_POST['clear'])) {
        $emp = [];
        $errors['error_name'] = 'This will not clear the data permanently nor delete the data in the database but will clear the data temporarily based on the current session';
    }

    if (isset($_POST['back'])) {
        redirect_with_params(EMPLOYEE_PATH['list'] . '/', ['message' => '']);
    }
}

?>


<?php require_once  '../../../app/src/includes/header.inc.php'; ?>

<div class="container bg-body rounded shadow justify-content-center align-items-center font-monospace">
    <div class="display-4 text-center">
        Employee Payroll System
    </div>

    <!-- display errors in the most good way -->
    <?php if (isset($errors['error_name'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="list-unstyled">
                <li><?= $errors['error_name']; ?></li>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="bg-very-light-gray" method="POST" enctype="multipart/form-data">

        <div class="accordion-body">

            <hr>
            <!--  First Row  -->
            <?php require_once '../../../app/src/includes/page2-form/1st_row.php' ?>

            <hr>
            <!-- Second Row -->
            <?php require_once '../../../app/src/includes/page2-form/2nd_row.php' ?>

            <hr>
            <!-- Third ROw -->
            <?php require_once '../../../app/src/includes/page2-form/3rd_row.php' ?>

            <hr>
            <!-- 4th Row -->
            <?php require_once '../../../app/src/includes/page2-form/4th_row.php' ?>

            <hr>
            <!-- 5th Row -->
            <?php require_once '../../../app/src/includes/page2-form/5th_row.php' ?>


        </div>

        <div class="btn-group gap-3 m-4 translate-middle-y" role="group" aria-label="Basic outlined example">

            <button name="calculate" type="submit" class="btn btn-outline-success">CALCULATE</button>

            <button name="save" type="submit" class="btn btn-outline-info">
                SAVE
            </button>

            <button name='clear' type="submit">CLEAR</button>

            <button name="back" type="submit" class="btn btn-outline-danger">DISCARD CHANGES</button>

        </div>

        <!-- put the exit button on the end side -->
        <div class="btn-group gap-3 m-4 translate-middle-y" role="group" aria-label="Basic outlined example">
            <a href="<?= LOGOUT ?>" name="exit" class="btn btn-outline-danger">LOGOUT</a>
        </div>

    </form>
</div>


<script>
    const fileInput = document.querySelector('#file-js-example input[type=file]');
    fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            const fileName = document.querySelector('#file-js-example .file-name');
            fileName.textContent = fileInput.files[0].name;
        }
    }
</script>

<?php require_once  '../../../app/src/includes/footer.inc.php'; ?>