<?php

// fix the  Failed to open stream: No such file or directory i
// in app\src\sales\SalesController.php

require_once __DIR__ . '../../../core/Model.php';

class SalesController
{

    private $model;
    private $error = [];
    private $data;
    private $exception_keys = ['new'];

    public function __construct($data)
    {
        $this->model = new BaseSales();
        $this->data = $data;
    }


    public function validateSalesData(){

        $sanitizedData = $this->sanitizeSalesData($this->data);

        foreach ($sanitizedData as $key => $value) {
            if (in_array($key, $this->exception_keys)) {
                continue;
            }

            elseif (is_numeric($value)) {
                if (!is_numeric($value)) {
                    $this->error['error_name'] = $key .' field must be numeric';
                }

                // empty
                if (empty($value)) {
                    $this->error['error_name'] = $key .' field are required';
                }

                elseif ($value < 0) {
                    $this->error['error_name'] = $key .' field must be greater than 0';
                }
            }

            elseif (is_string($value)) {
                // if empty
                if (empty($value)) {
                    $this->error['error_name'] = $key .' field are required';
                }
            }
        }

        // check if the cashvalue is less than the total amount
        if ($this->data['cash_value'] < $this->data['totalDiscountedGiven']) {
            $this->error['error_name'] = 'Cash value is less than the total amount';
        }

        return $this->error;
    }


    public function addSales()
    {
        $data = $this->sanitizeSalesData($this->data);

        /* 
        the reason why we can access the data is because we are returning the data from the sanitizeSalesData() method.... ALWAYS REMBERED THIS..

        If a method have a "return", that return will be the value of the method and the basis of the method.
        */
    
        $addSales = $this->model->addSales($data);

        if ($addSales) {
            return true;
        } else {
            return false;
        }
    }


    // check if anyone one of the data is empty
    public function isDataEmpty()
    {

        foreach ($this->data as $key => $value) {
            if (empty($value)) {
                $this->error['error_name'] = 'All fields are required';
            }
        }

        if (empty($this->error)) {
            return true;
        } else {
            return false;
        }

    }


    private function sanitizeSalesData($data)
    {
        // loop through the data and sanitize it
        foreach ($data as $key => $value) {
            $data[$key] = $this->model->getConnection()->real_escape_string($value);
        }

        return $data;

    }


    // ------ CRUD OPERATIONS ------

    // public function getAllSales()
    // {
    //     $sales = $this->model->getAllSales();

    //     return $sales;
    // }

     public static function getAllSales()
    {
        $model = new BaseSales();
        $sales = $model->getAllSales();

        return $sales;
    }

    public static function removeSales($key, $value)
    {
        $model = new BaseSales();
        $removeSales = $model->removeSales($key, $value);

        if ($removeSales) {
            return true;
        } else {
            return false;
        }
    }


}
