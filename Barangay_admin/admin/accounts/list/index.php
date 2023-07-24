<?php
session_start();

require_once '../../../app/config/env.php';
require_once '../../../app/config/assets_path.php';

require_once '../../../app/core/Redirect.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);

redirect_not_admin();

require_once '../../../app/core/Model.php';

$title = 'Users List';

$errors = [];

$users = getUsers();

?>
<?php require_once '../../../app/src/includes/admin/header.php' ?>

<?php require_once '../../../app/src/includes/admin/panel.php' ?>

<div class="container-fluid admin-background">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">
                        High Position Users List
                    </h4>
                </div>

                <!-- add a message here -->
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success text-center">
                        <?php echo $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php endif ?>

                <!-- add product page -->
                <div class="card-body">
                    <a href="<?= ACCOUNTS_PATH['create'] ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Add User
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (empty($users)) : ?>
                            <div>
                                <h1 class="text-center">
                                    <!-- add a sad face -->
                                    No Users Found :(
                                </h1>
                            </div>
                        <?php else : ?>
                            <table class="table">

                                <thead class=" text-primary">
                                    <th>
                                        User ID
                                    </th>
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        User Level
                                    </th>
                                    <th>
                                        Date Created
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>

                                    <?php foreach ($users as $row) : ?>
                                        <tr>
                                            <td class="text-dark">
                                                <?= $row['user_id'] ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= $row['username'] ?>
                                            </td class="text-dark">
                                            <td class="text-dark">
                                                <?= $row['user_level'] ?>
                                            </td>

                                            <td class="text-danger">
                                                <?= $row['date_created'] ?>
                                            </td>


                                            <td>
                                                <a href="<?= ACCOUNTS_PATH['edit'] ?>/index.php?id=<?= $row['user_id'] ?>" class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>

                                                <a href="<?= ACCOUNTS_PATH['delete'] ?>/index.php?id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
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