<?php
require 'middleware.php';

if (isset($_SESSION['store'])) header("location: pages/DS.php");
//echo isset($_SESSION['seller']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Sign in</title>

</head>

<body style="background-color:#f4f7f6;">
    <div class="card mx-auto" style="max-width: 500px; margin-top:100px;">
        <div class="card-body">
            <h4 class="card-title mb-4">Sign in</h4>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" class="form-control" placeholder="Email" type="text" spellcheck="false" data-ms-editor="true" required>
                </div> <!-- form-group// -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" class="form-control" placeholder="Password" type="password" required>
                </div> <!-- form-group// -->



                <div class="row g-3">
                    <div class="col">
                        <div class="col-12">
                            <button class="btn btn-dark" onclick="submitButton()"> Login </button>
                        </div> <!-- form-group// -->
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <a href="pages/register.php" class="float-right">
                                <h5>Sign Up</h5>
                            </a>
                        </div> <!-- form-group form-check .// -->
                    </div>
                </div>

                <!-- <br> -->

            </form>
        </div> <!-- card-body.// -->
    </div>

    <script type="text/javascript">
        function submitButton() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (xmlhttp.response == 0) {
                        alert("Email doesn't exist");
                    } else if (xmlhttp.response == 1) {
                        alert("Wrong password");
                    } else
                        location.reload();
                    //alert(xmlhttp.responseText);
                }
            };
            xmlhttp.open("POST", "request_handler.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("op=login" + "&email=" + email + "&password=" + password);


        }
    </script>
</body>

</html>