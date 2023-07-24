<?php

require_once __DIR__ .  "../../../../config/Connection.php";

// count the total users from accounts table

class DashboardController
{
    public static function countUsers()
    {
        $conn = DBConnection();
        // conut in the most efficient way
        $users = "SELECT * FROM accounts";

        // count the total users
        $total_users = mysqli_query($conn, $users);
        $total_users = mysqli_num_rows($total_users);

        return $total_users;
    }

    public static function countProducts()
    {
        $conn = DBConnection();
        // conut in the most efficient way
        $products = "SELECT * FROM main_foods_tbl";

        // count the total users
        $total_products = mysqli_query($conn, $products);
        $total_products = mysqli_num_rows($total_products);

        return $total_products;
    }

    public static function countSales()
    {
        $conn = DBConnection();
        // conut in the most efficient way
        $sales = "SELECT * FROM sales";

        // summarize the total sales
        // total the sales
        $total_sales = mysqli_query($conn, $sales);
        $total_sales = mysqli_num_rows($total_sales);

        return $total_sales;
    }

    public static function countEmployees()
    {
        $conn = DBConnection();
        // conut in the most efficient way
        $employees = "SELECT * FROM employee_tbl";

        // count the total users
        $total_employees = mysqli_query($conn, $employees);
        $total_employees = mysqli_num_rows($total_employees);

        return $total_employees;
    }
}


?>
<div class="wrapper admin-background">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="" class="simple-text logo-normal">
                <div class="logo-image-big">
                    <img src="<?= IMG_ASSETS_PATH ?>/Restaurant Food.png" alt='logo'>
                </div>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active ">
                    <a href="<?= ADMIN ?>">
                        <!-- dashboard icon using font awesome -->
                        <i class="fa-solid fa-universal-access"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active text-danger">
                    <a href="<?= PRODUCT_PATH['list'] ?>" class="text-info-dark">
                        <!-- product icon -->
                        <i class="fa-solid fa-utensils"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="active text-danger">
                    <a href="<?= ACCOUNTS_PATH['list'] ?>">
                        <i class="fa-solid fa-user-tag"></i>
                        <p>User Accounts</p>
                    </a>
                </li>
                <li class="active text-danger">
                    <a href="<?= EMPLOYEE_PATH['list'] ?> ">
                        <i class="fa-solid fa-sheet-plastic"></i>
                        <p>Employees Payroll</p>
                    </a>
                </li>
                <li class="active text-danger">
                    <a href="<?= SALES_PATH['list'] ?>">
                        <i class="fa-solid fa-chart-line"></i>
                        <p>Sales</p>
                    </a>
                </li>

                <li class="active text-danger">
                    <a href="<?= MAINFOODPAGE_ALT ?>">
                        <i class="fa-solid fa-earth-europe"></i>
                        <p>View Site</p>
                    </a>
                </li>

                <li class="active text-danger py-5">
                    <a href="<?= LOGOUT ?>" class="logout">
                        <span class="icon is-small"><i class="fa-solid fa-sign-out"></i></span>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <!-- style the header like the modern dat -->
                    <a class="navbar-brand" href="javascript:;">Food House Admin</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link btn-rotate">

                                <img src="<?= IMG_ASSETS_PATH ?>/default-avatar.png" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 30px; height: 30px;">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="fs-6 text-success-emphasis">Total Users</p>
                                        <p class="fs-3">
                                            #<?= DashboardController::countUsers() ?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <a href="<?= ACCOUNTS_PATH['list'] ?>" class="btn rounded-5">
                                <i class="fa-solid fa-share"></i>
                                View
                            </a>
                            <a href="<?= ACCOUNTS_PATH['create'] ?>" class="btn rounded-5">
                                <i class="fa-solid fa-plus"></i>
                                Add
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-4">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa-solid fa-chart-line text-danger-emphasis"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="fs-6 text-info-emphasis">Total Number of Created Sales</p>
                                        <p class="fs-5">
                                            # <?= DashboardController::countSales() ?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>

                            <!-- sales path -->
                            <a href="<?= SALES_PATH['list'] ?>" class="btn rounded-5">
                                <i class="fa-solid fa-share"></i>
                                View
                            </a>

                            <a href="<?= PAGE3 ?>" class="btn rounded-5">
                                <i class="fa-solid fa-plus"></i>
                                Add
                            </a>
                            <!-- <a href=" ?>" class="btn rounded-5">
                                <i class="fa-solid fa-plus"></i>
                                Add
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-warning-emphasis">
                                        <i class="fa-solid fa-people-group"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="very-small-text">Total Employees</p>
                                        <p class="fs-5">
                                            # <?= DashboardController::countEmployees() ?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer row">
                            <hr>
                            <!-- employee path -->
                            <a href="<?= EMPLOYEE_PATH['list'] ?>" class="btn rounded-5 col">
                                <i class="fa-solid fa-share"></i>
                                View
                            </a>
                            <a href="<?= PAGE2 ?>" class=" btn rounded-5 col">
                                <i class="fa-solid fa-plus"></i>
                                Add
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-dark-emphasis">
                                        <i class="fa-brands fa-product-hunt"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="very-small-text">
                                            Total Products
                                        </p>
                                        <p class="fs-5">
                                            #<?= DashboardController::countProducts() ?>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer row">
                            <hr>

                            <!-- Product path -->
                            <a href="<?= PRODUCT_PATH['list'] ?>" class="btn rounded-5 col">
                                <i class="fa-solid fa-share"></i>
                                View
                            </a>
                            <a href="<?= PRODUCT_PATH['create'] ?>" class=" btn rounded-5 col">
                                <i class="fa-solid fa-plus"></i>
                                Add
                            </a>
                        </div>
                    </div>
                </div>
            </div>