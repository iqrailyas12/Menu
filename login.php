<?php
session_start();
require("crud.php");
require("helpermethod.php");

$error_msg = "";

if (isset($_POST["submit"])) {

  $var_email = $_POST["email"];
  $var_password = $_POST["password"];

  $login_result = fetch_row("logins", array("email" => $var_email, "password" => $var_password,"role"=>"1"));
  $rows = mysqli_fetch_assoc($login_result);

  if (mysqli_num_rows($login_result) > 0) {
    if ($rows["email"] == $var_email && $rows["password"] == $var_password) {
      $_SESSION["id"] = $rows['id'];
      $_SESSION["admin"] = $rows["email"];
      $_SESSION["login"] = $rows["username"];
      if($rows["role"]=="1"){
				redirect("home.php");
			}
      else{
        redirect("login.php");
      }
        
      
    }
  } else {
    //alert_message("Invalid username or password");
    $error_msg = "incorrect username or password";
  }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from www.ecommerce-admin.com/demo/page-account-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:04 GMT -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Sample title - Ecommerce admin dashboard template</title>

  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

  <link href="css/bootstrapf9e3.css?v=1.1" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="fonts/material-icon/css/round.css" />

  <!-- custom style -->
  <link href="css/uif9e3.css?v=1.1" rel="stylesheet" type="text/css" />
  <link href="css/responsivef9e3.css?v=1.1" rel="stylesheet" />

</head>

<body>

  <b class="screen-overlay"></b>

  <main>
 

    <section class="content-main">

      <!-- ============================ COMPONENT LOGIN   ================================= -->
      <div class="card shadow mx-auto" style="max-width: 380px; margin-top:100px;">
        <div class="card-body">
          <h4 class="card-title mb-4">Sign in</h4>
          <form action="login.php" method="POST">

            <div class="mb-3">
              <input class="form-control" placeholder="Username or email" name="email" type="text" autocomplete="off">
            </div> <!-- form-group// -->
            <div class="mb-3">
              <input class="form-control" placeholder="Password" name="password" type="password" >
            </div> <!-- form-group// -->
            <h5 style="color:red;font-size:13px;"><?php echo $error_msg ?></h5>
            <div class="mb-3">
              <a href="#" class="float-end">Forgot password?</a>
              <label class="form-check">
                <input type="checkbox" class="form-check-input" checked="">
                <span class="form-check-label">Remember</span>
              </label>
            </div> <!-- form-group form-check .// -->
            <div class="mb-4">
              <button type="submit" name="submit" class="btn btn-primary w-100"> Login </button>
            </div> <!-- form-group// -->
          </form>


          <p class="text-center mb-4">Don't have account? <a href="#">Sign up</a></p>

          <!-- social buttons   -->
          <div class="d-grid gap-3 mb-4">
            <a href="#" class="btn w-100 btn-light">
              <svg aria-hidden="true" class="icon-svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M16.51 8H8.98v3h4.3c-.18 1-.74 1.48-1.6 2.04v2.01h2.6a7.8 7.8 0 002.38-5.88c0-.57-.05-.66-.15-1.18z" fill="#4285F4"></path>
                <path d="M8.98 17c2.16 0 3.97-.72 5.3-1.94l-2.6-2a4.8 4.8 0 01-7.18-2.54H1.83v2.07A8 8 0 008.98 17z" fill="#34A853"></path>
                <path d="M4.5 10.52a4.8 4.8 0 010-3.04V5.41H1.83a8 8 0 000 7.18l2.67-2.07z" fill="#FBBC05"></path>
                <path d="M8.98 4.18c1.17 0 2.23.4 3.06 1.2l2.3-2.3A8 8 0 001.83 5.4L4.5 7.49a4.77 4.77 0 014.48-3.3z" fill="#EA4335"></path>
              </svg> Sign up using Facebook
            </a>

            <a href="#" class="btn w-100 btn-light">
              <svg aria-hidden="true" class="icon-svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M3 1a2 2 0 00-2 2v12c0 1.1.9 2 2 2h12a2 2 0 002-2V3a2 2 0 00-2-2H3zm6.55 16v-6.2H7.46V8.4h2.09V6.61c0-2.07 1.26-3.2 3.1-3.2.88 0 1.64.07 1.87.1v2.16h-1.29c-1 0-1.19.48-1.19 1.18V8.4h2.39l-.31 2.42h-2.08V17h-2.5z" fill="#4167B2"></path>
              </svg> Sign up using Facebook
            </a>
          </div>
          <!-- social buttons //end  -->



        </div> <!-- card-body.// -->
      </div> <!-- card .// -->


      <!-- ============================ COMPONENT LOGIN  END.// ================================= -->




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

<!-- Mirrored from www.ecommerce-admin.com/demo/page-account-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 May 2022 13:57:04 GMT -->

</html>