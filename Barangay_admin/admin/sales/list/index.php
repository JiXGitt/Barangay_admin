<?php
session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/config/assets_path.php';

require_once '../../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_hr_accoutant();

require_once '../../../app/src/sales/SalesController.class.php';


$title = 'Sales | KTS';

$errors = [];

$sales = SalesController::getAllSales();

?>
<?php require_once '../../../app/src/includes/admin/header.php' ?>

<?php if ($_SESSION['user']['user_level'] === '1') : ?>
    <?php require_once '../../../app/src/includes/admin/panel.php' ?>
<?php endif ?>

<div class="container-fluid admin-background">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Sales List</h4>
                </div>
                <!-- add a logout button at the end -->
                <?php if ($_SESSION['user']['user_level'] === '0') : ?>
                    <div class="card-body">
                        <a href="<?= LOGOUT ?>" class="btn btn-danger btn-sm">
                            Sign Out
                        </a>
                    </div>
                <?php endif ?>

                <!-- add product page -->
                <div class="card-body">
                    <a href="<?= PAGE3 ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Add Sales
                    </a>
                    <a href="<?= MAINFOODPAGE_ALT ?>" class="btn btn-warning btn-sm">FOODS</a>
                </div>




                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (empty($sales)) : ?>
                            <div>
                                <h1 class="text-center">
                                    No sales yet
                                </h1>
                            </div>
                        <?php else : ?>
                            <table class="table">

                                <thead class=" text-primary">
                                    <th>
                                        Sales ID
                                    </th>
                                    <th>
                                        Sales Item
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Discount Amount
                                    </th>
                                    <th>
                                        Discounted Amount
                                    </th>
                                    <th>
                                        Discounted Given
                                    </th>
                                    <th>
                                        Cash Value
                                    </th>
                                    <th>
                                        Change
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    <th>
                                        Date Created
                                    </th>
                                </thead>
                                <tbody>

                                    <?php foreach ($sales as $row) : ?>
                                        <tr>
                                            <td class="text-dark">
                                                <?= $row['sales_id'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['item_name'] ?>
                                            </td class="text-dark">
                                            <td class="text-dark">
                                                <?= $row['item_price'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['quantity'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['discount_amount'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['discounted_amount'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['totalDiscountedGiven'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['cash_value'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['change_value'] ?>
                                            </td>

                                            <td>
                                                <a href="<?= SALES_PATH['delete'] ?>/index.php?id=<?= $row['sales_id'] ?>" class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                            </td>

                                            <td class="text-dark">
                                                <?= $row['date_created'] ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../../app/src/includes/admin/footer.php'; ?>