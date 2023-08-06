<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}

if (!isset($_SESSION["login"])) {
    redirect("login.php");
}
$discouting;
$mult;
$done;

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    $discount_type = $_POST["discount_type"];
    $original_price = $_POST["original_price"];
    $discounted_price = $_POST["discounted_price"];

    if ($discount_type == 1) {

        $discount_percent  = ($discounted_price / 100);
        $mult = $original_price * $discount_percent;
        $done = $original_price - $mult;
        $discouting = round($done);
    } elseif ($discount_type == 0) {
        // Calculate discount rate
        $discount_rate = floatval($original_price) - floatval($discounted_price);
        $discouting = round($discount_rate);
    } else {
        echo "Invalid discount type selected.";
    }
    $targetDir = "images/deals/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $var_name = $_POST["name"];

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $result = query_exec("INSERT INTO `deals`(`name`, `price`, `discountType`, `discountRate`, `discountPrice`, `image`,`CreatedBy`) VALUES 
            ('$var_name','$original_price',' $discount_type ','$discounted_price','$discouting','$fileName','$_SESSION[login]')");
        };
        redirect("deal.php");
    };
}





?>


<?php include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>


        <section class="content-main" style="max-width: 720px">

            <div class="content-header">
                <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/avatar/insert.png" height="50px" alt=""></span> Add New Deals</h2>
                <div>
                    <a href="deal.php" class="btn btn-outline-danger"> &times; Discard</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="insertion.php" enctype="multipart/form-data">

                        <div class="mb-4">
                            <label for="product_name" class="form-label">Deal title</label>
                            <input type="text" placeholder="Type here" name="name" class="form-control" id="product_name" required autocomplete="off">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Images</label>
                            <input class="form-control" name="file" type="file">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="discount_type">Select Discount Type:</label>
                            <select name="discount_type" class="form-control" id="discount_type">
                                <option value="2">None</option>
                                <option value="1">Percentage (%)</option>
                                <option value="0">Rate</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="original_price" class="form-label">Original Price:</label>
                            <input type="text" class="form-control" name="original_price" id="original_price" step="0.01" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="discounted_price" class="form-label">Discounted Rate:</label>
                            <input type="text" name="discounted_price" class="form-control" id="discounted_price" step="0.01" autocomplete="off">
                        </div>

                        <label class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" required>
                            <span class="form-check-label"> Publish on website </span>
                        </label>
                        <button class="btn btn-info" style="letter-spacing: 1px;" type="submit" name="submit">Submit item</button>

                    </form>
                </div>
            </div> <!-- card end// -->


        </section> <!-- content-main end// -->
    </main>

    <script>
        document.getElementById("discount_type").addEventListener("change", function() {
            var discountedPriceInput = document.getElementById("discounted_price");
            var discountTypeValue = this.value;

            if (discountTypeValue === "2") {
                discountedPriceInput.disabled = true;
                discountedPriceInput.value = ""; // Clear the value to prevent submission
            } else {
                discountedPriceInput.disabled = false;
            }
        });
    </script>
    <script>
        if (localStorage.getItem("darkmode")) {
            var body_el = document.body;
            body_el.className += 'dark';
        }
    </script>

    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/scriptc619.js?v=1.0"></script>

</body>

<!-- Mirrored from www.ecommerce-admin.com/demo/page-form-product-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:03 GMT -->

</html>