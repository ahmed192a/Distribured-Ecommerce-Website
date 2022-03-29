<?php
require '../middleware.php';

if (isset($_SESSION['store'])) {
    //echo $_SESSION['store']->get_id();
    //die();
    header("location: DS.php");
}
//echo isset($_SESSION['seller']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Sign up</title>

</head>

<body style="background-color:#f4f7f6;">
    <div class="card mx-auto" style="max-width: 700px; margin-top:100px; margin-bottom:100px;">
        <div class="card-body">
            <h4 class="card-title mb-4">Register New Account</h4>
            <form>
                <div class="row g-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="f_name" class="form-label">First name</label>
                            <input id="f_name" class="form-control" placeholder="f_name" type="text" spellcheck="false" data-ms-editor="true" required>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="l_name" class="form-label">Last name</label>
                            <input id="l_name" class="form-control" placeholder="l_name" type="text" spellcheck="false" data-ms-editor="true" required>
                        </div> <!-- form-group// -->
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control" placeholder="email" type="text" spellcheck="false" data-ms-editor="true" required>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" class="form-control" placeholder="Password" type="password" required>
                        </div> <!-- form-group// -->
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="phone" class="form-label">phone</label>
                            <input id="phone" class="form-control" placeholder="phone_number" type="text" spellcheck="false" data-ms-editor="true" required>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input id="age" class="form-control" placeholder="age" type="text" spellcheck="false" data-ms-editor="true" required>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="store" class="form-label">Store</label>
                            <input id="store" class="form-control" placeholder="store" type="text" spellcheck="false" data-ms-editor="true" required>
                        </div> <!-- form-group// -->
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" aria-label="Default select example" id="gender" required>
                                <option selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-select" aria-label="Default select example" id="region" required>
                                <option selected>Select Region</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                            </select>
                        </div> <!-- form-group// -->
                    </div>
                </div>



                <div class="row g-3">
                    <div class="col">
                        <div class="mb-3">
                            <button class="btn btn-dark" onclick="submitButton()"> Register Now </button>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <a href="../index.php" class="float-right">
                                <h5>Sign in</h5>
                            </a>
                        </div> <!-- form-group form-check .// -->
                    </div>
                </div>





            </form>
        </div> <!-- card-body.// -->
    </div>

    <script type="text/javascript">
        function submitButton() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            var f_name = document.getElementById("f_name").value;
            var l_name = document.getElementById("l_name").value;
            var phone = document.getElementById("phone").value;
            var store = document.getElementById("store").value;
            var region = document.getElementById("region").value;
            var age = document.getElementById("age").value;
            var gender = document.getElementById("gender").value;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert(xmlhttp.responseText);
                    if (xmlhttp.response == 0) {
                        alert("Email already exists");
                    } else
                        location.reload();
                    //location.reload();
                    //alert(xmlhttp.responseText);
                }
            };
            xmlhttp.open("POST", "../request_handler.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("op=register" + "&email=" + email + "&password=" + password + "&f_name=" + f_name + "&l_name=" + l_name + "&phone_num=" + phone + "&gender=" + gender + "&age=" + age + "&store_name=" + store + "&region=" + region + "&balance=" + "0");


        }
    </script>
</body>

</html>