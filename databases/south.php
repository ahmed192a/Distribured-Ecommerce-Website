<?php

class connection_S
{
    private  $_server = "localhost";
    private  $_user = "root";
    private  $_pass = "";
    private  $_dbname = "south";
    public   $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->_server, $this->_user, $this->_pass, $this->_dbname) or die("connection_S failed: " . $this->conn->connect_error);
    }
    function __destruct()
    {
        $this->conn->close();
    }
}
class south
{
    static function add_item($data)
    {
        $connect = new connection_S;
        $connect->conn->query("INSERT INTO item_data(name,price,description,category_type) VALUES('" . $data['name'] . "','" . $data['price'] . "','" . $data['description'] . "','" . $data['category_type'] . "')");
        $connect->conn->query("INSERT INTO item_related(seller_id) VALUES('" . $data['seller_id'] . "')");
    }
    static function remove_item($id)
    {
        $connect = new connection_S;
        $connect->conn->query("DELETE FROM item_promot WHERE id='$id'");
        $connect->conn->query("DELETE FROM item_related WHERE id='$id'");
        $connect->conn->query("DELETE FROM item_data WHERE id='$id'");
    }
    static function get_item_data($id)
    {
        $connect = new connection_S;
        $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
        return mysqli_fetch_assoc($result);
    }
    static function get_item_related($id)
    {
        $connect = new connection_S;
        $result = $connect->conn->query("SELECT * FROM item_related WHERE id='$id'");
        return mysqli_fetch_assoc($result);
    }
    static function take_item($id, $owner_id) //buy
    {
        $connect = new connection_S;
        $connect->conn->query("DELETE FROM item_promot WHERE id='$id'");
        $connect->conn->query("UPDATE item_related SET owner_id='$owner_id',purch_date= CURRENT_TIMESTAMP WHERE id='$id'");
    }
    static function edit_item($id, $data)
    {
        $connect = new connection_S;
        if ($data['name'] != null) $connect->conn->query("UPDATE item_data SET name='" . $data['name'] . "' WHERE id='$id'");
        if ($data['price'] != null) $connect->conn->query("UPDATE item_data SET price='" . $data['price'] . "' WHERE id='$id'");
        if ($data['description'] != null) $connect->conn->query("UPDATE item_data SET description='" . $data['description'] . "' WHERE id='$id'");
        if ($data['category_type'] != null) $connect->conn->query("UPDATE item_data SET category_type='" . $data['category_type'] . "' WHERE id='$id'");
    }
    static function add_promoter($id, $promoter_id)
    {
        $connect = new connection_S;
        $connect->conn->query("INSERT INTO item_promot(id,promoter_id) VALUES('$id','$promoter_id')");
    }
    static function remove_promoter($id, $promoter_id)
    {
        $connect = new connection_S;
        $connect->conn->query("DELETE FROM item_promot WHERE promoter_id='$promoter_id'");
    }
    static function load_store_items($id)
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE seller_id ='$id' and owner_id IS NULL");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'] . "S";
            $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['name'] = $result['name'];
            $row['price'] = $result['price'];
            $row['description'] = $result['description'];
            $row['category_type'] = $result['category_type'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
    static function load_sold_items($id)
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE seller_id ='$id' and owner_id IS NOT NULL");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'] . "S";
            $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['name'] = $result['name'];
            $row['price'] = $result['price'];
            $row['description'] = $result['description'];
            $row['category_type'] = $result['category_type'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
    static function load_owned_items($id)
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE owner_id ='$id'");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'] . "N";
            $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['name'] = $result['name'];
            $row['price'] = $result['price'];
            $row['description'] = $result['description'];
            $row['category_type'] = $result['category_type'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
    static function load_promoted_items($id)
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_promot WHERE promoter_id ='$id'");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'] . "S";
            $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['name'] = $result['name'];
            $row['price'] = $result['price'];
            $row['description'] = $result['description'];
            $row['category_type'] = $result['category_type'];
            $result = $connect->conn->query("SELECT * FROM item_related WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['seller_id'] = $result['seller_id'];
            $row['sale_date'] = $result['sale_date'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
    static function SSO($id)
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE seller_id ='$id' and owner_id IS NULL");
        $S = mysqli_num_rows($items);
        $items = $connect->conn->query("SELECT * FROM item_related WHERE seller_id ='$id' and owner_id IS NOT NULL");
        $SS = mysqli_num_rows($items);
        // $items = $connect->conn->query("SELECT * FROM item_related WHERE owner_id ='$id'");
        // $O = mysqli_num_rows($items);
        return ["sale" => $S, "sold" => $SS];
    }
    static function OWN($id)
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE owner_id ='$id'");
        $O = mysqli_num_rows($items);
        return ["owned" => $O];
    }


    static function load_all_items()
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE  owner_id IS NULL");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'] . "S";
            $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['name'] = $result['name'];
            $row['price'] = $result['price'];
            $row['description'] = $result['description'];
            $row['category_type'] = $result['category_type'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
    static function load_all_sold_items()
    {
        $connect = new connection_S;
        $items = $connect->conn->query("SELECT * FROM item_related WHERE  owner_id IS NOT NULL ORDER BY purch_date");
        $i = mysqli_num_rows($items);
        $list = array();
        while ($i != 0) {
            $row = mysqli_fetch_assoc($items);
            $id = $row['id'];
            $row['id'] = $row['id'] . "S";
            $result = $connect->conn->query("SELECT * FROM item_data WHERE id='$id'");
            $result =  mysqli_fetch_assoc($result);
            $row['name'] = $result['name'];
            $row['price'] = $result['price'];
            $row['description'] = $result['description'];
            $row['category_type'] = $result['category_type'];
            array_push($list, $row);
            $i--;
        }
        return (isset($list)) ? $list : false;
    }
}
