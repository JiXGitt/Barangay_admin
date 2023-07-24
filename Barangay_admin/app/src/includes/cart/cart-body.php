<input type="hidden" name="cart_id" value="<?= $cart_item['cart_id'] ?>">

<div class="card rounded-3 mb-4">
    <div class="card-body p-4">
        <div class="row d-flex justify-content-between align-items-center">

            <div class="col-md-2 col-lg-2 col-xl-2">
                <img src="<?= UPLOADS_PATH . '/' . $cart_item['img'] ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">
                    <?= $cart_item['food_name'] ?>
                </p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0"><?= $cart_item['price'] ?></h5>
            </div>

            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a 
                href="<?= CART_PATH['delete'] ?>/index.php?id=<?= $cart_item['cart_id'] ?>" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
            </div>
       
        </div>
    </div>
</div>