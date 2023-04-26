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

          <?php if (!isset($_SESSION['cust_logged_id'])) {
            echo "<li class='nav-item'>
		        <a class='nav-link' href='login.php'>Login</a>
			  </li>";
          } else {
            echo "<li class='nav-item'><a class='nav-link' href='viewbooked.php'>Your Pending Bookings</a></li>
                    <li class='nav-item'><a class='nav-link' href='viewpaid.php'>Your Paid Bookings</a></li>";
          } ?>

        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <!--- End of Navs -->

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">View Pending Booking</h1>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-sm" style="color: white;font-size: 17px;margin-top: 30px;">
        <thead>
          <tr>
            <th>Origin</th>
            <th>Destination</th>
            <th>Price per ticket</th>
            <th>Total price</th>
            <th>Date</th>
            <th>Departure</th>
            <th>Pay</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php


          if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM booking WHERE customer_id = '$custid' AND status = 'Unpaid'")) == 0) {
            echo "You have no pending bookings";
          } else {

            $get_journeyID = "select * from booking where customer_id='$custid' and status='Unpaid'";
            $run_journeyID = mysqli_query($connection, $get_journeyID);
            $rows = mysqli_fetch_array($run_journeyID);
            $jid = $rows['journey_id'];
            $status = $rows['status'];

            $bid = $rows['book_id'];
            $_SESSION['bid'] = $bid;
            $amount = $rows['ticket_amount'];
            $amountD = $amount / 980;
            $_SESSION['amount'] = $amount;

            $count = 0;
            $query = mysqli_query($connection, "SELECT journey_origin,journey_destination,price,journey_date,journey_start_time FROM journey where journey_id = $jid");

            while ($row = mysqli_fetch_array($query)) {
              echo "<tr>";
              $origin = $row['journey_origin'];
              $_SESSION['origin'] = $origin;
              echo "<td>" . $origin . "</td>";
              $destination = $row['journey_destination'];
              $_SESSION['destination'] = $destination;
              echo "<td>" . $destination . "</td>";
              $price = $row['price'];
              $_SESSION['price'] = $price;
              echo "<td>" . $price . "</td>";
              $totalprice = $row['price'] * $amount;
              $_SESSION['totalprice'] = $totalprice;
              echo "<td>" . $totalprice . "</td>";
              $date = $row['journey_date'];
              $_SESSION['date'] = $date;


              echo "<td>" . $date . "</td>";
              $time = $row['journey_start_time'];
              $_SESSION['time'] = $time;
              echo "<td>" . $time . "</td>";
              if ($status == 'Unpaid') {
                echo "<td><a href='momopay.php?pamount=$totalprice&cust=$custid'><button  id='create_folder' class='btn btn-primary'>pay</button></a></td>";
              } else {
                echo "<td>Already Paid</td>";
              }
              echo "<td><a class='btn btn-danger' href='delete.php?id=$bid'>Delete</a>";
              if ($status == 'Unpaid') {
                echo "<td><button class='btn btn-warning'>" . $status . "</button></td>";
              } else if ($status == 'Paid') {
                echo "<td><button class='btn btn-success'>" . $status . "</button></td>";
              }
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
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


<div id="payModel" class="modal fadeOut" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 7cm; margin-top: 3cm;">
      <div class="modal-header">
        <h4 class="mdal-title"><span id="change_title">Create Folder</span></h4>
      </div>
      <div class="modal-body">
        <p>
          Enter Folder Name
          <input type="text" name="folder_name" id="folder_name" class="form-control" required="required" />
        </p>
        <br>
        <input type="hidden" name="action" id="action">
        <input type="hidden" name="old_name" id="old_name">
        <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create">
      </div>
      <div class="modal-footer">
        <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>