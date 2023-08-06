<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}


if (isset($_GET["del_id"])) {
    $currentDatetime = date("Y-m-d H:i:s");

    $var_id = $_GET["del_id"];
    $query = "UPDATE `items` SET `DeletedOn`=NOW() ,`DeletedBy`='$_SESSION[login]' WHERE id='$var_id'";
    $result = query_exec($query);
}


?>






<?php include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>

        <style>
            .notify-badge {
                position: absolute;
                left: -20px;
                top: -10px;
                background: red;
                text-align: center;
                border-radius: 50%;
                border: 1px solid black;
                box-shadow: 5px 5px 5px 5px;
                height: 60px;
                z-index: 9;
                width: 60px;
                color: black;
                padding-top: 15px;
                font-size: 20px;
                font-family: 'Oswald', sans-serif;
                letter-spacing: 1px;
            }
        </style>

        <section class="content-main">

            <div class="content-header">
                <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/avatar/menu.png" height="50px" alt=""></span> Menu Items</h2>
                <div>


                    <a href="item_insert.php" class="btn btn-info" style="letter-spacing:1px">Add New Item</a>
                </div>
            </div>

            <div class="card mb-4">
                <form class="searchform" method="post" action="item.php">
                    <header class="card-header">
                        <div class="row gx-3">
                            <div class="col-lg-4 col-md-6 me-auto">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search Product" autocomplete="off">
                                    <button class="btn btn-light bg" name="submit" type="submit"> <i class="material-icons md-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6 col-md-3">
                                <div class="input-group">


                                    <select class="form-select" name="category" required autocomplete="off">
                                        <optgroup label="select category">
                                            <option value="0">Item Categories</option>
                                            <?php
                                            $cat_query = "select * from categories";
                                            $result = query_exec($cat_query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($cat_row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <option value="<?php echo $cat_row["id"] ?>"><?php echo $cat_row["name"] ?>
                                                    </option>
                                            <?php
                                                }
                                            }



                                            ?>



                                        </optgroup>
                                    </select>
                                    <button class="btn btn-light bg" name="fetch" type="submit"> <i class="material-icons md-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </header>
                </form>
                <section>
                    <div class="container">
                        <div class="row gx-4 gy-3 py-3 px-3 row-cols-lg-4 row-cols-md-1 row-cols-sm-1 row-cols-1 ">
                            <?php
                            $num_rec_per_page = 20;
                            $done = 0;
                            $result = "";

                            if (isset($_GET["page"])) {
                                $page  = $_GET["page"];
                            } else {
                                $page = 1;
                            }
                            $start_from = ($page - 1) * $num_rec_per_page;
                            $query = "select items.*,categories.name from items inner join categories on items.category_id = categories.id where items.DeletedOn is null  LIMIT $start_from, $num_rec_per_page";
                            $result = query_exec($query);
                            if (isset($_POST["submit"]) && $_POST["search"] != "") {
                                $text = $_POST["search"];
                                $query = "select items.*,categories.name from items inner join categories on items.category_id = categories.id 
							 WHERE item_name like '%$text%' and items.DeletedOn is null";
                                $result = query_exec($query);
                            } else if (isset($_POST["fetch"]) && $_POST["category"] != "") {
                                $get = $_POST["category"];
                                $query = "select items.*,categories.name from items inner join categories on items.category_id = categories.id where category_id='$get' and categories.DeletedOn is null ";
                                $result = query_exec($query);
                            } else {
                                $query = "select items.*,categories.name from items inner join categories on items.category_id = categories.id where items.DeletedOn is null";

                                $result = query_exec($query);
                            }
                            while ($rows = mysqli_fetch_array($result)) {

                            ?>

                                <div class="col">
                                    <div class="card card-product-grid" style="position: relative;border: none;border-radius: 15px;background-color:#111126 ;box-shadow: 0 2px 8px 0 rgba(99,99,99,.2);border:1px dotted #3b3b87">

                                        <?php
                                        if ($rows["discount_type"] == 1) { ?>
                                            <span class="notify-badge" style="background-color:yellow;color:black"><?php echo $rows["discount_rate"] ?>%</span>


                                        <?php } elseif ($rows["discount_type"] == 0) { ?>
                                            <span class="notify-badge">-<?php echo $rows["discount_rate"] ?>/=</span>

                                        <?php } else { ?>

                                        <?php    } ?>



                                        <a href="#" class="img-wrap" style="background-color:#111126"> <img src="images/burger/<?php echo $rows["image"] ?>" alt="Product"> </a>
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-family: 'Bungee Spice', cursive;">
                                                <?php echo $rows["item_name"] ?></h5>
                                            <hr>

                                            <h6 class="card-subtitle mb-2 text-muted" style="font-family: 'Lugrasimo', cursive;text-transform:capitalize">
                                                <?php echo $rows["name"] ?>
                                            </h6>


                                            <?php
                                            if ($rows["discount_type"] == 1) {
                                            ?>
                                                <p class="card-text">


                                                    <span style="color:red;font-family:cursive;letter-spacing:1px;font-size:15px">
                                                        Rs: <del><?php echo $rows["price"] ?></del>/=</span>
                                                    <span style="color:yellow;font-family:cursive;letter-spacing:1px;font-size:15px">Rs:
                                                        <?php echo $rows["discounted_amount"] ?>/=</span>

                                                </p>

                                            <?php } elseif ($rows["discount_type"] == 0) { ?>
                                                <p class="card-text">


                                                    <span style="color:red;font-family:cursive;letter-spacing:1px;font-size:15px">
                                                        Rs: <del><?php echo $rows["price"] ?></del>/=</span>
                                                    <span style="color:yellow;font-family:cursive;letter-spacing:1px;font-size:15px">Rs:
                                                        <?php echo $rows["discounted_amount"] ?>/=</span>

                                                </p>

                                            <?php } else { ?>
                                                <p class="card-text">


                                                    <span style="color:yellow;font-family:cursive;letter-spacing:1px;font-size:15px">Rs:
                                                        <?php echo $rows["price"] ?>/=</span>

                                                </p>


                                            <?php    } ?>

                                            <h6 class="mt-2 mb-2 " style=" font-family: 'Oswald', sans-serif;text-transform:capitalize;letter-spacing:1.5px">
                                                <i class="material-icons md-timer " style="color:yellow"></i> <?php echo $rows["estimatedPreparationTimeMin"] ?>min
                                            </h6>


                                            <a href="items_update.php?u_id=<?php echo $rows['id'] ?>" data-bs-toggle=" dropdown" class="btn btn-success"> <i class="material-icons md-Edit"></i> </a>
                                            <a class="btn btn-danger" href="item.php?del_id=<?php echo $rows['id'] ?>"><i class="material-icons md-Delete"></i></a>
                                            

                                        </div>
                                    </div> <!-- card-product  end// -->

                                </div>
                            <?php  } ?>


                        </div>
                    </div>
                </section>
            </div>
        </section>








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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-products-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:01 GMT -->

</html>