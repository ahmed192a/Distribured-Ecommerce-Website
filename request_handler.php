<?php
require 'middleware.php';
//  echo "nooooo";
switch ($_SERVER["REQUEST_METHOD"]) {

    case 'POST':
        switch ($_POST['op']) {
            case 'new_item':
                $data['name'] = $_POST['name'];
                $data['price'] = $_POST['price'];
                $data['description'] = $_POST['description'];
                $data['category_type'] = $_POST['category_type'];

                echo $_SESSION['store']->sell_item($data);

                break;
            case 'register':
                $data['email'] = $_POST['email'];
                $data['password'] = $_POST['password'];
                $data['f_name'] = $_POST['f_name'];
                $data['l_name'] = $_POST['l_name'];
                $data['phone_num'] = $_POST['phone_num'];
                $data['gender'] = $_POST['gender'];
                $data['age'] = $_POST['age'];
                $data['balance'] = $_POST['balance'];
                $data['store_name'] = $_POST['store_name'];
                $data['region'] = $_POST['region'];

                echo store::register_store($data);
                //echo  $_POST['region'];

                break;
            case 'login':
                $email = $_POST['email'];
                $password = $_POST['password'];
                echo store::login_store($email, $password);
                // echo "heloooooo";
                break;
            case 'logout':

                session_unset();
                session_destroy();
                // echo "heloooooo";
                break;
            case 'recharge_balance':
                // printf("non");
                $_SESSION['store']->recharge_balance($_POST['amount']);
                break;
            case 'promote_item':

                echo $_SESSION['store']->promot_item($_POST['item_id']);
                break;
            case 'remove_promote_item':

                $_SESSION['store']->remove_promot_from_item($_POST['item_id']);
                break;
            case 'buy_item':
                echo $_SESSION['store']->buy_item($_POST['item_id']);
                break;

            case 'set_edit_item':
                $_SESSION['edit_id'] = $_POST['id'];
                break;
            case 'edit_item':
                $data['name'] = $_POST['name'];
                $data['price'] = $_POST['price'];
                $data['description'] = $_POST['description'];
                $data['category_type'] = $_POST['category_type'];

                $_SESSION['store']->edit_item($_SESSION['edit_id'], $data);
                unset($_SESSION['edit_id']);

                break;
            case 'item':
                //printf("get");
                echo json_encode($_SESSION['store']->get_item());
                break;
            case 'sale_items':
                //echo "jojo";
                //printf("get");
                echo json_encode(store::load_store_items($_POST['id']));
                break;
            case 'bought_items':
                //echo "jojo";
                //printf("get");
                echo json_encode(store::load_owned_items($_POST['id']));
                break;
            case 'sold_items':
                //echo "jojo";
                //printf("get");
                echo json_encode(store::load_sold_items($_POST['id']));
                break;
            case 'user_info':
                //echo "jojo";
                //printf("get");
                $a1 = store::get_info($_POST['id']);
                $a2 = store::get_data($_POST['id']);
                echo json_encode(array_merge($a1, $a2));
                break;
            case 'all_items':
                //echo "jojo";
                //printf("get");
                echo json_encode(store::load_all_items());
                break;
            case 'delete_item':
                echo $_POST['id'];
                $_SESSION['store']->unsell_item($_POST['id']);
                break;
            case 'count':
                echo  json_encode(store::get_SSO($_POST['id'], $_POST['region']));
                break;
            case 'report':
                store::generate_report($_POST['report']);
                break;
            default:
                # code...
                break;
        }
        die();
        break;

    case 'GET':

        switch ($_GET['op']) {
            case 'item':
                printf("inte");
                echo $_SESSION['store']->get_item();
                break;
            default:
                break;
        }
        die();
        # code get items
        break;

    default:
        # code...
        break;
}
   // echo "done";




    // // Headers
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');

    // include_once 'create.php';
    // include_once 'db_one.php';
    // include_once 'db_two.php';
    // include_once 'db_relations.php';
    // include_once 'middleware.php';

    // // Instantiate DB & connect
    // $database  = new()
