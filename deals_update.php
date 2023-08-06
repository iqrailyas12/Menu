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

if (isset($_GET["u_id"])) {
    $id = $_GET["u_id"];
    $result = query_exec("select * from deals where id='$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    redirect("deal.php");
}



if (isset($_POST["submit"])) {
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
    $var_id = $_POST["id"];
    $var_name = $_POST["name"];
    // Handle image upload
    if (!empty($_FILES["new_image"]["name"])) {
        $new_image = $_FILES["new_image"]["name"];
        move_uploaded_file($_FILES["new_image"]["tmp_name"], "uploads/" . $new_image);
        // Update the image in the database
        query_exec("UPDATE `deals` SET `image`='$new_image' WHERE id=$var_id;");
    }

    $result = query_exec("UPDATE `deals` SET `name`='$var_name',`price`='$original_price',`discountType`='$discount_type',`discountRate`='$discounted_price',
    `discountPrice`='$discouting',`LastModifiedOn`=NOW() ,`LastModifiedBy`='$_SESSION[login]' WHERE id='$var_id'");
    $row = mysqli_fetch_assoc($result);
}



?>


<?php include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>


        <section class="content-main" style="max-width: 720px">

            <div class="content-header">
                <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/food/online-order-3.png" height="50px" alt=""></span> Deals Updation</h2>
                <div>
                    <a href="deal.php" class="btn btn-outline-danger"> &times; Discard</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="deals_update.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row["id"] ?>" placeholder="Type here" class="form-control">

                        <div class="mb-4">
                            <label for="product_name" class="form-label">Deal title</label>
                            <input type="text" placeholder="Type here" name="name" value="<?php echo $row["name"] ?>" class="form-control" id="product_name" required autocomplete="off">
                        </div>

                        <div class="mb-4">
                            <a href="#" name="image_p"> <img src="images/deals/<?php echo $row["image"] ?>" height="250px" class="border border-white" alt="Product"> </a>

                        </div>

                        <!-- New image upload field -->
                        <div class="mb-4">
                            <label for="new_image" class="form-label">Update Item Image:</label>
                            <input type="file" name="new_image" class="form-control" id="new_image">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="discount_type">Select Discount Type:</label>
                            <select name="discount_type" class="form-control" id="discount_type">
                                <?php
                                if ($row["discountType"] == 1) { ?>
                                    <option value="<?php echo $row["discountType"] ?>">Percentage</option>

                                    <option value="2">None</option>

                                    <option value="0">Rate</option>

                                <?php } elseif ($row["discountType"] == 0) { ?>
                                    <option value="<?php echo $row["discountType"] ?>">Rate</option>

                                    <option value="2">None</option>

                                    <option value="1">Percentage (%)</option>
                                <?php } else { ?>
                                    <option value="<?php echo $row["discountType"] ?>">None</option>


                                    <option value="1">Percentage (%)</option>
                                    <option value="0">Rate</option>
                                <?php    } ?>

                               
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="original_price" class="form-label">Original Price:</label>
                            <input type="text" class="form-control" value="<?php echo $row["price"] ?>" name="original_price" id="original_price" step="0.01">
                        </div>
                        <div class="mb-4">
                            <label for="discounted_price" class="form-label">Discounted Rate:</label>
                            <input type="text" name="discounted_price" value="<?php echo $row["discountRate"] ?>" class="form-control" id="discounted_price" step="0.01">
                        </div>


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