<?php

require_once __DIR__ . '../../auth/UserController.class.php';
require_once __DIR__ . '../../../libs/Helpers.php';
require_once __DIR__ . '../../../core/Model.php';

class UserView
{

    private $data = [];
    private $errors = [];
    private $user_level_option = ['0', '1', '2', '3'];

    public function setData($data){
        $this->data = $data;
    }

    private function getData(){
        return $this->data;
    }

    private function isUserNameExists($username)
    {
        $user = getUser($username);
        if ($user) {
            return true;
        }
        return false;
    }


    private function validateUserLevel($user_level)
    {
        // sanitize user_level
        $user_lvl = Helpers::sanitize($user_level);

        // if not in the array
        // validate user role
        if (empty($data['user_level'])) {
            $errors['user_level'] = "User role is required";
        }
        elseif (!in_array($user_lvl, $this->user_level_option)) {
            $this->errors['user_level'] = "User level is invalid";
        }
    }

    // validate username
    private function sanitizeUserName($username)
    {
        $username = trim($username);
        $username = stripslashes($username);
        $username = htmlspecialchars($username);
        return $username;
    }

    //validate username
    private function validateUserName($user_name)

    {
        $username = $this->sanitizeUserName($user_name);

        if (empty($username)) {
            $this->errors['username'] = "Username is required";
        }
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $this->errors['username'] = "Username must be alphanumeric";
        } 
        else if (strlen($username) < 8) {
            $this->errors['username'] = "Username must be at least 8 characters";
        } 
       
    }

    public function validateUserInAdminForm()
    {

        foreach ($this->data as $key => $value){
            if ($key === 'update' ) continue;

            if ($key === 'username') {
                if ( $this->isUserNameExists($value) ) 
                    $this->errors['username'] = 'Username already taken. Failed to update';

                $this->validateUserName($value);
            }

            if ($key === 'user_level') $this->validateUserLevel($value);

        }

        return $this->errors;
    }


}