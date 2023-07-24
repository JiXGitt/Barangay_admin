<?php

session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/core/Redirect.php';
require_once '../../../app/config/assets_path.php';


redirect_not_authenticated_user($_SESSION['user'], LOGIN);

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['user_level'] === '0') {
        header('Location:' . PAGE3);
    } else if ($_SESSION['user']['user_level'] === '2') {
        header('Location:' . PAGE2);
    }
}

require_once '../../../app/config/Connection.php';


$title = "Product List";

// display all products

$conn = DBConnection();

$sql = "SELECT * FROM main_foods_tbl";

$result = $conn->query($sql);

?>



<?php require_once '../../../app/src/includes/admin/header.php' ?>


<style>
    .very-small-text {
        font-size: 0.85rem;
    }

    /* cool admin background color */
    .admin-background {
        /* make admin background color more robust and unique */
        background-image: linear-gradient(315deg, #f5f5f5 0%, #e7e7e7 74%);
    }
</style>

<?php require_once '../../../app/src/includes/admin/panel.php' ?>

<div class="container-fluid admin-background">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Product List</h4>
                </div>
                <!-- add product page -->
                <div class="card-body">
                    <a href="<?= PRODUCT_PATH['create'] ?>" class="btn btn-primary btn-sm">Add Product</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    ID
                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td>
                                            <?= $row['id'] ?>
                                        </td>
                                        <td>
                                            <?= $row['food_name'] ?>
                                        </td>
                                        <td>
                                            <?= $row['price'] ?>
                                        </td>
                                        <td>
                                            <img src="<?= UPLOADS_PATH ?>/<?= $row['img'] ?>" alt="<?= $row['food_name'] ?>" width="100px">
                                        </td>

                                        <td>
                                            <a href="<?= PRODUCT_PATH['edit'] ?>/index.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>

                                            <a href="<?= PRODUCT_PATH['delete'] ?>/index.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../../app/src/includes/admin/footer.php' ?>