<nav id="nav" class="navbar is-transparent shadow-box is-spaced" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <figure id=resize-logo class="image is-96x96">
            <img class="is-rounded shadow-box-logo " src="<?= LOGO ?>" alt="Business Logo">
        </figure>

        <a role="button" class="navbar-burger burgerIcon" aria-label="menu" aria-expanded="false" data-target="menuList">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="menuList" class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">

                <a class="navbar-link">
                    Foods Catergories
                </a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="<?= MAINFOODPAGE ?>" target="_blank">
                        Mains
                    </a>
                </div>

                <div>
                    <a class="navbar-item" href="<?= CART_PATH['list'] ?>" target="_blank">
                        Cart
                        <span><i class="fa-solid fa-cart-shopping"></i></span>
                    </a>
                </div>
            </div>
            <div>
                <a class="navbar-item" href="<?= LOGOUT ?>" target="_blank">
                    Logout
                    <span><i class="fa-solid fa-sign-out"></i></span>
                </a>
            </div>
        </div>
    </div>

</nav>