<?php

class Helpers{

    public static function sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function generateRandomNumber()
    {
        $value = rand(100000, 999999);
        return $value;
    }

    // return the length of the string
    public static function stringLength($string)
    {
        $string = self::sanitize($string);
        $string = strlen($string);
        return $string;
    }

    // remove underscores and spaces from the string
    public static function removeUnderscore($string)
    {
        $string = self::sanitize($string);
        $string = str_replace('_', ' ', $string);
        return $string;
    }

}