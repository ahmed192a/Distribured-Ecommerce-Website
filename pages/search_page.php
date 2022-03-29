<?php
require '../middleware.php';

if (!isset($_SESSION['store'])) header("location: ../index.php");
if ($_GET['q'] == '') {
    echo "empty search<br>";
    echo '<a class="btn btn-outline-success" type="submit" href="DS1.php">back</a>';
    die();
}
$q = $_GET['q'];

$id = $_SESSION['store']->get_id();

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
    <title>Home page</title>
    <link rel="stylesheet" href="../assets/css/prof.css">


</head>

<body onload="Loadingg(<?php echo  $id . ',\'' . $q . '\'';  ?>)">

    <div class="container">
        <div id="content" class="content p-0">
            <div class="profile-header">

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
                            <form class="d-flex" action="search_page.php" method="GET">
                                <input class="form-control me-2" type="search" placeholder="Search" name="q" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>

            </div>

            <div class="profile-container">
                <div class="row row-space-20">
                    <div class="col-md-8">
                        <div class="tab-content p-0">
                            <div class="tab-pane active show" id="items-table">
                                <div class="row clearfix">
                                    <div class="col-lg-8 col-md-8 col-sm-12"><b>Items</b></div>
                                </div>
                                <br>
                                <br>

                                <div class="row clearfix" id="card_table">



                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>


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

    <script type="text/javascript" src="../assets/js/home.js"></script>

</body>

</html>