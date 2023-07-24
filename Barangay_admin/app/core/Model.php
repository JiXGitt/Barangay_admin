<?php
require_once __DIR__ . '../../config/env.php';
require_once __DIR__ . '../../config/Connection.php';
require_once __DIR__ . '../../config/DBCmd.php';

function insertUser($username, $user_password)
{
    $sql = "INSERT INTO accounts (username, user_password) VALUES ('$username', '$user_password')";
    $conn = DBConnection();

    $stmt = $conn->query($sql);

    if ($stmt) {
        return true;
    } else {
        return false;
    }
}

function insertUser2($username, $user_password, $user_lvl)
{
    $sql = "INSERT INTO accounts (username, user_password, user_level) VALUES ('$username', '$user_password', '$user_lvl')";

    $conn = DBConnection();

    $stmt = $conn->query($sql);

    if ($stmt) {
        return true;
    } else {
        return false;
    }
}


// this is the function that will be used to get the user from the database and return it as an array to access its data or fields
function getUser($username)
{
    $sql = "SELECT * FROM accounts WHERE username = '$username'";
    $conn = DBConnection();
    $stmt = $conn->query($sql);

    // use mysqli to fetch the data
    $user = $stmt->fetch_assoc();

    if ($user){
        return $user;
    }
    else{
        return false;
    }
}

function getUserById($id)
{
    $sql = "SELECT * FROM accounts WHERE user_id = '$id'";
    $conn = DBConnection();
    $stmt = $conn->query($sql);

    // use mysqli to fetch the data
    $user = $stmt->fetch_assoc();

    if ($user) {
        return $user;
    } else {
        return false;
    }
}

function getUsers()
{
    $sql = 'SELECT * FROM accounts';

    $conn = DBConnection();
    $stmt = $conn->query($sql);

    $users = $stmt->fetch_all(MYSQLI_ASSOC);

    return $users;

}

function updateUser( $data ){

    $username = $data['username'];
    $user_level = $data['user_level'];
    $user_id = $data['user_id'];

    $sql = "UPDATE accounts SET username = '$username', user_level = '$user_level' WHERE user_id = '$user_id'";

    $conn = DBConnection();

    $stmt = $conn->query($sql);

    if ($stmt) {
        return true;
    } else {
        return false;
    }

}


class BaseProductModel{

    private $conn;
    private $cmd;

