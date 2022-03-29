<?php
require "middleware.php";

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function test_user_correct_data()
    {
        $email = "admin";
        $password = "admin";
        $result = store::login_store($email, $password);
        $expected = 2;
        $this->assertEquals($expected, $result);
    }
    public function test_user_wrong_pass()
    {
        $email = "admin";
        $password = "wrongpass";
        $result = store::login_store($email, $password);
        $expected = 1;
        $this->assertEquals($expected, $result);
    }
    public function test_user_wrong_mail()
    {
        $email = "nomail";
        $password = "admin";
        $result = store::login_store($email, $password);
        $expected = 0;
        $this->assertEquals($expected, $result);
    }
    public function test_register_new_user()
    {
        $data['email'] = "testuser@user";
        $data['password'] = "firstuser";
        $data['f_name'] = "user";
        $data['l_name'] = 'name';
        $data['phone_num'] = "12514586";
        $data['gender'] = "male";
        $data['age'] = "22";
        $data['balance'] = "1000";
        $data['store_name'] = "store 1";
        $data['region'] = "North";

        $result = store::register_store($data);
        $expected = 1;
        $this->assertEquals($expected, $result);
    }
    public function test_register_existing_user()
    {
        $data['email'] = "testuser@user";
        $data['password'] = "firstuser";
        $data['f_name'] = "user";
        $data['l_name'] = 'name';
        $data['phone_num'] = "12514586";
        $data['gender'] = "male";
        $data['age'] = "22";
        $data['balance'] = "1000";
        $data['store_name'] = "store 1";
        $data['region'] = "North";

        $result = store::register_store($data);
        $expected = 0;
        $this->assertEquals($expected, $result);
    }
}
