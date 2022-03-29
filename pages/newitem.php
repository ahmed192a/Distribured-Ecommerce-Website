<?php
require '../middleware.php';

//if (isset($_SESSION['seller'])) header("location: test.php");
//echo isset($_SESSION['seller']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Add item</title>
</head>

<body style="background-color:#f4f7f6;">
    <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Item</h4>
            <form>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Item name</label>
                    <input type="text" class="form-control" id="name" placeholder="shirt">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Item price</label>
                    <input type="text" class="form-control" id="price" placeholder="200">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <select class="form-select" aria-label="Default select example" id="category_type">
                    <option selected>Select category</option>
                    <option value="shoe">shoe</option>
                    <option value="hat">hat</option>
                    <option value="shirt">shirt</option>
                </select>
                <br>
                <div class="col-12">
                    <button class="btn btn-dark" onclick="addButton()">Submit</button>
                </div>

            </form>
        </div> <!-- card-body.// -->
    </div>

    <script type="text/javascript">
        function addButton() {
            var name = document.getElementById("name").value;
            var price = document.getElementById("price").value;

            var category_type = document.getElementById("category_type").value;
            var description = document.getElementById("description").value;


            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //location.reload();
                    var ret = xmlhttp.responseText;
                    location.href = "DS1.php";




                }
            };
            xmlhttp.open("POST", "../request_handler.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("op=new_item" + "&name=" + name + "&price=" + price + "&description=" + description + "&category_type=" + category_type);


        }
    </script>
</body>

</html>