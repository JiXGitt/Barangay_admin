<?php

session_start();
require_once '../../../app/config/env.php';
require_once '../../../app/core/Redirect.php';
require_once '../../../app/config/assets_path.php';

redirect_not_authenticated_user($_SESSION['user'], LOGIN);
redirect_not_admin();

// get the id from the url
$id = $_GET['id'];

// validate the id
if (!is_numeric($id)) {
    header('location: '. PRODUCT_PATH['list']);
}

require_once '../../../app/config/Connection.php';

// get the connection
$conn = DBConnection();

// get the Id and create a form to edit the product
$sql = "SELECT * FROM main_foods_tbl WHERE id = ?";
// prepare the statement
$stmt = $conn->prepare($sql);
// bind the parameters
$stmt->bind_param('i', $id);
// execute the statement
$stmt->execute();
// get the result
$result = $stmt->get_result();
// fetch the data
$product = $result->fetch_assoc();

$title = "Edit Product";

// if form is submitted
if (isset($_POST['submit'])) {
    // get form data
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_FILES['product_img'];

    $img_name = $_FILES['product_img']['name'];
    $img_tmp = $_FILES['product_img']['tmp_name'];
    $img_size = $_FILES['product_img']['size'];
    $img_error = $_FILES['product_img']['error'];
    $img_type = $_FILES['product_img']['type'];

    // validate form data
    $errors = [];

    $file_ext = explode('.', $img_name);
    $actualExt = strtolower(end($file_ext));

    // allowed file ext
    $allowed_ext = array('jpg', 'jpeg', 'png');

    if (in_array($actualExt, $allowed_ext)) {
        if ($img_error === 0) {
            if ($img_size < 1000000) {

                $new_img = time() . '_' . $actualExt;
                $fileDestination = '../../../public/uploads/' . $new_img;
                move_uploaded_file($img_tmp, $fileDestination);

                $conn = DBConnection();
                // replace the product image in the database
                $sql = "UPDATE main_foods_tbl SET food_name = ?, price = ?, img = ? WHERE id = ?";

                // prepare the statement
                $stmt = $conn->prepare($sql);

                // bind the parameters
                $stmt->bind_param('sssi', $product_name, $product_price, $new_img, $id);

                // execute the statement
                $stmt->execute();

                // close the connection
                CloseConnection($conn);

                // redirect to the list page
                header('location: '. PRODUCT_PATH['list']);
                
            } else {
                $errors['error_img'] = 'Image size is too big';
            }
        } else {
            $errors['error_img'] = 'There was an error uploading the image';
        }
    } else {
        $errors['error_img'] = 'You cannot upload files of this type';
    }
}

?>


<?php require_once '../../../app/src/includes/admin/header.php' ?>
<?php require_once '../../../app/src/includes/admin/panel.php' ?>

<form action="" method="post" enctype="multipart/form-data">
    <h1 class="text-center">Edit Product</h1>

    <!-- if eroror -->
    <?php if (isset($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" id="product_name" class="form-control" value="<?= $product['food_name'] ?>">
    </div>
    <div class="form-group
    ">
        <label for="product_price">Product Price</label>
        <input type="text" name="product_price" id="product_price" class="form-control" value="<?= $product['price'] ?>">
    </div>
    <div class="form-group">
        <label for="product_img">Product Image</label>

        <!-- let the image value in the form is the value of the image in the database -->
        <input type="file" name="product_img" id="product_img" class="form-control" value="<?= $product['img'] ?>">

    </div>

    <button type="submit" name="submit" class="btn btn-primary">Update</button>

    <!-- cancel butn -->

    <a href="<?= PRODUCT_PATH['list'] ?>" class="btn btn-danger">Cancel</a>
</form>

<!-- display image with style -->

<div class="card" style="width: 18rem;">
    <img src="<?= UPLOADS_PATH . '/'. $product['img'] ?>" class="card-img-top" alt="<?= $product['food_name'] ?>">
</div>

<?php require_once '../../../app/src/includes/admin/footer.php' ?>