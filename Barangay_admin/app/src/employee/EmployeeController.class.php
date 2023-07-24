<?php

require_once __DIR__ . '../../../core/Model.php';
require_once __DIR__ . '../../../libs/Helpers.php';
require_once __DIR__ . '../../../libs/Image.php';

class EmployeeController
{
    private $data = [];
    private $errors = [];
    private $model;
    private $additionals;
    private $helpers;
    private $civil_status = [
        'single' => 'Single',
        'married' => 'Married',
        'widowed' => 'Widowed',
        'separated' => 'Separated',
        'divorced' => 'Divorced',
    ];

    private $emp_status = [
        'regular' => 'Regular',
        'probationary' => 'Probationary',
        'contractual' => 'Contractual',
        'none' => 'None of the above',
    ];

    private $designation = [
        'cashier' => 'Cashier',
        'manager' => 'Manager',
        'team_leader' => 'Team Leader',
        'supervisor' => 'Supervisor',
        'staff' => 'Staff',
        'accountant' => 'Accountant',
        'none' => 'None of the above',
    ];

    private $department = [
        'IT' => 'IT',
        'hr' => 'HR',
        'accounting' => 'Accounting',
        'marketing' => 'Marketing',
        'sales' => 'Sales',
        'none' => 'None of the above',

    ];

    public function __construct()
    {
        $this->model = new EmployeeBaseModel();
    }

    public function setData($data, $additional_data = null)
    {
        $this->data = $data;
        $this->additionals = $additional_data;
    }

    private function getData()
    {
        return $this->data;
    }

    // ------------------ Form validation ------------------
    public function validateData($data)
    {
        $exception_keys = [
            'emp_id',
            'new',
            'clear',
            'save',
            'calculate',
            'total_basicpay',
            'sss_contrib',
            'phil_health_contrib',
            'tax_val',
            'total_hono_pay',
            'total_other_income_pay',
            'gross_income',
            'net_income',
            'total_deduction' 
        ];
        foreach ($data as $key => $value) {
            //  sanitize the data
            $value = Helpers::sanitize($value);

            if (in_array($key, $exception_keys)) {
                continue;
            } 
            
            // if all fields are blank and 0
            elseif (empty($value) and $value == 0) {
                $this->errors['error_name'] = "All fields are required";
            }

            elseif (is_numeric($value)) {

                if (empty($value) or $value == 0) {
                    $this->errors['error_name'] = "The $key field is required";
                } else if (!is_numeric($value)) {
                    $this->errors['error_name'] = "The $key field is invalid";
                }
            }

            elseif (is_string($value)) {
                
                // remove the spaces or underscores from the $key

                // check if the if the value is empty
                if (empty($value)) {
                    $this->errors['error_name'] = "The $key field is required";
                }

                // check if the value is not equal to the check_CivilStatus
                if ($key == 'civil_status') {
                    if (!self::check_CivilStatus($value)) {
                        $key = str_replace('_', ' ', $key);
                        $this->errors['error_name'] = "The $key field is invalid";
                    }
                }

                // check if the value is not equal to the check_EmpStatus
                if ($key == 'emp_status') {
                    if (!self::check_EmpStatus($value)) {
                        $key = str_replace('_', ' ', $key);
                        $this->errors['error_name'] = "The $key field is invalid";
                    }
                }

                // check if the value is not equal to the check_Designation
                if ($key == 'designation') {
                    if (!self::check_Designation($value)) {
                        $this->errors['error_name'] = "The $key field is invalid";
                    }
                }

                // check if the value is not equal to the check_Department
                if ($key == 'department') {
                    if (!self::check_Department($value)) {
                        $this->errors['error_name'] = "The $key field is invalid";
                    }
                }
            }
        }

        return $this->errors;
    }

    private function  check_CivilStatus($civil_status)
    {

        $civil_status = Helpers::sanitize($civil_status);

        //    check if the value is equal to the civil status
        if (array_key_exists($civil_status, $this->civil_status)) {
            return true;
        } else {
            return false;
        }
    }

    private function check_EmpStatus($emp_status)
    {

        $emp_status = Helpers::sanitize($emp_status);
        if (array_key_exists($emp_status, $this->emp_status)) {
            return true;
        } else {
            return false;
        }
    }

    private function check_Designation($designation)
    {
        $designation = Helpers::sanitize($designation);
        if (array_key_exists($designation, $this->designation)) {
            return true;
        } else {
            return false;
        }
    }

    private function check_Department($department)
    {
        $department = Helpers::sanitize($department);
        if (array_key_exists($department, $this->department)) {
            return true;
        } else {
            return false;
        }
    }




    // -----------------  CRUD -----------------
    public function addEmployee($data)
    {
        $validateData = $this->validateData($data);

        if (empty($validateData)) {
            $addEmployee = $this->model->addEmployee($data);
            if ($addEmployee) {
                return true;
            } else {
                return false;
            }
        } else {
            return $validateData;
        }
    }

    public function deleteEmployee( $employee_id ){

        $employee_id = Helpers::sanitize($employee_id);
        $deleteEmployee = $this->model->deleteEmployee($employee_id);

        if ($deleteEmployee) {
            return true;
        } else {
            return false;
        }
    }


    public function updateEmployee($data)
    {
        $validateData = $this->validateData($data);
        if (empty($validateData)) {
            $updateEmployee = $this->model->updateEmployee($data);
            if ($updateEmployee) {
                return true;
            } else {
                return false;
            }
        } else {
            return $validateData;
        }
    }

    public function getAllEmployee()
    {
        $getAllEmployee = $this->model->getAllEmp();
        
        return $getAllEmployee;
    }


    public function getEmployee($employee_id)
    {
        $employee_id = Helpers::sanitize($employee_id);
        $getEmployee = $this->model->getEmp('emp_id', $employee_id);

        return $getEmployee;
    }

    // select all the fields from the employee table
    public function getEmployeeFields()
    {
        $getEmployeeFields = $this->model->getEmpFields();

        return $getEmployeeFields;
    }

    

}
