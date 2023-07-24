<?php

require_once __DIR__ .  "../../../config/env.php";
require_once __DIR__ .  "../../../core/Model.php";
require_once __DIR__ .  "../../../core/Redirect.php";
require_once __DIR__ .  "../../../libs/Helpers.php";

class UserController
{

    private $username;
    private $user_password;
    private $confirm_password;
    private $user_lvl;
    private $user_level_option = ['0', '1', '2', '3'];
    private $errors = [];

    public function __construct($username, $user_password)
    {
        $this->username = $username;
        $this->user_password = $user_password;
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }


    // check role of user
    private function is_admin($user)
    {
        return $user['user_level'] === '1';
    }

    
    private function is_cashier($user)
    {
        return $user['user_level'] === '0';
    }

    private function is_hr($user)
    {
        return $user['user_level'] === '2';
    } 
    private function is_customer($user)
    {
        return $user['user_level'] === '3';
    }


    public function saveUser()
    {
        $hashed_password = $this->hashPassword($this->user_password);

        // insert user to database
        $userInsert = insertUser2($this->username, $hashed_password, $this->user_lvl);

        // check if user is inserted
        if ($userInsert) {
            return true;
        }
        else{
            return false;
        }

    }


    public function login()
    {
        // get user from database and save to session and return if there is an error
        $user = getUser($this->username);
        if (!$user) {
            return $this->errors['db_error'] = "Database error: failed to register";
        }
        // save user to session
        $this->saveUserToSession($user);

        if ($this->is_admin($user)) {

            redirect_authenticated_user($this->getUserFromSession(),
                ADMIN);
        } 

        else if ($this->is_cashier($user)) {

            redirect_authenticated_user($this->getUserFromSession(),
                PAGE3);
        } 

        else if ($this->is_hr($user)) {

            redirect_authenticated_user(
                $this->getUserFromSession(),
                EMPLOYEE_PATH['list']
            );
        }

        else if ($this->is_customer($user)){
            // redirect to authenticated user to main foods page
            redirect_authenticated_user($this->getUserFromSession(), MAINFOODPAGE);
        }
    }


    public function register()
    {

        $hashed_password = $this->hashPassword($this->user_password);

        // insert user to database
        $userInsert = insertUser($this->username, $hashed_password);

        // check if user is inserted
        if (!$userInsert) {
            return $this->errors['db_error'] = "Database error: failed to register";
        }

        // get user from database and save to session and return if there is an error
        $user = getUser($this->username);
        if (!$user) {
            return $this->errors['db_error'] = "Database error: failed to register";
        }

        if ($userInsert){
            // save user to session

            $this->saveUserToSession($user);

            if ($this->is_admin($user)) {

                redirect_authenticated_user(
                    $this->getUserFromSession(),
                    ADMIN
                );
            } else if ($this->is_cashier($user)) {

                redirect_authenticated_user(
                    $this->getUserFromSession(),
                    PAGE3
                );
            } else if ($this->is_hr($user)) {

                redirect_authenticated_user(
                    $this->getUserFromSession(),
                    EMPLOYEE_PATH['list']
                );
            } else if ($this->is_customer($user)) {
                // redirect to authenticated user to main foods page
                redirect_authenticated_user($this->getUserFromSession(), MAINFOODPAGE);
            }

        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }



    // ------------------------FORM VALIDATION------------------------ //

    // validate user creation form in admin panel
    public function validateUserAccountInAdminForm()
    {
        if ($this->isConfirmPasswordEmpty()) {
            $this->addError('confirm_password', "Confirm password is required");
        } else if (!$this->isPasswordMatch()) {
            $this->addError('confirm_password', "Password and confirm password do not match");
        } else if ($this->isUserNameExists($this->username)) {
            $this->addError('username', "Username already exists");
        } 

        $this->validateUserName();
        $this->validatePassword();
        $this->validateUserLevel();

        // return the errors
        return $this->errors;
    }


    public static function validateUpdateUserInAdminForm($data){

        $errors = [];

        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['username'])) {
            $errors['username'] = "Username must be alphanumeric";
        } else if (strlen($data['username']) < 8) {
            $errors['username'] = "Username must be at least 8 characters";
        } elseif (empty($data['username'])) {
            $errors['username'] = "Username is required";
        }


        else if (empty($data['user_level'])) {
            $errors['user_level'] = "User role is required";
        }
        elseif (in_array($data['user_level'], ['0', '1', '2', '3']) === false) {
            $errors['user_level'] = "Invalid user role";
        }

