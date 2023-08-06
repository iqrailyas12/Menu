<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
    redirect("login.php");
}





include("headerlinks.php") ?>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/avatar/avatar-10.png" height="50px" alt=""></span>Admin Dashboard</h2>
                <div>


                    <a href="backupindex.php" class="btn btn-info" style="letter-spacing:1px">Backup Database</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-body mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="w-100 d-flex align-items-center">
                                    <div class="col-auto pe-1">
                                        <span><img src="images/food/online-order-3.png" height="50px" alt=""> </span>
                                    </div>
                                    <div class="col-auto flex-grow-1">
                                        <div class="fs-5"><b>Total Orders</b></div>
                                        <div class="fs-6 text-end fw-bold">
                                            <?php
                                            $result = query_exec("SELECT count(id) as `count` FROM `orders`");
                                            $record = $result->num_rows;
                                            echo $record;

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- card  end// -->
                </div> <!-- col end// -->
                <div class="col-lg-4">
                    <div class="card card-body mb-4">

                        <div class="card">
                            <div class="card-body">
                                <div class="w-100 d-flex align-items-center">
                                    <div class="col-auto pe-1">
                                        <span><img src="images/food/online-order-4.png" height="50px" alt=""> </span>
                                    </div>
                                    <div class="col-auto flex-grow-1">
                                        <div class="fs-5"><b>Total Sales</b></div>
                                        <div class="fs-6 text-end fw-bold">
                                            <?php
                                            $result = query_exec("SELECT total_amnt  FROM `orders`");
                                            $total = 0;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $total += $row["total_amnt"];
                                                }
                                            }
                                            echo $total;

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- card  end// -->
                </div>
                <div class="col-lg-4">
                    <div class="card card-body mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="w-100 d-flex align-items-center">
                                    <div class="col-auto pe-1">
                                        <span><img src="images/food/online-order-1.png" height="50px" alt=""> </span>
                                    </div>
                                    <div class="col-auto flex-grow-1">
                                        <div class="fs-5"><b>Total Items</b></div>
                                        <div class="fs-6 text-end fw-bold">
                                            <?php
                                            $result = query_exec("SELECT count(*) as total_result FROM `items`");
                                            $total = 0;
                                            $record=0;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $total += $row["total_result"];
                                                }
                                            }
                                         
                                            echo $record;

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- card  end// -->
                </div>

            </div>
             <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Sale statistics</h5>
                            <canvas height="120" id="myChart"></canvas>
                        </article> <!-- card-body end// -->
                    </div> <!-- card end// -->
                </div> <!-- col end// -->
                <div class="col-xl-4 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">

                            <h5 class="card-title">Marketing</h5>


                            <span class="text-muted">Facebook page</span>
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 15%">15%
                                </div>
                            </div>

                            <span class="text-muted">Instagram page</span>
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 65%">65% </div>
                            </div>

                            <span class="text-muted">Google search</span>
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 51%"> 51% </div>
                            </div>


                            <span class="text-muted">Other links</span>
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 80%"> 80%</div>
                            </div>
                            <br>
                            <a href="#" class="btn btn-light">Open analytics <i class="material-icons md-open_in_new"></i> </a>
                        </article> <!-- card-body end// -->
                    </div> <!-- card end// -->
                </div> <!-- col end// -->
                </div> <!-- row end// -->

                <!-- card end// -->
               <!-- row end// -->
        </section> <!-- content-main end// -->
    </main>



















    <?php include("footerlinks.php") ?>

</body>

</html>