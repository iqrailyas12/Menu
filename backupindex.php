<?php
session_start();
require_once("crud.php");
require_once("helpermethod.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Backup my database | BMD</title>
    <meta name="description" content="Backup my database is a free database backup software for any developer to use on your site to backup recent DATABASE." />
    <meta name="keywords" content="database, mysql, db, backup, localhost, username, user, password, phpmyadmin" />
    <meta name="author" content="Ritedev Technologies" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- switchery CSS -->
    <link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <?php include("headerlinks.php") ?>
</head>

<body>

    <?php include("header.php") ?>


    <main class="main-wrap">
        <?php include("headerr.php") ?>


        <section class="content-main" style="max-width: 720px">

            <div class="content-header">
                <h2 class="content-title"  style="color:white ;">Backup Database </h2>

            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="database_backup.php" method="post" id="">
                        <div class="form-group">
                            <label class="control-label mb-10"  style="color:white ;">Host</label>
                            <input type="text" class="form-control" placeholder="Enter Server Name EX: Localhost" name="server" id="server" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" style="color:white ;">Database Username</label>
                            <input type="text" class="form-control" placeholder="Enter Database Username EX: root" name="username" id="username" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="pull-left control-label mb-10"  style="color:white ;">Database Password</label>
                            <input type="password" class="form-control" placeholder="Enter Database Password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label class="pull-left control-label mb-10"  style="color:white ;">Database Name</label>
                            <input type="text" class="form-control" placeholder="Enter Database Name" name="dbname" id="dbname" required="" autocomplete="off">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="backupnow" class="btn btn-info btn-rounded">Initiate Backup</button>
                        </div>
                    </form>
                </div>
            </div> <!-- card end// -->


        </section> <!-- content-main end// -->
    </main>
    <!-- JavaScript -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Owl JavaScript -->
    <script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- Switchery JavaScript -->
    <script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/toast-data.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
    <?php include("footerlinks.php") ?>
</body>

<!-- Mirrored from www.ecommerce-admin.com/demo/page-form-product-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:03 GMT -->

</html>