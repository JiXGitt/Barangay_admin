<?php

// added some comments to make it more readable and understandable


// --------------------- DB CREDENTIALS --------------------------------------
const DB_HOST = 'localhost';
const DB_NAME = 'foodhouse';
const DB_USER = 'root';
const DB_PASSWORD = '';

// --------------------- PATHS --------------------------------------

const ROOT_PATH = "/Millona";

const LOGOUT = ROOT_PATH . "/auth/logout.php";
const LOGIN = ROOT_PATH . "/auth/login/index.php";
const REGISTER = ROOT_PATH . "/auth/register.php";

const MAINFOODPAGE = ROOT_PATH . "/foods";
const MAINFOODPAGE_ALT = ROOT_PATH . "/foods";

const PAGE3 = ROOT_PATH . "/page3";
const PAGE2 = ROOT_PATH . "/page2";
const LOGO = ROOT_PATH."/public/assets/img/Restaurant Food.png";

const ADMIN = ROOT_PATH . "/admin";


// ------------------ Product page PATHS ---------------------------------

const PRODUCT_PATH = [
    'index' => ROOT_PATH . "/admin/product/index.php",
    'create' => ROOT_PATH . "/admin/product/add",
    'edit' => ROOT_PATH . "/admin/product/edit",
    'delete' => ROOT_PATH . "/admin/product/delete",
    'list' => ROOT_PATH . "/admin/product/list",
];

// ------------------ Cart page PATHS ---------------------------------
const CART_PATH = [
    'list' => ROOT_PATH . "/carts",
    'delete' => ROOT_PATH . "/carts/delete"
];


// ------------------ Sales page PATHS ---------------------------------
const SALES_PATH = [
    'index' => ROOT_PATH . "/admin/sales/",
    'delete' => ROOT_PATH . "/admin/sales/delete",
    'list' => ROOT_PATH . "/admin/sales/list",
];


// ------------------ Employee page PATHS ---------------------------------
const EMPLOYEE_PATH = [
    'index' => ROOT_PATH . "/admin/employee/",
    'edit' => ROOT_PATH . "/admin/employee/edit",
    'delete' => ROOT_PATH . "/admin/employee/delete",
    'list' => ROOT_PATH . "/admin/employee/list",
];

// ------------------ Accounts page PATHS ---------------------------------
const ACCOUNTS_PATH = [
    'index' => ROOT_PATH . "/admin/accounts/",
    'edit' => ROOT_PATH . "/admin/accounts/edit",
    'delete' => ROOT_PATH . "/admin/accounts/delete",
    'list' => ROOT_PATH . "/admin/accounts/list",
    'create' => ROOT_PATH . "/admin/accounts/create",
];


// --------------------- FORM CREDENTIALS --------------------------------------
const USERNAME = ['username', 'Username'];
const PASSWORD = ['password', 'Password'];

