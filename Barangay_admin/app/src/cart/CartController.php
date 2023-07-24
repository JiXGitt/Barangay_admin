<?php

require_once __DIR__ . '../../../core/Model.php';
require_once __DIR__ . '../../../libs/Helpers.php';
require_once __DIR__ . '../../../libs/Image.php';


class CartController
{

    private $model;
    private $conn;
    private $errors = [];

    public function __construct()
    {
        $this->model = new BaseProductModel();
        $this->conn = $this->model->getConnection();
    }

    public function checkCartExist($user_id, $product_id)
    {

        // select all specific cart id
        $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";

        $stmt = $this->conn->query($sql);

        $productExist = $stmt->fetch_assoc();

        if ($productExist)
        {
            $this->errors['error_message'] = "The product your trying to add is already in Cart";
        }
        return $this->errors;
    }

}