    public function __construct()
    {
        $this->conn = DBConnection();
        $this->cmd = new DBCmd();
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getAllProducts()
    {
        $sql = $this->cmd->selectAllCmd('main_foods_tbl');
        $stmt = $this->conn->query($sql);

        $main_foods = $stmt->fetch_all(MYSQLI_ASSOC);

        return $main_foods;
    }

    public function getProduct($key, $value)
    {
        
        $sql = $this->cmd->selectCmd('main_foods_tbl', $key, $value);

        $stmt = $this->conn->query($sql);

        $product = $stmt->fetch_assoc();

        return $product;
    }

    public function addProduct($product)
    {

        $productName = $product['name'];
        $productPrice = $product['price'];
        $productImage = $product['img'];

        $sql = "INSERT INTO main_foods_tbl (food_name, price, img) VALUES ('$productName', '$productPrice', '$productImage')";

        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($product)
    {
        
        $id = $product['id'];
        $productName = $product['name'];
        $productPrice = $product['price'];
        $productImage = $product['img'];

        $sql = "UPDATE main_foods_tbl SET food_name = '$productName', price = '$productPrice', img = '$productImage' WHERE id = '$id'";

        $stmt = $this->conn->query($sql);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM main_foods_tbl WHERE id = '$id'";
        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}

class CartModel
{
    private $conn;
    private $cmd;
    private $productmodel;

    public function __construct()
    {
        $this->productmodel = new BaseProductModel();
        $this->cmd = new DBCmd();
        $this->conn = $this->productmodel->getConnection();
    }

    // add product
    public function addToCart($product_id, $user_id)
    {
        
        $sql = "INSERT INTO cart (product_id, user_id) VALUES ('$product_id', '$user_id')";

        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    public function getAllProductsInCart($user_id)
    {

        // use join statemtn to get the product details as well as the cart details
        $sql = "SELECT * FROM cart INNER JOIN main_foods_tbl ON cart.product_id = main_foods_tbl.id WHERE cart.user_id = '$user_id'";

        $stmt = $this->conn->query($sql);

        $cart = $stmt->fetch_all(MYSQLI_ASSOC);

        return $cart;

        // $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";

        // $stmt = $this->conn->query($sql);

        // $cart = $stmt->fetch_all(MYSQLI_ASSOC);

        // return $cart;
    }

}


class BaseSales{


    private $conn;
    private $cmd;
    private $productmodel;

    public function __construct()
    {
        $this->productmodel = new BaseProductModel();
        $this->cmd = new DBCmd();
        $this->conn = $this->productmodel->getConnection();
    }

    // get the connection
    public function getConnection()
    {
        return $this->conn;
    }

    public function addSales($data)
    {

        $item_name = $data['item_name'];
        $item_price = $data['item_price'];
        $quantity = $data['quantity'];
        $discount_amount = $data['discount_amount'];
        $discounted_amount = $data['discounted_amount'];
        $cash_value = $data['cash_value'];
        $change_value = $data['change_value'];
        $total_discount_given = $data['totalDiscountedGiven'];
        
        
        $sql = "INSERT INTO 
        sales (
            item_name, 
            item_price,
            quantity,
            discount_amount,
            discounted_amount,
            totalDiscountedGiven,
            cash_value,
            change_value
        ) 
            
        VALUES (
            '$item_name',
            '$item_price',
            '$quantity',
            '$discount_amount',
            '$discounted_amount',
            '$total_discount_given',
            '$cash_value',
            '$change_value'
        )";

        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSales()
    {
        $sql = $this->cmd->selectAllCmd('sales');
        $stmt = $this->conn->query($sql);

        $sales = $stmt->fetch_all(MYSQLI_ASSOC);

        return $sales;
    }

    public function removeSales($key, $value)
    {
        $sql = "DELETE FROM sales WHERE $key = '$value'";
        
        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

}

class EmployeeBaseModel
{
    private $cmd;
    private $conn;
    private $productmodel;

    public function __construct()
    {

        $this->productmodel = new BaseProductModel();
        $this->cmd = new DBCmd();
        $this->conn = $this->productmodel->getConnection();
    }

    public function getAllEmp()
    {
        $sql = $this->cmd->selectAllCmd('employee_tbl');
        $stmt = $this->conn->query($sql);

        $employees = $stmt->fetch_all(MYSQLI_ASSOC);

        return $employees;
    }

    public function getEmpFields()
    {
        $sql = 'SELECT * FROM employee_tbl LIMIT 1';
        
        $stmt = $this->conn->query($sql);

        $fields = $stmt->fetch_all(MYSQLI_ASSOC);

        return $fields;
    }

    public function getEmp($key, $value)
    {

        $sql = "SELECT * FROM employee_tbl WHERE $key = ?";
        // prepare the statement
        $stmt = $this->conn->prepare($sql);
        // bind the string parameters
        $stmt->bind_param('i', $employee_id);
        // execute the statement
        $stmt->execute();
        // get the result
        $result = $stmt->get_result();
        // fetch the data
        $emp = $result->fetch_assoc();

        return $emp;
    }


    public function addEmployee($emp)
    {
        $empID = $emp['emp_id'] ;
        $user_lvl = $_SESSION['user']['user_level'];
        $emp_dependents = $emp['num_dependent'];
        $emp_payDate = $emp['emp_pay_date'];
        $emp_fname = $emp['f_name'];
        $emp_lname = $emp['l_name'];
        $emp_civilStatus = $emp['emp_civil_status'];
        $emp_empStatus = $emp['emp_status'];
        $emp_designation = $emp['designation'];
        $emp_department = $emp['department'];
        $emp_img = $emp['emp_img'];

        $emp_basicPayPerHr = $emp['basicPay_rate_per_hr'];
        $emp_basicPayPerCutOff = $emp['basicPay_hrs_per_cutOff'];
        $emp_total_basicPay = $emp['total_basicpay'];

        $emp_sss_contrib = $emp['sss_contrib'];
        $emp_philhealth_contrib = $emp['phil_health_contrib'];
        $emp_pagibig_contrib = $emp['pag_ibig_contrib'];
        $emp_tax = $emp['tax_val'];

        $emp_honoPerHr = $emp['hono_rate_per_hr'];
        $emp_honoPerCutOff = $emp['hono_hrs_per_cutOff'];
        $emp_totalHono = $emp['total_hono_pay'];

        $emp_sssLoan = $emp['sss_loan'];
        $emp_pagibig_loan = $emp['pag_ibig_loan'];
        $emp_fac_savings_deposit = $emp['fac_savings_deposit'];
        $emp_fac_savings_loan = $emp['fac_savings_loan'];
        $emp_salarayLoan = $emp['salary_loan'];
        $emp_others = $emp['others'];

        $emp_incomePerHr = $emp['other_income_rate_per_hr'];
        $emp_incomePerCutOff = $emp['other_income_num_of_hrs_per_cutOff'];
        $emp_totalOtherIncome = $emp['total_other_income_pay'];

        $emp_grossIncome = $emp['gross_income'];
        $emp_netIncome = $emp['net_income'];
        $emp_totalDeduction = $emp['total_deduction'];

        // insert data into the database using looping into an array of keys
        $sql = "INSERT INTO employee_tbl (
            emp_id ,
            added_by_user_level,
            emp_pay_date,
            f_name,
            l_name,
            num_dependent,
            emp_civil_status,
            emp_status,
            designation,
            department,
            emp_img,

            basicPay_rate_per_hr,
            basicPay_hrs_per_cutOff,
            total_basicpay,

            sss_contrib,
            phil_health_contrib,
            pag_ibig_contrib,
            tax_val,

            hono_rate_per_hr,
            hono_hrs_per_cutOff,
            total_hono_pay,

            sss_loan,
            pag_ibig_loan,
            fac_savings_deposit,
            fac_savings_loan,
            salary_loan,
            others,

            other_income_rate_per_hr,
            other_income_num_of_hrs_per_cutOff,
            total_other_income_pay,

            gross_income,
            net_income,
            total_deduction
        ) VALUES (
            '$empID',
            ' $user_lvl',
            '$emp_payDate',
            '$emp_fname',
            '$emp_lname',
            '$emp_dependents',
            '$emp_civilStatus',
            '$emp_empStatus',
            '$emp_designation',
            '$emp_department',
            '$emp_img',

            '$emp_basicPayPerHr',
            '$emp_basicPayPerCutOff',
            '$emp_total_basicPay',

            '$emp_sss_contrib',
            '$emp_philhealth_contrib',
            '$emp_pagibig_contrib',
            '$emp_tax',

            '$emp_honoPerHr',
            '$emp_honoPerCutOff',
            '$emp_totalHono',

            '$emp_sssLoan',
            '$emp_pagibig_loan',
            '$emp_fac_savings_deposit',
            '$emp_fac_savings_loan',
            '$emp_salarayLoan',
            '$emp_others',

            '$emp_incomePerHr',
            '$emp_incomePerCutOff',
            '$emp_totalOtherIncome',

            '$emp_grossIncome',
            '$emp_netIncome',
            '$emp_totalDeduction'
        )";

        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteEmployee($id)
    {
        $sql = "DELETE FROM employees_tbl WHERE id = '$id'";
        $stmt = $this->conn->query($sql);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    public function updateEmployee($emp)
    {
        $empID = $emp['emp_id'];
        $user_lvl = $_SESSION['user']['user_level'];
        $emp_dependents = $emp['num_dependent'];
        $emp_payDate = $emp['emp_pay_date'];
        $emp_fname = $emp['f_name'];
        $emp_lname = $emp['l_name'];
        $emp_civilStatus = $emp['emp_civil_status'];
        $emp_empStatus = $emp['emp_status'];
        $emp_designation = $emp['designation'];
        $emp_department = $emp['department'];
        $emp_img = $emp['emp_img'];

        $emp_basicPayPerHr = $emp['basicPay_rate_per_hr'];
        $emp_basicPayPerCutOff = $emp['basicPay_hrs_per_cutOff'];
        $emp_total_basicPay = $emp['total_basicpay'];

        $emp_sss_contrib = $emp['sss_contrib'];
        $emp_philhealth_contrib = $emp['phil_health_contrib'];
        $emp_pagibig_contrib = $emp['pag_ibig_contrib'];
        $emp_tax = $emp['tax_val'];

        $emp_honoPerHr = $emp['hono_rate_per_hr'];
        $emp_honoPerCutOff = $emp['hono_hrs_per_cutOff'];
        $emp_totalHono = $emp['total_hono_pay'];

        $emp_sssLoan = $emp['sss_loan'];
        $emp_pagibig_loan = $emp['pag_ibig_loan'];
        $emp_fac_savings_deposit = $emp['fac_savings_deposit'];
        $emp_fac_savings_loan = $emp['fac_savings_loan'];
        $emp_salarayLoan = $emp['salary_loan'];
        $emp_others = $emp['others'];

        $emp_incomePerHr = $emp['other_income_rate_per_hr'];
        $emp_incomePerCutOff = $emp['other_income_num_of_hrs_per_cutOff'];
        $emp_totalOtherIncome = $emp['total_other_income_pay'];

        $emp_grossIncome = $emp['gross_income'];
        $emp_netIncome = $emp['net_income'];
        $emp_totalDeduction = $emp['total_deduction'];

        // insert data into the database using looping into an array of keys
        $sql = "UPDATE employee_tbl SET

            emp_id = '$empID',
            added_by_user_level = '$user_lvl',
            emp_pay_date = '$emp_payDate',
            f_name = '$emp_fname',
            l_name = '$emp_lname',
            num_dependent = '$emp_dependents',
            emp_civil_status = '$emp_civilStatus',
            emp_status = '$emp_empStatus',
            designation = '$emp_designation',
            department = '$emp_department',
            emp_img = '$emp_img',

            basicPay_rate_per_hr = '$emp_basicPayPerHr',
            basicPay_hrs_per_cutOff = '$emp_basicPayPerCutOff',
            total_basicpay = '$emp_total_basicPay',

            sss_contrib = '$emp_sss_contrib',
            phil_health_contrib = '$emp_philhealth_contrib',
            pag_ibig_contrib = '$emp_pagibig_contrib',
            tax_val = '$emp_tax',

            hono_rate_per_hr = '$emp_honoPerHr',
            hono_hrs_per_cutOff = '$emp_honoPerCutOff',
            total_hono_pay = '$emp_totalHono',

            sss_loan = '$emp_sssLoan',
            pag_ibig_loan = '$emp_pagibig_loan',
            fac_savings_deposit = '$emp_fac_savings_deposit',
            fac_savings_loan = '$emp_fac_savings_loan',
            salary_loan = '$emp_salarayLoan',
            others = '$emp_others',

            other_income_rate_per_hr = '$emp_incomePerHr',
            other_income_num_of_hrs_per_cutOff = '$emp_incomePerCutOff',
            total_other_income_pay = '$emp_totalOtherIncome',

            gross_income = '$emp_grossIncome',
            net_income = '$emp_netIncome',
            total_deduction = '$emp_totalDeduction'

            WHERE emp_id = '$empID'";

        $stmt = $this->conn->query($sql);
        
        if ($stmt) {
            return true;
        } else {
            return false;
        }

    }

}