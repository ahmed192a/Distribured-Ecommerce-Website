<?php
require '../middleware.php';
if (!isset($_SESSION['store'])) header("location: ../index.php");
$id = '7';
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $id = $_GET['id'];
    //die();
}

//if($_SESSION['seller']['id'])
$is_me = ($id == $_SESSION['store']->get_id()) ? true : false;
$is_admin = ($id == '1' && $is_me) ? true : false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/prof.css">


</head>

<body onload="Loading(<?php if ($is_me) echo '1,\'' . $id . '\'';
                        else echo '0,\'' . $id . '\'';  ?>)">

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <h1>STORE</h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="DS.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="DS1.php">Products</a>
                        </li>

                        <li class="nav-item">
                            <?php
                            echo '<a class="nav-link" onclick="pro(' . $_SESSION['store']->get_id() . ')">Profile</a>';
                            ?>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="outButton()">Logout</a>
                        </li>





                    </ul>

                </div>
            </div>
        </nav>
        <br>
        <div id="content" class="content p-0">
            <div class="profile-header">

                <div class="profile-header-cover">

                </div>

                <div class="profile-header-content">

                    <div class="profile-header-img">
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" />
                    </div>

                    <div class="profile-header-info">

                    </div>
                    <div class="container">
                        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                        <div class="row">


                            <div class="col-md-8">
                                <h4 class="m-t-sm" id="user_name">Ahmed Mohamed</h4>
                                <?php

                                if ($is_me) echo '<h6 class="m-t-sm" id="balance">Balance :</h6>';

                                ?>
                            </div>
                            <div class="col-6 col-md-4">
                                <table class="table-light" style="color:white">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sold items | </th>
                                            <th scope="col">In Sale |</th>
                                            <th scope="col">Bought</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id='count_sold'></td>
                                            <td id='count_sale'></td>
                                            <td id='count_bought'></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-8">
                            <div class="tab-content p-0">
                                <div class="tab-pane active show" id="items-table">
                                    <div class="row clearfix">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <h4 class="m-t-sm" id="user_name">Ahmed Mohamed</h4>
                                            <?php

                                            if ($is_me) echo '<h6 class="m-t-sm" id="balance">Balance :</h6>';

                                            ?>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <table class="table-light">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sold items</th>
                                                        <th scope="col">In Sale</th>
                                                        <th scope="col">Bought</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>1</td>
                                                        <td>5</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>



                                </div>
                            </div>
                        </div> -->


                </div>
            </div>

            <ul class="profile-header-tab nav nav-tabs">
                <li class="nav-item"><button onclick="switch_tabs(1)" class="nav-link active show" id="sale" data-toggle="tab">Published Items</button></li>
                <?php

                if ($is_me) {

                    echo '<li class="nav-item"><button onclick="switch_tabs(2)" class="nav-link" id="bought" data-toggle="tab">Bought</button></li>';
                    echo '<li class="nav-item"><button onclick="switch_tabs(3)" class="nav-link" id="sold" data-toggle="tab">Sold</button></li>';
                }
                if ($is_admin) {
                    echo '<li class="nav-item"><button onclick="switch_tabs(4)" class="nav-link" id="report" data-toggle="tab">reports</button></li>';
                }
                ?>

            </ul>
        </div>

        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-8">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="items-table">
                            <div class="row clearfix">
                                <div class="col-lg-8 col-md-8 col-sm-12"><b>Items</b></div>
                                <?php

                                if ($is_me) {

                                    echo '
                                    <div class="col-lg-4 col-md-8 col-sm-12">
                                        <a href="newitem.php" class="btn pmd-btn-fab pmd-ripple-effect btn-dark" role="button">Add Item</a>
                                    </div>';
                                }
                                ?>

                            </div>
                            <br>
                            <br>

                            <div class="row clearfix" id="card_table">



                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 hidden-xs hidden-sm" id='side'>
                    <?php

                    if ($is_me) {

                        echo '

                        <form>
                            <div class="form-group">
                                <label for="Balnce">Add Balance</label>
                                <input type="text" class="form-control" id="Balance" placeholder="200">
                            </div>
                            <br>
                            <button class="btn btn-default" style="background:grey; color:white" onclick="rechargeBalance()">Submit</button>

                        </form>
                        <hr>';
                    }
                    ?>
                    <ul class="profile-info-list">


                        <li class="title">
                            <h4>PERSONAL INFORMATION</h4>
                        </li>
                        <li>
                            <div class="field">Store Name:</div>
                            <div class="value" id="store_name"></div>
                        </li>
                        <li>
                            <div class="field">Age</div>
                            <div class="value" id="age"></div>
                        </li>
                        <li>
                            <div class="field">Region:</div>
                            <div class="value" id="region"></div>
                        </li>
                        <li>
                            <div class="field">Mail:</div>
                            <div class="value" id="email">
                                ahmed@ahmed
                            </div>
                        </li>
                        <li>
                            <div class="field">Phone No.:</div>
                            <div class="value" id="phone">

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    </div>




    <script type="text/javascript" src="../assets/js/cards.js"></script>
    <script type="text/javascript">
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