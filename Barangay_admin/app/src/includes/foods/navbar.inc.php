<!-- ROUTES -->
<div class="tabs is-centered">
    <ul id="routes">
        
        <?php if ($_SESSION['user']['user_level'] === '0' or $_SESSION['user']['user_level'] === '1') : ?>
        <li class="route1">
            <a href="<?= PAGE3 ?>" class="page3Icon">
                <span class="icon is-small"><i class="fa-solid fa-backward"></i></span>
                <span>Back to page 3</span>
            </a>
        </li>

        <li class="route1">
            <a href="<?= SALES_PATH['list'] ?>" class="page3Icon">
                <span class="icon is-small">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <span>Preview Sales List</span>
            </a>
        </li>
        <?php endif; ?>

        <li class="route2">
            <a href="<?= MAINFOODPAGE ?>" class="fire">
                <span class="icon is-small"><i class="fa-solid fa-fire"></i></span>
                <span>Popular Dishes</span>
            </a>
        </li>

        <li class="route2">
            <a href="<?= CART_PATH['list'] ?>" class="fire">
                <span class="icon is-small">
                    <i class="fa-solid fa-shopping-cart"></i>
                </span>
                <span>Cart</span>
            </a>
        </li>

        <li class="route3">
            <a href="<?= LOGOUT ?>" class="logout">
                <span class="icon is-small"><i class="fa-solid fa-sign-out"></i></span>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>