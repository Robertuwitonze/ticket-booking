<?php
session_start();
require 'connection/connection.php';
require 'config.php';
if (!isset($_SESSION['cust_logged_id'])) {
  echo "<script>window.location='login.php'</script>";
} else {
  $cid = $_SESSION['cust_logged_id'];
  $get_customerID = "select * from customer where email='$cid'";
  $run_customerID = mysqli_query($connection, $get_customerID);
  $row = mysqli_fetch_array($run_customerID);
  $custid = $row['customer_id'];
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap-4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <title>VIRUNGA EXPRESS</title>
</head>

<body>
  <div class="container">
    <!-- Navs -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top ">
      <a class="navbar-brand" href="#">
        <!-- <img src="images/download.png" class = "logo"> -->
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#seat">Available Seats</a>
          </li>
          <!-- <li class="nav-item">
		        <a class="nav-link" href="#contactUs">Contact Us</a>
		      </li> -->
          <!-- <li class="nav-item">
		        <a class="nav-link" href="#contactUs">About Us</a>
		      </li> -->
          <?php if (!isset($_SESSION['cust_logged_id'])) {
            echo "<li class='nav-item'>
		        <a class='nav-link' href='login.php'>Login</a>
			  </li>";
          } else {
            echo "<li class='nav-item'><a class='nav-link' href='viewbooked.php'>Your Pending Bookings</a></li>
                    <li class='nav-item'><a class='nav-link' href='viewpaid.php'>Your Paid Bookings</a></li>";
          } ?>

        </ul>

      </div>
    </nav>
    <!--- End of Navs -->

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Pay Your Booking</h1>
    </div>
    <div align="center" style="margin-top: 500px;">
      <form action="paynow.php" method="POST" id="pay_product" style="margin-top:-400px; width:50%;">
        <input type="hidden" name="request_id" value="<?= $_GET['cust'] ?>" required />
        <div class="modal-header">
          <h2 class="modal-title" id="payModalLabel">Pay using Mobile Money</h2>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">

          </button>
        </div>
        <div class="modal-body">
          <div class="p-3">

            <div class="form-group" id="out_put"></div>
            <div class="form-group">
              <label for="exampleInputEmail1">Telephone Number(078...)</label>
              <input type="hidden" name="amount" value="<?= $_GET['pamount']; ?>">
              <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Please enter phone with enough balance " name="phone_number">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" class="btn btn-primary" id="login_button">Pay Now</button>
        </div>
      </form>
    </div>
    <!-- End of Service Section -->
    <br />

    <br /><br /><br /><br /><br /><br /><br /><br />
    <!-- Contact Us Section -->
    <div name="contactUs" id="contactUs">
      <center>
        <h1 class="animate__zoomIn">Contact Us </h1>
      </center>
      <div class="container">
        <div class="row">
          <div class="col-md-6" data-aos="fade-right">
            <form>
              <label for="validationDefault01">Full Name</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="Type your name" name="full_name" required>
              <label for="validationDefault01">E-Mail</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="example@example" name="email" required>
              <label for="exampleFormControlTextarea1">Message</label>
              <textarea class="form-control" id="message" rows="5"></textarea>
              <br />
              <button class="btn btn-primary">Contact</button>
            </form>
          </div>
          <div class="col-md-6" data-aos="fade-left">
            <br />
            <div class="well">
              <div class="mapouter">
                <div class="gmap_canvas">
                  <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=nyabugogo%20+(virunga)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.maps.ie/route-planner.htm">Plan A Journey</a></div>>
                </div>
                <style>
                  .mapouter {
                    position: relative;
                    text-align: right;
                    height: 331px;
                    width: 513px;
                  }

                  .lic {
                    position: absolute;
                    z-index: 999;
                    bottom: -14px;
                    right: 0;
                    font-size: 11px;
                    font-family: arial;
                    color: #666;
                  }

                  .gmap_canvas {
                    overflow: hidden;
                    background: none !important;
                    height: 331px;
                    width: 513px;
                  }
                </style>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Contact Us Section -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    <!-- Modal -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="js/backToTop.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
    <script>
      AOS.init();
    </script>
    <script type="text/javascript">
      var checkIn;
      var checkOut;
      var amount = document.getElementById("amount").value;
      amount = amount.substring(1);

      function myCheckIn() {
        checkIn = document.getElementById("checkIn").value;
        date1 = new Date(`"${checkIn}"`);
        checkOut = document.getElementById("checkOut").value;
        date2 = new Date(`"${checkOut}"`);
        // To calculate the time difference of two dates
        var Difference_In_Time = date2.getTime() - date1.getTime();

        // To calculate the no. of days between two dates
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        newAmount = amount * Difference_In_Days;
        document.getElementById("amount").value = "$" + newAmount;
      }
    </script>
    <script type="text/javascript">
      var window_width = $(window).width();
      if (window_width <= 600) {
        console.log("Screen", window_width);
      }
    </script>
    <br /><br /><br /><br />
    <footer class="section footer-classic context-dark bg-image" style="background: #2d3246;">
      <div class="container">
        <div class="row row-30">
          <div class="col-md-4 col-xl-5">
            <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="images/download.png" alt="" width="190" height="67" srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
              <p>we support transport of people and goods for low prices with more destination, we cross whole country.
                we support transport of people and goods for low prices with more destination, we cross whole country.</p>
              <!-- Rights-->
              <p class="rights"><span>©  </span><span class="copyright-year">© 2023 Virunga Express ltd.</span><span> </span><span>Waves</span><span>. </span><span>All Rights Reserved.</span></p>
            </div>
          </div>
          <div class="col-md-4">
            <h5>Contacts</h5>
            <dl class="contact-list">
              <dt>Address:</dt>
              <dd>798 Nyabugogo, nyarugenge, Rwanda</dd>
            </dl>
            <dl class="contact-list">
              <dt>email:</dt>
              <dd><a href="mailto:#">virungaexpress@gmail.com</a></dd>
            </dl>
            <dl class="contact-list">
              <dt>Phones:</dt>
              <dd><a href="Tel:#">+2507882388</a> <span>or</span> <a href="Tel:#">+2507227563</a>
              </dd>
            </dl>
          </div>
          <div class="col-md-4 col-xl-3">
            <h5>Links</h5>
            <ul class="nav-list">
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php#seat">Available seat</a></li>
              <li><a href="adminlogin.php">Admin Login</a></li>
              <li><a href="login.php">Customer Login</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

</body>

</html>