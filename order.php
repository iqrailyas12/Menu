<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}


$conn = mysqli_connect("localhost", "root", "", "e_project");

if (isset($_GET["status"])) {
    $var_status = $_GET["status"];
    $var_id = $_GET["id"];
    $query = "update orders set status='$var_status' where id=$var_id";
    $result = mysqli_query($conn, $query);
}
$query = "SELECT orders.*, waiters.name, customers.firstName FROM orders INNER JOIN waiters ON orders.waiter_id = waiters.id INNER JOIN customers ON orders.customer_id = customers.id";

$result = query_exec($query);



if (isset($_POST["submit"]) && $_POST["search"] != "") {
    $var_search = $_POST["search"];
    $query = "SELECT orders.*, waiters.name, customers.firstName FROM orders INNER JOIN waiters ON orders.waiter_id = waiters.id INNER JOIN customers ON orders.customer_id = customers.id where customers.firstName like '$var_search%'";
    $result = query_exec($query);
} elseif (isset($_POST["fetch"]) && $_POST["status"] != "") {
    $get = $_POST["status"];
    $query = "SELECT orders.*, waiters.name, customers.firstName FROM orders INNER JOIN waiters ON orders.waiter_id = waiters.id INNER JOIN customers ON orders.customer_id = customers.id where orders.status='$get'";
    $result = query_exec($query);
} else {
    $query = "SELECT orders.*, waiters.name, customers.firstName FROM orders INNER JOIN waiters ON orders.waiter_id = waiters.id INNER JOIN customers ON orders.customer_id = customers.id";
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
				<h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/food/online-order-4.png" height="50px" alt=""></span> Orders</h2>
                    <div>
                        <a href="#" class="btn btn-primary"><i class="material-icons md-plus"></i> Create Report</a>
                    </div>
                </div>

                <div class="card mb-4">
                    <header class="card-header">
                        <form method="post" action="order.php">
                            <div class="row gx-3">



                                <div class="col-lg-3 col-6 col-md-3">
                                    <div class="input-group">
                                        <select class="form-select" name="status">
                                            <option value="">Status</option>
                                            <option value="1">Active</option>
                                            
                                            <option value="0">Dispatch</option>
                                        </select>
                                        <button class="btn btn-light bg" name="fetch" type="submit"> <i class="material-icons md-search"></i>
                                        </button>
                                    </div>
                                </div>
                               
                            </div>
                        </form>
                    </header> <!-- card-header end// -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#Invoice No</th>
                                        <th scope="col">Customer Name</th>
                                      
                                        <th scope="col">Waiter Name</th>
                                        <th scope="col">No of Items</th>
                                       
                                       
                                       
                                        <th scope="col">Net Amount</th>
                                        <th scope="col">Status</th>
                                       

                                        <th scope="col" class="text-end"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row["invoice_no"] ?></td>
                                            <td><b><?php echo $row["firstName"] ?></b></td>
                                            
                                            <td><b><?php echo $row["name"] ?></b></td>
                                            <td><b><?php echo $row["no_items"] ?></b></td>
                                           
                                           
                                          
                                            <td>Rs: <?php echo $row["net_amnt"] ?></td>
                                            <?php
                                            if ($row["status"] == 0) {
                                            ?>
                                                <td><span class="badge rounded-pill bg-danger">Dispatch</span>
                                                </td>
                                            <?php
                                            } else if ($row["status"] == 1) {
                                            ?>
                                                <td><span class="badge rounded-pill bg-success">Active</span>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><span class="badge rounded-pill bg-warning"><?php echo $row["status"] ?></span>
                                                </td>


                                            <?php
                                            }
                                            ?>

                                            
                                            <td >
                                                <a href="invoice.php?id=<?php echo $row['id'] ?>" class="btn btn-light">View</a>
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light"> <i class="material-icons md-more_horiz"></i> </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="order.php?status=1&id=<?php echo $row['id'] ?>">Pending</a>
                                                        <a class="dropdown-item" href="order.php?status=0&id=<?php echo $row['id'] ?>">Receiving</a>
                                                    </div>
                                                </div> <!-- dropdown //end -->
                                            </td>
                                        </tr>


                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> <!-- table-responsive //end -->
                    </div> <!-- card-body end// -->
                </div> <!-- card end// -->


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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-orders-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:01 GMT -->

</html>