        return $errors;
    }


    // FORM VALIDATION FOR LOGIN
    public function validateLoginForm()
    {
        // if username is not equal to username in database
        if (!(
            $this->isUserNameExists($this->username) and $this->verify_password($this->user_password))
        ) {
            $this->addError('login_fail', "Wrong username or password");
        }
        
        // verify password
        // return the errors
        return $this->errors;
    }

    // FORM VALIDATION FOR REGISTER
    public function validateFormRegister()
    {
        if ($this->isConfirmPasswordEmpty()) {
            $this->addError('confirm_password', "Confirm password is required");
        } 
        else if (!$this->isPasswordMatch()) {
            $this->addError('confirm_password', "Password and confirm password do not match");
        } 
        else if ($this->isUserNameExists($this->username)) {
            $this->addError('username', "Username already exists");
        } 
        $this->validateUserName();
        $this->validatePassword();

        // return the errors
        return $this->errors;
    }

    private function validateUserLevel()
    {
        $user_lvl = $this->getUserLevel();
        // sanitize user_level
        $user_lvl = Helpers::sanitize($user_lvl);

        // if not in the array
        if (!in_array($user_lvl, $this->user_level_option)) {
            $this->addError('user_level', "User level is invalid");
        }

    }

    // validate username
    private function validateUserName()
    {
        $username = $this->sanitizeUserName($this->username);

        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $this->addError('username', "Username must be alphanumeric");
        } 
        else if (strlen($username) < 8) {
            $this->addError('username', "Username must be at least 8 characters");
        } 
       
        else if ($this->isUserNameEmpty()) {
            $this->addError('username', "Username is required");
        } 
    }


    /**  validate user_password ( 
     * Must have at least 1 Special characters 
     * Must have at least 1 Number 
     * Must have at least 1 letter)
     */
    private function validatePassword()
    {
        $user_password = $this->sanitizePassword($this->user_password);

        // check if password contains at least one number, one uppercase and one lowercase letter
        if (!preg_match("#[0-9]+#", $user_password)) {
            $this->addError('user_password', "password must contain at least one number, one uppercase and one lowercase letter");
        } 
        else if (strlen($user_password) < 8) {
            $this->addError('user_password', "Password must be at least 8 characters");
        } 
        else if ($this->isPasswordEmpty()) {
            $this->addError('user_password', "Password is required");
        } 
       
    }




    // ----------- USERNAME RELATED FUNCTIONS ---------------------
    public function setUserLevel($user_lvl)
    {
        $this->user_lvl = $user_lvl;
    }

    private function getUserLevel()
    {
        return $this->user_lvl;
    }

    private function isUserNameEmpty()
    {
        if (empty($this->username)) {
            return true;
        }
        return false;
    }

    private function isUserNameExists($username)
    {
        $user = getUser($username);
        if ($user) {
            return true;
        }
        return false;
    }

    // validate username
    private function sanitizeUserName($username)
    {
        $username = trim($username);
        $username = stripslashes($username);
        $username = htmlspecialchars($username);
        return $username;
    }

    // save user to session
    public function saveUserToSession($user)
    {
        $_SESSION['user'] = $user;
    }

    // get user from session
    private function getUserFromSession()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return false;
    }

    // get user from session and its role
    public function getUserRoleFromSession()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']['user_level'];
        }
        return false;
    }





    // ----------- PASSWORD RELATED FUNCTIONS ---------------------

    public function set_confirm_password($confirm_password)
    {
        $this->confirm_password = $confirm_password;
    }

    private function get_confirm_password()
    {
        return $this->confirm_password;
    }

    // sanitize password
    private function sanitizePassword($user_password)
    {
        $user_password = trim($user_password);
        $user_password = stripslashes($user_password);
        $user_password = htmlspecialchars($user_password);
        return $user_password;
    }

    // hash password
    private function hashPassword($password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return $hashed_password;
    }

    // check if password is empty
    private function isPasswordEmpty()
    {
        if (empty($this->user_password)) {
            return true;
        }
        return false;
    }

    // check if confirm password is empty
    private function isConfirmPasswordEmpty()
    {
        if (empty($this->get_confirm_password())) {
            return true;
        }
        return false;
    }

    // check if password and confirm password match
    private function isPasswordMatch()
    {
        if ($this->user_password !== $this->get_confirm_password()) {
            return false;
        }
        return true;
    }

    // verify password for login
    private function verify_password($password)
    {

        $user_pass = getUser($this->username);

        // because we return the user instance, from the getUser function, we have the access to the user_password and to access it we use the array syntax

        // get the password of the user
        $hashed_password = $user_pass['user_password'];

        if (password_verify($password, $hashed_password)) {
            return true;
        }
        return false;
       
    }

}
