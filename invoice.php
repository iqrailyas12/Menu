<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}


if (isset($_GET["id"])) {

    $var_id = $_GET["id"];
    //$query="select * from order_details where order_id=$var_id";
    $result = query_exec("select order_details.*, case when order_details.item_id is not NULL then (select item_name from items where id = order_details.item_id) else (select name from deals where id = order_details.deal_id) end as name from order_details where order_details.order_id = $var_id;");


    $order_query = "select tables.id as table_id, waiters.name, orders.* from orders inner join tables on tables.id = orders.table_id INNER join waiters on waiters.id=orders.waiter_id where orders.id = $var_id";
    $order_result = query_exec($order_query);
    $order = mysqli_fetch_assoc($order_result);
}
?>




<?php include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>

    <main class="main-wrap">

        <?php include("headerr.php") ?>

        <section class="content-main">

            <div class="content-header">
                <h2 class="content-title">Order detail</h2>
            </div>


            <div class="card">
                <header class="card-header">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <span>
                                <i class="material-icons md-calendar_today"></i>
                                <b><?php echo $order["order_date"] ?></b>
                            </span> <br>
                            <small class="text-muted">Invoice no: <?php echo $order["invoice_no"] ?></small>
                        </div>
                        <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                           
                            <a class="btn btn-light" href="#">Save</a>
                            <a class="btn btn-secondary ms-2"  onclick="window.print();" href="#"><i class="icon material-icons md-print"></i></a>
                        </div>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">

                    <div class="row mb-5 order-info-wrap">
                       
                        
                        <div class="col-md-6">
                            <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-primary material-icons md-local_shipping"></i>
                                </span>
                                <div class="text">
                                    <h6 class="mb-1">Order On Table</h6>
                                    <p class="mb-1">
                                        Shipping: Fargo express <br> Pay method: card <br> table id:
                                        <?php echo $order["table_id"] ?>
                                    </p>
                                  
                                </div>
                            </article>
                        </div> <!-- col// -->
                        <div class="col-md-6">
                            <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-primary material-icons md-place"></i>
                                </span>
                                <div class="text">
                                    <h6 class="mb-1">waiter</h6>
                                    <p class="mb-1">
                                        <?php echo $order["name"] ?>
                                    </p>
                                  
                                </div>
                            </article>
                        </div> <!-- col// -->
                    </div> <!-- row // -->

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table border table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th width="40%">Product</th>
                                            <th width="20%">Unit Price</th>
                                            <th width="20%">Quantity</th>
                                            <th width="20%" class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $single_pro_amount = 0;
                                        $gross_amount = 0;
                                        $tax_amount = 0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $single_pro_amount = ($row["price"] * $row["quantity"]);
                                            $gross_amount = $gross_amount + $single_pro_amount;

                                        ?>
                                            <tr>
                                                <td>


                                                    <div class="info"> <?php echo $row['name'] ?></div>

                                                </td>
                                                <td><?php echo $row['price'] ?> </td>
                                                <td> <?php echo $row['quantity'] ?> </td>
                                                <td class="text-end"> <?php echo $row['total_amnt'] ?> </td>
                                            </tr>
                                        <?php
                                            $tax_amount = ($gross_amount + 150);
                                        }

                                        ?>
                                        <td colspan="4">
                                            <article class="float-end">
                                                <dl class="dlist">
                                                    <dt>Subtotal:</dt>
                                                    <dd> $ <?php echo $order['total_amnt'] ?></dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Shipping cost:</dt>
                                                    <dd>$10.00</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Grand total:</dt>
                                                    <dd> $<b class="h5"> <?php echo $tax_amount ?></b> </dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt class="text-muted">Status:</dt>
                                                    <dd>

                                                        <?php
                                                        if ($order["status"] == "dispatch") {
                                                        ?>
                                                            <span class="badge rounded-pill bg-danger">
                                                                <?php echo "Cancel" ?></span>

                                                        <?php
                                                        } else if ($order["status"] == "Receiving") {
                                                        ?>
                                                            <span class="badge rounded-pill bg-success"><?php echo "Payment Done" ?></span>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge rounded-pill bg-warning"><?php echo "Not Received" ?></span>



                                                        <?php
                                                        }
                                                        ?>

                                                        </span>
                                                    </dd>
                                                </dl>
                                            </article>
                                        </td>
                                    </tbody>
                                </table>
                            </div> <!-- table-responsive// -->
                        </div> <!-- col// -->
                        <div class="col-lg-4">
                            <div class="box shadow-sm bg-light">
                                <h6>Payment info</h6>
                                <p>
                                    <img src="images/card-brands/2.png" class="border" height="20"> Master Card ****
                                    **** 4768 <br>
                                    Business name: Grand Market LLC <br>
                                    Phone: +1 (800) 555-154-52
                                </p>
                            </div>
                            <div class="h-25 pt-4">
                                <div class="mb-3">
                                    <label>Notes</label>
                                    <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                                </div>
                                <button class="btn btn-primary">Save note</button>
                            </div>
                        </div> <!-- col// -->

                    </div>
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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-orders-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:02 GMT -->

</html>