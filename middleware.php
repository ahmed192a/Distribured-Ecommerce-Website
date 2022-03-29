 <?php
    require "databases/center.php";
    require "databases/north.php";
    require "databases/south.php";
    session_start();
    class store
    {
        private $id, $region;
        function __construct($id, $region)
        {
            $this->id = $id;
            $this->region = $region;
        }
        function get_id()
        {
            return $this->id;
        }
        static function register_store($details)
        {
            if (center::get_data($details['email']) == null) {
                center::register_store($details);
                $data = center::get_data($details['email']);
                $_SESSION['store'] = new store($data['id'], $data['region']);
                return 1; // success
            } else return 0; // existed mail   
        }
        static function login_store($email, $password)
        {
            $data = center::get_data($email);
            if ($data != null) {
                if ($data['password'] != $password) return 1; // wrong pass
                else {
                    $_SESSION['store'] = new store($data['id'], $data['region']);
                    return 2; // success
                }
            } else return 0; // wrong mail
        }
        function recharge_balance($amount)
        {
            center::update_balance($this->id, $amount);
        }
        function sell_item($data)
        {
            $data['seller_id'] = $this->id;
            if ($this->region == "North") {
                north::add_item($data);
            } else {
                south::add_item($data);
            }
            return "DONE";
        }
        function unsell_item($item_id_region)
        {
            $region = substr($item_id_region, strlen($item_id_region) - 1, 1);
            $item_id = substr($item_id_region, 0, strlen($item_id_region) - 1);
            if ($region == "N")    north::remove_item($item_id);
            else        south::remove_item($item_id);
        }
        function edit_item($item_id_region, $data)
        {
            $region = substr($item_id_region, strlen($item_id_region) - 1, 1);
            $item_id = substr($item_id_region, 0, strlen($item_id_region) - 1);
            if ($region == "N")    north::edit_item($item_id, $data);
            else        south::edit_item($item_id, $data);
        }
        function buy_item($item_id_region)
        {
            $region = substr($item_id_region, strlen($item_id_region) - 1, 1);
            $item_id = substr($item_id_region, 0, strlen($item_id_region) - 1);
            $owner_id = $this->id;
            if ($region == "N") {
                $item_data = north::get_item_data($item_id);
                $item_price = $item_data['price'];
                $account = center::get_data($owner_id);
                $balance = $account['balance'];
                if ($balance >= $item_price) {
                    $item_related = north::get_item_related($item_id);
                    $seller_id = $item_related['seller_id'];
                    center::update_balance($seller_id, $item_price);
                    center::update_balance($owner_id, $item_price * -1);
                    north::take_item($item_id, $owner_id);
                    return 1;
                } else return 0;
            } else {
                $item_data = south::get_item_data($item_id);
                $item_price = $item_data['price'];
                $account = center::get_data($owner_id);
                $balance = $account['balance'];
                if ($balance >= $item_price) {
                    $item_related = south::get_item_related($item_id);
                    $seller_id = $item_related['seller_id'];
                    center::update_balance($seller_id, $item_price);
                    center::update_balance($owner_id, $item_price * -1);
                    south::take_item($item_id, $owner_id);
                    return 1;
                } else return 0;
            }
        }
        function promot_item($item_id_region)
        {
            $region = substr($item_id_region, strlen($item_id_region) - 1, 1);
            $item_id = substr($item_id_region, 0, strlen($item_id_region) - 1);
            if ($region == "N") {
                north::add_promoter($item_id, $this->id);
            } else {
                south::add_promoter($item_id, $this->id);
            }
        }
        function remove_promot_from_item($item_id_region)
        {
            $region = substr($item_id_region, strlen($item_id_region) - 1, 1);
            $item_id = substr($item_id_region, 0, strlen($item_id_region) - 1);
            if ($region == "N") {
                north::remove_promoter($item_id, $this->id);
            } else {
                south::remove_promoter($item_id, $this->id);
            }
        }
        static function get_info($id)
        {
            return center::get_info($id);
        }
        static function get_data($id)
        {
            return center::get_data($id);
        }
        static function get_SSO($id, $region)
        {
            $owned_N = north::OWN($id);
            $owned_S = south::OWN($id);
            $owned_N['owned'] += $owned_S['owned'];
            if ($region == "North")  return array_merge(north::SSO($id), $owned_N);
            else  return array_merge(south::SSO($id), $owned_N);
        }
        static function load_store_items($id)
        {
            $data = center::get_data($id);
            $region = $data['region'];
            if ($region == "North")    $items = north::load_store_items($id);
            else  $items = south::load_store_items($id);
            $items = array_merge($items,  north::load_promoted_items($id));
            $items = array_merge($items,  south::load_promoted_items($id));
            return $items;
        }
        static function load_sold_items($id)
        {
            $data = center::get_data($id);
            $region = $data['region'];
            if ($region == "North")   return north::load_sold_items($id);
            else return south::load_sold_items($id);
        }
        static function load_owned_items($id)
        {
            $items = north::load_owned_items($id);
            $myarr_s = south::load_owned_items($id);
            for ($i = 0; $i < count($myarr_s); $i++) {
                array_push($items, $myarr_s[$i]);
            }
            return $items;
        }
        static function load_all_items()
        {
            $items = north::load_all_items();
            $items = array_merge($items,  south::load_all_items());
            return $items;
        }
        static function generate_report($type)
        {
            switch ($type) {
                case 'center':
                    $myfile = fopen("reports/center.csv", "w") or die("Unable to open file!");
                    $array = center::load_all_stores();
                    $txt = "ID\t,\tFirst_Name\t,\tLast_Name\t,\tStore\t,\tRegion\t,\tEmail\t,\tBalance\t,\tOnSale_no.\t,\tSold_no.\t,\tOwned_no.\t,\tReg_Date\n";
                    foreach ($array as $value) {
                        $SSO = store::get_SSO($value['id'], $value['region']);
                        $txt = $txt . $value['id'] . "\t,\t" . $value['f_name'] . "\t,\t" . $value['l_name'] . "\t,\t" . $value['store_name'] . "\t,\t" . $value['region'] . "\t,\t" . $value['email'] . "\t,\t" . $value['balance'] . "\t,\t" . $SSO['sale'] . "\t,\t" . $SSO['sold'] . "\t,\t" . $SSO['owned'] . "\t,\t" . $value['reg_date']  . "\n";
                    }
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    break;
                case 'north':
                    $myfile = fopen("reports/north.csv", "w") or die("Unable to open file!");
                    $array = north::load_all_sold_items();
                    $txt = "ID\t,\tName\t,\tPrice\t,\tCategory\t,\tPublish Date\t,\tStore\t,\tPurchase Date\t,\tBuyer\n";
                    foreach ($array as $value) {
                        $txt = $txt . $value['id'] . "\t,\t" . $value['name'] . "\t,\t" . $value['price'] . "\t,\t" . $value['category_type'] . "\t,\t" . $value['sale_date'] . "\t,\t" . $value['seller_id'] . "\t,\t" . $value['purch_date'] . "\t,\t" . $value['owner_id'] . "\n";
                    }
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    break;
                case 'south':
                    $myfile = fopen("reports/south.csv", "w") or die("Unable to open file!");
                    $array = south::load_all_sold_items();
                    $txt = "ID\t,\tName\t,\tPrice\t,\tCategory\t,\tPublish Date\t,\tStore\t,\tPurchase Date\t,\tBuyer\n";
                    foreach ($array as $value) {
                        $txt = $txt . $value['id'] . "\t,\t" . $value['name'] . "\t,\t" . $value['price'] . "\t,\t" . $value['category_type'] . "\t,\t" . $value['sale_date'] . "\t,\t" . $value['seller_id'] . "\t,\t" . $value['purch_date'] . "\t,\t" . $value['owner_id'] . "\n";
                    }
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    break;
                default:
                    break;
            }
        }
    }
    ?>