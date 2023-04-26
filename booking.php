<?php
session_start();
require_once'connection/connection.php';
if(!isset($_GET['id'])){echo"<script>window.location='login.php'";}
if(!isset($_SESSION['cust_logged_id'])){echo"<script>window.location='login.php'";}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Virunga Bus Transports</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- CSS -->
    <link
	    rel="stylesheet"
	    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
	  />
	  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <style type="text/css">
    	.container .container {
    		height: auto;
    	}
    </style>
</head>
<body>
<div class="container">
    	<!-- Navs -->
    	<nav class="navbar navbar-expand-lg navbar-dark">
		  <a class="navbar-brand" href="#">
		    <!-- <img src="images/logo.png" class = "logo"> -->
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
			<li class="nav-item">
		        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="index.php#seat">Available Seats</a>
			  </li>
			  <li class="nav-item">
		        <a class="nav-link" href="viewbooked.php">View Pending Bookings</a>
		      </li>

		      <!-- <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Dropdown
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#">Action</a>
		          <a class="dropdown-item" href="#">Another action</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="#">Something else here</a>
		        </div>
		      </li> -->
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		  </div>
		</nav>
		<!--- End of Navs -->
		<br/><br/><br/>
		<!-- Login Form -->
		<div class="container animate__zoomIn" data-aos="zoom-in-right">
			<h2>Book Your Tickets Now</h2>
			<?php
	  $jid = $_GET['id'];
	  $get_journeyID = "select * from journey where journey_id='$jid'";
	  $run_journeyID = mysqli_query($connection,$get_journeyID);
	  $row = mysqli_fetch_array($run_journeyID);

	  $journeystart = $row['journey_origin'];
	  $journeyfinish = $row['journey_destination'];
	  $journeydate = $row['journey_date'];
	  $journeytime = $row['journey_start_time'];
	  $journeyticket = $row['tickets'];
	  $journeyprice = $row['price'];
	  echo"
			<form action='' method='POST'>
      	<div class='form-row'>
          <div class='col-md-5 mb-5'>
            <label for='validationDefault01'>Origin</label>
            <input type='text' class='form-control' id='validationDefault01' value = '$journeystart' name='origin' disabled>
          </div>
          <div class='col-md-5 mb-5'>
            <label for='validationDefault01'>Destination</label>
            <input type='text' class='form-control' id='validationDefault01' value = '$journeyfinish' name='destination' disabled>
          </div>
          <div class='col-md-5 mb-5'>
            <label for='validationDefault01'>Date (Month-Day-Year)</label>
            <input type='date' class='form-control' id='validationDefault01' value = '$journeydate' name='date' disabled>
		  </div>
		  <div class='col-md-5 mb-5'>
			<label for='validationDefault01'>Time of Departure</label>
			<input type='time' class='form-control' id='validationDefault01' value = '$journeytime' name='time' disabled>
			</div>
		  <div class='col-md-5 mb-5'>
            <label for='validationDefault01'>Price</label>
            <input type='number' class='form-control' id='validationDefault01' value = '$journeyprice' name='price' disabled>
		  </div>
		  <div class='col-md-5 mb-5'>
            <label for='validationDefault01'>Seats remaining</label>
            <input type='number' class='form-control' id='validationDefault01' value = '$journeyticket' name='ticket' disabled>
		  </div>
		  <div class='col-md-5 mb-5'>
            <label for='validationDefault01'>Number of tickets you want</label>
            <input type='text' class='form-control' id='validationDefault01' placeholder = 'From 1 up to $journeyticket' name='num_tickets'>
		  </div>";

		  ?>
			<?php
			if(isset($_POST['add'])) {

			  $cid = $_SESSION['cust_logged_id'];
			  $get_customerID = "select * from customer where email='$cid'";
				$run_customerID = mysqli_query($connection,$get_customerID);
				$row = mysqli_fetch_array($run_customerID);
				$cid = $row['customer_id'];
			  $jid = $_GET['id'];
			  $num_tickets = $_POST['num_tickets'];
			  $num_tickets = (int)$num_tickets;
			  $new_tickets = $journeyticket - $num_tickets;
			  if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM booking WHERE customer_id = '$cid' AND status = 'Unpaid'")) == 0){
				if(($new_tickets >= 0)&&($num_tickets>0)){
			  $sqlB = "INSERT INTO booking (customer_id,journey_id,ticket_amount,status)
			  VALUES ('$cid','$jid','$num_tickets','Unpaid')";
			  $sqlU = "UPDATE journey set tickets='$new_tickets' where journey_id = '$jid'";

			  $queryB = mysqli_query($connection, $sqlB);
			  $queryU = mysqli_query($connection, $sqlU);
      		if (($queryB) && ($queryU)) {
						echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Success!</strong> Successfully Booked.
								<script>alert("Success!\nJourney was successfully booked!"); </script>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>';
						echo"<script type='text/JavaScript'>window.location='viewbooked.php';</script>";
      		} else {
      			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									  <strong>Error!</strong> Failed to Book.
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									</div>';
			  }
		}else{echo"<script>alert('Ticket Amount entered is invalid');</script>";}
		  }else{echo"<script>alert('You already have a booking pending. You must either pay for it first or delete it.')</script>";}}

      ?>

          <br/>
          <br/>
        </div>
        <button class="btn btn-primary" name="add" style="width: 150px;height: 45px;margin-top: 0px; margin-left: 0px;padding: 10px;font-size: 17px;font-weight: bold;">Book Ticket</button>
      </form>
		</div>
		<!-- End of Login Form -->
		<br/>
		<center>
  		<div class="footer">
      	copy &copy; 2021 Virunga Bus Transports
    	</div>
    </center>
	</div>


<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="js/backToTop.js"></script>
    <script type="text/javascript" src="js/modal.js"></script>
		<script>
		  AOS.init();
		</script>
		<footer class="section footer-classic context-dark bg-image" style="background: #2d3246;">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="images/download.png" alt="" width="190" height="67" srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
                <p>we support transport of people and goods for low prices with more destination, we cross whole country.
                we support transport of people and goods for low prices with more destination, we cross whole country.</p>
                <!-- Rights-->
                <p class="rights"><span>©  </span><span class="copyright-year">2021</span><span> </span><span>Waves</span><span>. </span><span>All Rights Reserved.</span></p>
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
