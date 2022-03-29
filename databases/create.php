<?php
//SERVER DETAILS
$server = "localhost";
$user = "root";
$pass = "";
//CONNECT TO THE SERVER
$conn = new mysqli($server, $user, $pass);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
//DELETE DATABASE IF EXISTS
$sql = "DROP DATABASE IF EXISTS center";
$conn->query($sql);
$sql = "DROP DATABASE IF EXISTS north";
$conn->query($sql);
$sql = "DROP DATABASE IF EXISTS south";
$conn->query($sql);
//CREATE Sellers DATABASE
$sql = "CREATE DATABASE center";
if ($conn->query($sql) === TRUE) echo "center Database created successfully" . "<br>";
else echo "Error creating database: " . $conn->error . "<br>";
//CREATE Items DATABASE
$sql = "CREATE DATABASE north";
if ($conn->query($sql) === TRUE) echo "north Database created successfully" . "<br>";
else echo "Error creating database: " . $conn->error . "<br>";
//CREATE Relations DATABASE
$sql = "CREATE DATABASE south";
if ($conn->query($sql) === TRUE) echo "south Database created successfully" . "<br>";
else echo "Error creating database: " . $conn->error . "<br>";


/////////////   CONNECT TO THE DATABASE CENTER  ////////////////////////
$conn = new mysqli($server, $user, $pass, "center");
//CREATE data TABLE 
$sql = "CREATE TABLE data(
                        id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        email VARCHAR(30) NOT NULL,
                        password VARCHAR(20) NOT NULL,
                        store_name VARCHAR(20) NOT NULL,
                        balance INT(10) UNSIGNED NOT NULL DEFAULT '0',
                        region VARCHAR(10) NOT NULL,
                        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
if ($conn->query($sql) === TRUE) echo "Table data created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";
//CREATE info TABLE
$sql = "CREATE TABLE info(
                        id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        f_name VARCHAR(20) NOT NULL,
                        l_name VARCHAR(20) NOT NULL,
                        phone_num INT(25) UNSIGNED,
                        gender VARCHAR(10),
                        age INT(7) UNSIGNED,
                        FOREIGN KEY (id) REFERENCES data(id)
                    )";
if ($conn->query($sql) === TRUE) echo "Table info created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";

$sql = "INSERT INTO data(email,password,store_name,region,balance) VALUES('admin','admin','Apple','south','50000')";
if ($conn->query($sql) === TRUE) echo "Admin data inserted " . "<br>";
else echo "Error Inserting admin data: " . $conn->error . "<br>";

$sql = "INSERT INTO info(f_name,l_name,gender,age,phone_num) VALUES('Ahmed','Kaimo','Male','22','1111111111')";
if ($conn->query($sql) === TRUE) echo "Admin info inserted " . "<br>";
else echo "Error Inserting admin info: " . $conn->error . "<br>";

/////////////   CONNECT TO THE DATABASE NORTH  ////////////////////////
$conn = new mysqli($server, $user, $pass, "north");
//CREATE item_data TABLE
$sql = "CREATE TABLE item_data(
                        id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(20) NOT NULL,
                        price INT(25) UNSIGNED,
                        description VARCHAR(200),
                        category_type VARCHAR(20) NOT NULL
                    )";
if ($conn->query($sql) === TRUE) echo "Table item_data created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";
//CREATE item_related TABLE
$sql = "CREATE TABLE item_related(
                        id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        seller_id INT(10) UNSIGNED NOT NULL,
                        owner_id  INT(10) UNSIGNED,
                        sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        purch_date TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (id) REFERENCES item_data(id)
                    )";
if ($conn->query($sql) === TRUE) echo "Table item_related created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";
//CREATE item_promot TABLE 
$sql = "CREATE TABLE item_promot(
                        id INT(10) UNSIGNED,
                        promoter_id INT(10) UNSIGNED,
						FOREIGN KEY (id) REFERENCES item_data(id),
                        CONSTRAINT PK PRIMARY KEY (id,promoter_id)
                    )";
if ($conn->query($sql) === TRUE) echo "Table item_promot created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";



/////////////   CONNECT TO THE DATABASE SOUTH  ////////////////////////
$conn = new mysqli($server, $user, $pass, "south");
//CREATE item_data TABLE
$sql = "CREATE TABLE item_data(
                        id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(20) NOT NULL,
                        price INT(25) UNSIGNED,
                        description VARCHAR(200),
                        category_type VARCHAR(20) NOT NULL
                    )";
if ($conn->query($sql) === TRUE) echo "Table item_data created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";
//CREATE item_related TABLE
$sql = "CREATE TABLE item_related(
                        id INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                        seller_id INT(10) UNSIGNED NOT NULL,
                        owner_id  INT(10) UNSIGNED,
                        sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        purch_date TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (id) REFERENCES item_data(id)
                    )";
if ($conn->query($sql) === TRUE) echo "Table item_related created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";
//CREATE item_promot TABLE 
$sql = "CREATE TABLE item_promot(
                        id INT(10) UNSIGNED,
                        promoter_id INT(10) UNSIGNED,
                        FOREIGN KEY (id) REFERENCES item_data(id),
                        CONSTRAINT PK PRIMARY KEY (id,promoter_id)
                    )";
if ($conn->query($sql) === TRUE) echo "Table item_promot created successfully" . "<br>";
else echo "Error creating Table: " . $conn->error . "<br>";




/////////////   CLOSE THE CONNECTION  ////////////////////////
$conn->close();
