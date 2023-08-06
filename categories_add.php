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
if (isset($_POST["submit"])) {
    $var_p_name = $_POST["p_name"];
    $query = "INSERT INTO `categories`(`name`,`CreatedBy`) VALUES ('$var_p_name','$_SESSION[login]')";
    $result = query_exec($query);
    if ($result) {
        redirect("categories_add.php");
    } else {
        echo "error";
    }
}


if (isset($_GET["del_id"])) {

    $var_id = $_GET["del_id"];
    $query = "UPDATE `categories` SET `DeletedOn`=NOW() ,`DeletedBy`='$_SESSION[login]' WHERE id='$var_id'";
    $result = query_exec($query);
}


?>













<?php include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>


        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/food/online-order-1.png" height="45px" alt=""></span> Menu Categories</h2>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <form method="post" action="categories_add.php">
                                <div class="mb-4">
                                    <input type="hidden" value="<?php echo $rows['id']; ?>" name="p_id" />

                                    <label for="product_name" class="form-label">Name</label>
                                    <input type="text" name="p_name" placeholder="Type here" class="form-control" id="product_name" autocomplete="off" required />
                                </div>


                                <div class="d-grid">
                                    <button type="submit" name="submit" class="btn btn-info" style="letter-spacing: 1.4px;">Create category</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" />
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM `categories` where DeletedOn is null";
                                    $result = query_exec($query);
                                    while ($rows = mysqli_fetch_array($result)) { ?>
                                        <tr>

                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" />
                                                </div>
                                            </td>
                                            <td><?php echo $rows["id"] ?></td>
                                            <td><b><?php echo $rows["name"] ?></b></td>

                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a href="cat_update.php?u_id=<?php echo $rows['id'] ?>" data-bs-toggle=" dropdown" class="btn btn-success"> <i class="material-icons md-Edit"></i> </a>

                                                </div>
                                                <div class="dropdown">
                                                    <!-- <a href="categories_add.php?id=<?php echo $rows['id'] ?>" data-bs-toggle="dropdown" class="btn btn-danger"> <i class="material-icons md-Delete"></i> </a> -->
                                                    <a class="btn btn-danger" href="categories_add.php?del_id=<?php echo $rows['id'] ?>"><i class="material-icons md-Delete"></i></a>

                                                </div>
                                            </td>
                                        <?php } ?>
                                </tbody>
                            </table>

                        </div> <!-- .col// -->
                    </div> <!-- .row // -->
                </div> <!-- card body .// -->
            </div> <!-- card .// -->
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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-categories.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:01 GMT -->

</html>