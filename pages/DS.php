<?php
require '../middleware.php';
if (!isset($_SESSION['store'])) header("location: ../index.php");



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Çukur Store</title>
    <link rel="stylesheet" href="../assets/css/project.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="http://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


</head>

<body>

    <div class="header">



        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="../assets/photos/cc.png" width="125px">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="DS.php">Home</a></li>
                        <li><a href="DS1.php">Products</a></li>
                        <li>
                            <?php
                            echo '<a  onclick="pro(' . $_SESSION['store']->get_id() . ')">Profile</a>';
                            ?>

                        </li>
                        <li>
                            <a onclick="outButton()">Logout</a>
                        </li>
                        <li><img src="../assets/photos/cart.png" class="cart-icon" width="30px" height="30px"></li>

                    </ul>
                    <!-- <div class="search-box">
                        <input class="search-txt" type="text" name="" placeholder="Search">
                        <a class="search-btn" href="#">
                            <i class="fas fa-search"></i>

                        </a>
                    </div> -->
                </nav>

                <img src="../assets/photos/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1>Buy all you need<br>With best price ever!</h1>
                    <p>Everyday with us is Black Friday</p>
                    <a href="DS1.php" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="../assets/photos/Untitled-removebg-preview.png">

                </div>
            </div>
        </div>

    </div>
    </div>
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }

        function outButton() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                    //alert(xmlhttp.responseText);
                }
            };
            xmlhttp.open("POST", "../request_handler.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("op=logout");


        }

        function pro(id) {
            location.href = "profile.php?id=" + id;


        }
    </script>
</body>

</html>