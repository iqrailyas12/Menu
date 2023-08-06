<?php
session_start();
include("crud.php");
include("helpermethod.php");
if (!isset($_SESSION["admin"])) {
  redirect("login.php");
}


if (isset($_GET["del_id"])) {

  $var_id = $_GET["del_id"];
  $query = "UPDATE `customers`set `DeletedOn`=NOW(),`DeletedBy`='$_SESSION[login]' WHERE id='$var_id'";
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
        <h2 class="content-title" style="font-family: 'Lugrasimo', cursive;letter-spacing:1.5px"><span><img src="images/avatar/avatar-15.png" class="img-sm img-avatar" height="45px" alt=""></span> Customer Info</h2>

      </div>

      <div class="card mb-4">
        <header class="card-header">
        <form class="searchform" method="post" action="user.php">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search customer name" autocomplete="off">
                <button class="btn btn-light bg" name="submit" type="submit"> <i class="material-icons md-search"></i>
                </button>
            </div>

        </form>



          
        </header> <!-- card-header end// -->
        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th class="text-end"> </th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST["submit"]) && $_POST["search"] != "") {
                  $var_search = $_POST["search"];
                  $query = "select * from customers where firstName like '%$var_search%'";
                  $result = query_exec($query);
                } else {
                  $result = query_exec("select * from customers where DeletedOn is null");
                }
                while ($rows_cat = mysqli_fetch_assoc($result)) {

                ?>


                  <tr>
                    <td width="40%">
                      <a href="#" class="itemside">
                        <div class="left">
                          <img src="images/avatar/avatar-2.png" class="img-sm img-avatar" alt="Userpic">
                        </div>
                        <div class="info pl-3">
                          <h6 class="mb-0 title" style="letter-spacing: 1.5px;"><?php echo $rows_cat["firstName"] ?> <?php echo $rows_cat["Lastname"] ?></h6>
                          <small class="text-muted">User ID: <?php echo $rows_cat["id"] ?></small>
                        </div>
                      </a>
                    </td>
                    <td><?php echo $rows_cat["phone"] ?></td>
                    <td><span class="badge rounded-pill btn-success">Active</span></td>
                    <td class="text-end">
                      <div class="dropdown">
                        <a href="user_update.php?u_id=<?php echo $rows_cat['id'] ?>" data-bs-toggle=" dropdown" class="btn btn-success"> <i class="material-icons md-Edit"></i> </a>

                      </div>
                      <div class="dropdown">
                        <a class="btn btn-danger" href="user.php?del_id=<?php echo $rows_cat['id'] ?>"><i class="material-icons md-Delete"></i></a>

                      </div>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table> <!-- table-responsive.// -->
          </div>

        </div> <!-- card-body end// -->
      </div> <!-- card end// -->


    </section> <!-- content-main end// -->
  </main>

  <script type="text/javascript">
    if (localStorage.getItem("darkmode")) {
      var body_el = document.body;
      body_el.className += 'dark';
    }
  </script>

  <script src="js/jquery-3.5.0.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS -->
  <script src="js/scriptc619.js?v=1.0" type="text/javascript"></script>

</body>

<!-- Mirrored from www.ecommerce-admin.com/demo/page-sellers-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:03 GMT -->

</html>