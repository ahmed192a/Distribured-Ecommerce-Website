<?php

class connection
{
    private  $_server = "localhost";
    private  $_user = "root";
    private  $_pass = "";
    private  $_dbname = "center";
    public   $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->_server, $this->_user, $this->_pass, $this->_dbname) or die("connection failed: " . $this->conn->connect_error);
    }
    function __destruct()
    {
        $this->conn->close();
    }
}
class center
{
    static function get_data($id)
    {
        $connect = new connection;
        $result = $connect->conn->query("SELECT * FROM data WHERE email='$id' or id='$id'");
        return mysqli_fetch_assoc($result);
    }
    static function get_info($id)
    {
        $connect = new connection;
        $result = $connect->conn->query("SELECT * FROM info WHERE id='$id'");
        return mysqli_fetch_assoc($result);
    }
    static function register_store($details)
    {
        $connect = new connection;
        $connect->conn->query("INSERT INTO data(email,password,store_name,region) VALUES('" . $details['email'] . "','" . $details['password'] . "','" . $details['store_name'] . "','" . $details['region'] . "')");
        $connect->conn->query("INSERT INTO info(f_name,l_name,gender,age,phone_num) VALUES('" . $details['f_name'] . "','" . $details['l_name'] . "','" . $details['gender'] . "','" . $details['age'] . "','" . $details['phone_num'] . "')");
    }
    static function update_balance($id, $amount)
    {
        $connect = new connection;
        $result = $connect->conn->query("SELECT balance FROM data WHERE id='$id'");
        $result = mysqli_fetch_assoc($result);
        $new_balance = $result['balance'] + $amount;
        $connect->conn->query("UPDATE data SET balance='$new_balance' WHERE id='$id'");
    }
    static function load_all_stores()
    {
        $connect = new connection;
        $items = $connect->conn->query("SELECT * FROM data ORDER BY reg_date");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'];
            $result = $connect->conn->query("SELECT * FROM info WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['f_name'] = $result['f_name'];
            $row['l_name'] = $result['l_name'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
}
