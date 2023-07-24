<?php
require_once __DIR__ . '../../../core/Model.php';

class ProductController 
{

    private $model;
    private $error = [];

    public function __construct()
    {
        $this->model = new BaseProductModel();
    }

    public function validateProduct($product){


        if (empty($product['name'])) {
            $this->error['error_name'] = 'Product name is required';
        }

        if (empty($product['price'])) {
            $this->error['error_name'] = 'Product price is required';
        }

        if ($this->isProductNameExist($product)) {
            $this->error['error_name'] = 'Product already exist';
        }

        return $this->error;
    }

    public function insertProduct($product){
        $inserted = $this->model->addProduct($product);

        if ($inserted) {
            return true;
        } else {
            return false;
        }

    }

    private function isProductNameExist($product){
        $product = $this->model->getProduct('food_name', $product['name']);

        // if product exist return true
        if ($product) {
            return true;
        } else {
            return false;
        }
    }



}