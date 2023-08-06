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
    $query = "UPDATE `deals` SET `DeletedOn`=NOW() ,`DeletedBy`='$_SESSION[login]' WHERE id='$var_id'";
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
                border: 1px dotted black;
                box-shadow: 5px 5px 5px 5px;
                height: 70px;
                width: 70px;
                color: black;
                padding-top: 20px;
                font-size: 20px;
                font-family: 'Oswald', sans-serif;
                letter-spacing: 1px;
            }
        </style>

        <section class="content-main">

            <div class="content-header">
                <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/avatar/deals.png" height="50px" alt=""></span>Deals</h2>
                <div>


                    <a href="insertion.php" class="btn btn-info" style="letter-spacing:1px">Add Deals</a>
                </div>
            </div>

            <div class="card mb-4">
                <form class="searchform" method="post" action="deal.php">
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

                                    <select class="form-select" name="status">
                                        <option value="null">Discount Type</option>
                                        <option value="rate">Rate</option>
                                        <option value="percentage">Percent</option>
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
                        <div class="row gx-4 gy-3 py-3 px-3 row-cols-lg-2 row-cols-md-1 row-cols-sm-1 row-cols-1 ">
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
                            $query = "select * from deals where DeletedOn is null LIMIT $start_from, $num_rec_per_page";
                            $result = query_exec($query);
                            if (isset($_POST["submit"]) && $_POST["search"] != "") {
                                $text = $_POST["search"];
                                $query = "SELECT * FROM `deals`
							 WHERE `name` like '%$text%' and  DeletedOn is null";
                                $result = query_exec($query);
                            } else if (isset($_POST["fetch"]) && $_POST["status"] != "") {
                                $get = $_POST["status"];
                                $query = "SELECT * FROM `deals`where discountType='$get' and   DeletedOn is null";
                                $result = query_exec($query);
                            } else {
                                $query = "SELECT * FROM `deals` where DeletedOn is null";
                                $result = query_exec($query);
                            }
                            while ($rows = mysqli_fetch_array($result)) {
                               
                                $_SESSION["deal_name"] = $rows['name'];
                            ?>



                                <div class="col">
                                    <div class="card bg-dark text-white" style="border:1px dotted white">


                                        <?php
                                        if ($rows["discountType"] == 1) { ?>
                                            <span class="notify-badge" style="background-color:yellow;color:black"><?php echo $rows["discountRate"] ?>%</span>


                                        <?php } elseif ($rows["discountType"] == 0) { ?>
                                            <span class="notify-badge">-<?php echo $rows["discountRate"] ?>/=</span>

                                        <?php } else { ?>

                                        <?php    } ?>





                                        <img class="card-img" src="images/deals/<?php echo $rows["image"] ?>" alt="Card image">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-family: 'Bungee Spice', cursive;text-transform:capitalize;text-align:center;letter-spacing:2px">
                                                <?php echo $rows["name"] ?></h5>
                                            <hr>
                                            <?php
                                            if ($rows["discountType"] == 1) {
                                            ?>
                                                <p class="card-text">


                                                    <span style="color:red;font-family:cursive;letter-spacing:1px;font-size:20px">
                                                        Rs: <del><?php echo $rows["price"] ?></del>/=</span>
                                                    <span style="color:yellow;font-family:cursive;letter-spacing:1px;font-size:20px">Rs:
                                                        <?php echo $rows["discountPrice"] ?>/=</span>

                                                </p>





                                            <?php } elseif ($rows["discountType"] == 0) { ?>
                                                <p class="card-text">


                                                    <span style="color:red;font-family:cursive;letter-spacing:1px;font-size:20px">
                                                        Rs: <del><?php echo $rows["price"] ?></del>/=</span>
                                                    <span style="color:yellow;font-family:cursive;letter-spacing:1px;font-size:20px">Rs:
                                                        <?php echo $rows["discountPrice"] ?>/=</span>

                                                </p>

                                            <?php } else { ?>
                                                <p class="card-text">


                                                    <span style="color:yellow;font-family:cursive;letter-spacing:1px;font-size:20px">Rs:
                                                        <?php echo $rows["price"] ?>/=</span>

                                                </p>


                                            <?php    } ?>
                                            <a href="deals_update.php?u_id=<?php echo $rows['id'] ?>" data-bs-toggle=" dropdown" class="btn btn-success"> <i class="material-icons md-Edit"></i> </a>
                                            <a class="btn btn-danger" href="deal.php?del_id=<?php echo $rows['id'] ?>"><i class="material-icons md-Delete"></i></a>
                                            <a href="copy copy.php?deal_id=<?php echo $rows['id'] ?>" data-bs-toggle=" dropdown" class="btn btn-info"> <i class="material-icons md-visibility"></i> </a>







                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                        <?php
                        $sql = "select * from deals";
                        $conn = mysqli_connect('localhost', 'root', '', 'menu_sys_db');

                        $rs_result = mysqli_query($conn, $sql); //run the query
                        $total_records = mysqli_num_rows($rs_result);  //06
                        $total_pages = ceil($total_records / $num_rec_per_page);

                        ?>

                        <div class="text-center learts-mt-70">
                            <?php
                            for ($i = 1; $i < $total_pages; $i++) {
                                echo "<a href='deal.php?page=" . $i . "' class='btn btn-sm btn-primary' >" . $i . "</a> ";
                            };
                            ?>
                        </div>



                </section>


            </div>



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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-products-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:01 GMT -->

</html>