<?php 

class DBCmd
{
    public static function selectAllCmd($table)
    {
        return "SELECT * FROM $table";
    }

    public static function selectCmd($table, $key, $value) 
    {
        return "SELECT * FROM $table WHERE $key = '$value'";
    }

    public static function insertCmd($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $keys = implode(',', $keys);
        $values = implode("','", $values);
        // have the capability to insert multiple values
        return  "INSERT INTO $table ($keys) VALUES ('$values')";
    }

    public static function updateCmd($table, $data, $id)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $keys = implode(',', $keys);
        $values = implode("','", $values);
        return "UPDATE $table SET $keys = '$values' WHERE id = $id";
    }

    public static function deleteCmd($table, $id)
    {
        return "DELETE FROM $table WHERE id = $id";
    }

    public static function selectAllCmdWithLimit($table, $limit)
    {
        return "SELECT * FROM $table LIMIT $limit";
    }

    public static function selectAllCmdWithLimitAndOffset($table, $limit, $offset)
    {
        return "SELECT * FROM $table LIMIT $limit OFFSET $offset";
    }

}