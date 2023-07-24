<?php
session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/config/assets_path.php';
require_once '../../../app/src/employee/EmployeeController.class.php';
require_once '../../../app/core/Redirect.php';


redirect_not_authenticated_user($_SESSION['user'], LOGIN);
redirect_cashiers_customers();

$title = 'Employee List';

$employeeController = new EmployeeController();

$employees = $employeeController->getAllEmployee();


?>


<?php require_once '../../../app/src/includes/admin/header.php' ?>

<?php if ($_SESSION['user']['user_level'] === '1') : ?>

    <?php require_once '../../../app/src/includes/admin/panel.php' ?>

<?php endif; ?>

<section class="intro">
    <!-- add a add button -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Employee List</h1>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-image h-100 tbl-bg-image">
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0,0,0,.35);">

            <div class="container">
                <?php if (isset($_GET['message'])) : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong> <?= $_GET['message'] ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= PAGE2 ?>" class="btn btn-primary btn-sm">Add Employee</a>

                    <?php if ($_SESSION['user']['user_level'] === '2') : ?>

                        <a href="<?= LOGOUT ?>" class="btn btn-light btn-sm">Sign out</a>

                    <?php endif; ?>

                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive bg-white" data-mdb-perfect-scrollbar="true" style="position: relative; width: auto;">
                            <table class="table bg-light">
                                <thead>
                                    <tr>
                                        <th scope="col">EMPLOYEES</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">DESIGNATION</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">GROSS INCOME</th>
                                        <th scope="col">NET INCOME</th>
                                        <th scope="col">TOTAL DEDUCTION</th>
                                        <th scope="col">ACTIONs</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if ($employees) : ?>
                                        <?php foreach ($employees as $employee) : ?>

                                            <tr>

                                                <!-- Emp basic info -->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?= UPLOADS_PATH . '/emp_img' . '/' . $employee['emp_img'] ?>" alt="<?= $employee['emp_img'] ?>" style="width: 45px; height: 45px" class="rounded-circle" />

                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?= $employee['f_name'] ?>

                                                                <?= $employee['l_name'] ?>
                                                            </p>
                                                            <!-- <p class="text-muted mb-0">john.doe@gmail.com</p> -->
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Emp statuses  -->
                                                <td>
                                                    <p class="fw-normal mb-1 text-info">
                                                        Civil Status:
                                                        <span class="text-danger"><?= strtoupper($employee['emp_civil_status']) ?>
                                                        </span>
                                                    </p>
                                                    <p class="fw-normal text-info mb-1">
                                                        Employee Position:
                                                        <span class="text-dark">
                                                            <?= strtoupper($employee['emp_status']) ?>
                                                        </span>
                                                    </p>
                                                </td>

                                                <!-- Emp DESIGNATION -->
                                                <td>
                                                    <span class="badge badge-success rounded-pill d-inline text-dark">
                                                        <?= $employee['designation'] ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <p class="text-muted mb-0">
                                                        <?= strtoupper($employee['department']) ?> Department
                                                    </p>
                                                </td>

                                                <!-- Emp GROSS INCOME -->
                                                <td>
                                                    <span class="badge badge-info rounded-pill d-inline ">
                                                        <?= $employee['gross_income'] ?>
                                                    </span>
                                                </td>

                                                <!-- Net Income -->
                                                <td>
                                                    <span class="badge badge-info rounded-pill d-inline">
                                                        <?= $employee['net_income'] ?>
                                                    </span>
                                                </td>

                                                <!-- Total Deduction -->
                                                <td>
                                                    <span class="badge badge-danger rounded-pill d-inline">
                                                        <?= $employee['total_deduction'] ?>
                                                    </span>
                                                </td>

                                                <td>

                                                    <a href="<?= EMPLOYEE_PATH['edit'] ?>/index.php?emp_id=<?= $employee['emp_id'] ?>" class="btn btn-link btn-sm btn-rounded">
                                                        Edit or View
                                                    </a>

                                                    <a href="<?= EMPLOYEE_PATH['delete'] ?>/index.php?emp_id=<?= $employee['emp_id'] ?>" class="btn btn-link btn-sm btn-rounded">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>


                                        <?php endforeach; ?>

                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No Employee Found</td>
                                        </tr>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../../../app/src/includes/admin/footer.php'; ?>