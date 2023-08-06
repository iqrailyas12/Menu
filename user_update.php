<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}

if (isset($_GET["u_id"])) {
    $id = $_GET["u_id"];
    $result = query_exec("select * from customers where id='$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    redirect("user.php");
}








if (isset($_POST["submit"])) {
    $var_id = $_POST["id"];
    $var_fname = $_POST["firstName"];
    $var_lname = $_POST["Lastname"];
    $var_phone = $_POST["phone"];
    $result = query_exec("
    UPDATE `customers` SET `firstName`='$var_fname',`lastname`='$var_lname',`phone`='$var_phone',`LastModifiedOn`=NOW(),`LastModifiedBy`='$_SESSION[login]'  WHERE id='$var_id'");
    $row = mysqli_fetch_assoc($result);
}



?>




<?php include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>


        <section class="content-main" style="max-width:920px">

            <div class="content-header">
            <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/food/online-order-3.png" height="45px" alt=""></span> Customer Data Updation</h2>
            <div>
                    <a href="user.php" class="btn btn-outline-danger"> &times; Discard</a>
                </div>
        </div>
            <form method="post" action="user_update.php" enctype="multipart/form-data">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>1. General info</h6>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <input type="hidden" name="id" value="<?php echo $row["id"] ?>" placeholder="Type here" class="form-control">

                                    <label class="form-label">User First Name</label>
                                    <input type="text" name="firstName" value="<?php echo $row["firstName"] ?>" placeholder="Type here" class="form-control">
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="id" value="<?php echo $row["id"] ?>" placeholder="Type here" class="form-control">

                                    <label class="form-label">User Last Name</label>
                                    <input type="text" name="Lastname" value="<?php echo $row["Lastname"] ?>" placeholder="Type here" class="form-control">
                                </div>
                                
                            </div> <!-- col.// -->
                        </div> <!-- row.// -->

                        <hr class="mb-4 mt-0">

                        <div class="row">
                            <div class="col-md-4">
                                <h6>2. Contact Details</h6>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-4" style="max-width:250px;">
                                    <label class="form-label">Phone Number</label>
                                    <input name="phone" type="text" value="<?php echo $row["phone"] ?>" placeholder="00.0" class="form-control">
                                </div>
                            </div> <!-- col.// -->
                        </div> <!-- row.// -->

                        <hr class="mb-4 mt-0">


                        </div>
                        <! <hr class="mb-4 mt-0">

                            <!-- <div class="row">
                            <div class="col-md-4">
                                <h6>4. Media</h6>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label class="form-label">Images</label>
                                    <input class="form-control" type="file">
                                </div>
                            </div> 
                        </div> -->
                            <!-- .row end// -->
                            <hr class="mb-4 mt-0">

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">Save and activate </button>
                            </div>
                    </div>
                </div> <!-- card end// -->


            </form>
        </section> <!-- content-main end// -->
    </main>

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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-form-product-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:03 GMT -->

</html>