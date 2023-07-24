<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="child-grid" method="POST">

    <figure>
        <img src="<?= UPLOADS_PATH ?>/<?= $img ?>" class="is-rounded" alt="main food item">
    </figure>

    <div id="" class="grid-footer selectBtn">
        <div>
            <label for="PriceTag" style="margin-right: 10px;"><i class="fa-solid
        fa-tag" style="color: red;"></i></label>

            <input type="hidden" name="product_id" value="<?= $id ?>">
            <input type="hidden" name="food_name" value="<?= $food_name ?>">
            <input type="hidden" name="price" value="<?= $price ?>">


            <span name="PriceTag" class="icon">
                <i class="fa-solid fa-peso-sign"></i>
                <span><?= $price ?></span>
            </span>
        </div>
        <div>
            <label for="foodName"><i class="fa-solid fa-utensils"></i></label>
            <span name="foodName">
                <?= $food_name ?>
            </span>
        </div>
        <div id="">
            <p class="control">
                <button id="" name="selectBtn" type="submit" onclick="" class="button button-bg-green is-rounded
        is-responsive">
                    <span class="icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                    <span>SELECT</span>
                </button>
            </p>
        </div>
    </div>
    <div id="addtocart${i + 1}" class="addToCartBtn">
        <p class="control1">
            <button type="submit" name="addToCart" class="button button-bg-green is-rounded
    is-responsive ">
                <span class="icon">
                    <i class="fa-solid fa-circle-check"></i>
                </span>
                <span><i class="fa-solid fa-cart-shopping"></i></span>
            </button>
        </p>
    </div>
</form>