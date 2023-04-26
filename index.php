<?php
session_start();
	require_once'connection/connection.php';
	if (isset($_SESSION['cust_logged_id'])){
	$cemail=$_SESSION['cust_logged_id'];
	$cfname = $_SESSION['cust_fname'];
	$clname = $_SESSION['cust_lname'];}
	//$url = 'C:\xampp\htdocs\busmanagement\images\body2.jpg';
	
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
	<link rel="stylesheet" type="text/css" href="css/footer.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>VIRUNGA EXPRESS</title>
		<style type="text/css">
		body
		{
			background-image: url('<?php echo $url ?>');
		}
		</style>
  </head>
  <body >
	  
	  
    <div class="container">
    	<!-- Navs -->
    	<nav class="navbar navbar-expand-lg navbar-dark sticky-top " >
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
		        <a class="nav-link" href="#seat">Available Seats</a>
		      </li>
		       <li class="nav-item">
		        <a class="nav-link" href="#contactUs">Contact Us</a>
		      </li> 
		      <!-- <li class="nav-item">
		        <a class="nav-link" href="#contactUs">ABOUT US</a>
		      </li> -->
			  <?php if (!isset($_SESSION['cust_logged_id'])){
		      echo "<li class='nav-item'>
		        <a class='nav-link' href='login.php'>Login</a>
			  </li>";}
			  else{ echo "<li class='nav-item'>
		        <a class='nav-link' href='viewbooked.php'>View Pending Bookings</a>
			  </li>";}?>
		      <!-- <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          CARS TYPE
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#">V8</a>
		          <a class="dropdown-item" href="#">QUASTER</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="#">Something else here</a>
		        </div>
		      </li> -->



				<li class="nav-item">
		       <a class="nav-link" href="#seat"><?php if(isset($_SESSION['cust_logged_id']))
				{echo " <strong>Welcome $cfname $clname </strong>";}?></a>
				</ul>
		      </li>
		       <?php if(isset($_SESSION['cust_logged_id']))
				{echo "<center><a href='logout.php' class='btn btn-danger'>Logout</a>";}?>

		  </div>
		</nav>
		<!--- End of Navs -->

		<!--- Carousel -->
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" >
		  <ol class="carousel-indicators">
		    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
		    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
		    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		      <img src="images/HHH.jpg" class="d-block w-100" alt="deluxe-room" height="520">
		      <div class="carousel-caption d-none d-md-block">
		        <h5>VIRUNGA EXPRESS</h5>
		        <p>Be Safe with Us.</p>
		      </div>
		    </div>
		    <div class="carousel-item">
		      <img src="images/bus100.jpg" class="d-block w-100" alt="double" height="520">
		      <div class="carousel-caption d-none d-md-block">
		        <h5>VIRUNGA EXPRESS</h5>
		        <b><p>Virunga Express:  Our Transport is safe wherever you're going in the Country.</p></b>
		      </div>
		    </div>
		    <div class="carousel-item">
		      <img src="images/625891fa-2004-43bc-804d-ea1af3264e34.jpg" class="d-block w-100" alt="pool" height="520">
		      <div class="carousel-caption d-none d-md-block">
		        <h5>VIRUNGA</h5>
		        <p>Do you need to travel fast with securely? Journey with us.</p>
		      </div>
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		<!-- End of Carousel -->
		<!-- Service Section -->
		<div name="services" id="seat" >
			<br/><br/><br/><br/>
			<center><h1 class="animate__zoomIn">Available Seats</h1></center>
			<br>
			<div class="row row-cols-1 row-cols-md-3">
			<?php
			$query= "SELECT * FROM journey where tickets != 0";
            $service = array();
            $result = mysqli_query($connection, $query);

            if ($result)
            {

            $rowcount = mysqli_num_rows($result);
            while( $row = mysqli_fetch_array($result)){
                array_push($service, $row);
            }

            }

            for ($countrow=0;$countrow<$rowcount;$countrow++){
            $journeyid = $service[$countrow][0];
            $journeyorigin = $service[$countrow][1];
			$journeydestination = $service[$countrow][2];
			$journeyprice = $service[$countrow][4];
			$journeybus = $service[$countrow][3];
			$journeydate = $service[$countrow][6];
			$journeytime = $service[$countrow][7];
			$journeytickets = $service[$countrow][5];
			echo"
  			<div class='col mb-4' data-aos='fade-down-right'>
					<div class='card text-white bg-dark mb-3' style='width: 18rem;'>
				  	<div class='card-header'>
					    <h3 class='card-title'> $journeyorigin - $journeydestination</h3>
					  </div>
					  <div class='card-body'>
						<h5 class='card-title'>Price: $journeyprice RWF</h5>
						<p class='card-text'>Date: $journeydate</p>
						<p class='card-text'>Departure Time: $journeytime</p>
					    <p class='card-text'>Tickets remaining: $journeytickets</p>
					  </div>
					  <div class='card-footer text-muted'>";

						  if(isset($_SESSION['cust_logged_id']))
						  	{
								  echo "<a href='booking.php?id=$journeyid' class='btn btn-primary' id='myBooking'>Booking</a>";
							}
						else
						{
							echo "<a href='login.php' class='btn btn-primary' id='myBooking'>Login to Book</a>";
						}

					    echo"
					  </div>
					</div>
				</div>";}?>

			</div>
		</div>
		<!-- End of Service Section -->
		<br/>

		<br/><br/><br/><br/>
		<!-- Contact Us Section -->
		<div name="contactUs" id="contactUs" > <div name="contactUs" id="contactUs">
			<center><h1 class="animate__zoomIn">Contact Us </h1></center> 
			<left><h4>Suggestion Box</h4></left>
			<div class="container">
				<div class="row">
					<div class="col-md-6" data-aos="fade-right">
						<form>
						<label for="validationDefault01">Full Name</label>
			      <input type="text" class="form-control" id="validationDefault01" placeholder="Type your name" name="full_name" required>
			      <label for="validationDefault01">Your E-Mail</label>
			      <input type="text" class="form-control" id="validationDefault01" placeholder="example@example" name="email" required>
			      <label for="exampleFormControlTextarea1">Message</label>
    				<textarea class="form-control" id="message" rows="5"></textarea>
    				<br/>
    				<button class="btn btn-primary">Send Message</button>
					</form>
					</div>
					<div class="col-md-6" data-aos="fade-left">
						<br/>
						<div class="well"><div class="mapouter"><div class="gmap_canvas"><div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=nyabugogo%20+(virunga)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.maps.ie/route-planner.htm">Plan A Journey</a></div>></div><style>.mapouter{position:relative;text-align:right;height:331px;width:513px;}.lic{position:absolute;z-index:999;bottom:-14px;right:0;font-size:11px;font-family:arial;color:#666;}.gmap_canvas {overflow:hidden;background:none!important;height:331px;width:513px;}</style></div></div>
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
				document.getElementById("amount").value = "$"+newAmount;
   		}
   	</script>
   	<script type="text/javascript">
   		var window_width = $(window).width();
		if( window_width <= 600 ){
		  console.log("Screen", window_width);
		}
   	</script>
  </body>
  <br>
  <footer class="section footer-classic context-dark bg-image" style="background: #2d3246;">
        <div class="container">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="images/download.png" alt="" width="190" height="67" srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
                <p>We support transport of people and goods for low prices with more destination, we cross whole country.
                Delivering quality services to our customer is our priority, Trust you are totally safe with us. </p>
                <!-- Rights-->
                <p class="rights"><span>©  </span><span class="copyright-year">2023</span><span> </span><span>Virunga Express ltd</span><span>. </span><span>All Rights Reserved.</span></p>
              </div>
            </div>
            <div class="col-md-4">
              <h5>Contacts</h5>
              <dl class="contact-list">
                <dt>Address:</dt>
                <dd>798 Nyabugogo, Nyarugenge, Rwanda</dd>
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
                <li><a href="#">Home</a></li>
                <li><a href="index.php#seat">Available seat</a></li>


                <li><a href='adminlogin.php'>Admin Login</a></li>
                 <li><a href='login.php'>Customer Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
</html>
