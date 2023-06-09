<?php
session_start();
require_once'connection/connection.php';

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
		      <li class="nav-item active">
		        <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
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
		  </div>,
		</nav>
		<!--- End of Navs -->
		<br/><br/><br/>
		<!-- Login Form -->
		<div class="container animate__zoomIn" data-aos="zoom-in-right">
			<h2>Sign Up Form</h2>
			
			<?php
			if(isset($_POST['add'])) {
				
      		$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$gender = $_POST['gender'];
			$phone = $_POST['phone'];
			  $nid = $_POST['nid'];
			  $dob = $_POST['dob'];
			  $country = $_POST['country'];
			  
      		$email = $_POST['email'];
      		$pass = $_POST['pass'];
      		$cpass = $_POST['cpass'];
      		if (empty($first_name) || empty($last_name) || empty($phone) || empty($email)) {
      			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Error!</strong> Some of your fields are empty.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>';
      		}
      		if ($pass != $cpass) {
      			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Error!</strong> Password must match with Password Confirmation
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>';
      		}
      		
      		if (mysqli_num_rows(mysqli_query($connection, "SELECT email, phone FROM customer WHERE email = '$email' OR phone = '$phone'")) > 0) {
      			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Error!</strong> This E-mail address or phone is already registered.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>';
      		}
			  $sql = "INSERT INTO customer (first_name,last_name,dob,gender,country,nid,phone,email,password)
			  VALUES ('$first_name','$last_name','$dob','$gender','$country','$nid','$phone','$email','$pass')";
      		$query = mysqli_query($connection, $sql);
      		if ($query) {
						echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Success!</strong> Successfully Registered.
								<script>alert("Success!\nCustomer was successfully entered!"); </script>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>';
						echo"<script type='text/JavaScript'>window.location='login.php';</script>";
      		} else {
      			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									  <strong>Error!</strong> Failed to Register a customer.
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									</div>';
      		}
      	}
      ?>
			<form action="" method="POST">
      	<div class="form-row">
          <div class="col-md-5 mb-5">
            <label for="validationDefault01">First Name</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="KARANGWA" name="first_name">
          </div>
          <div class="col-md-5 mb-5">
            <label for="validationDefault01">Last Name</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="Mark" name="last_name">
          </div>
          <div class="col-md-5 mb-5">
            <label for="validationDefault01">Gender</label>
            <select type="text" class="form-control" id="validationDefault01" name="gender">
            	<option value="Male">Male</option>
				<option value="Female">Female</option>
            </select>
          </div>
		  <div class="col-md-5 mb-5">
            <label for="validationDefault01">Date of Birth</label>
            <input type="date" class="form-control" id="validationDefault01" placeholder="mm/dd/yyyy" name="dob" required>
          </div>
		  <div class="col-md-5 mb-5">
            <label for="validationDefault01">Country</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="Rwanda" name="country" required>
          </div>
		  <div class="col-md-5 mb-5">
            <label for="validationDefault01">National ID</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="XXXXXXXXXXXXXXXX" name="nid" required>
          </div>
		  <div class="col-md-5 mb-5">
            <label for="validationDefault01">Phone</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="07XXXXXXXX" name="phone" required>
          </div>
          <div class="col-md-5 mb-5">
            <label for="validationDefault01">E-Mail</label>
            <input type="email" class="form-control" id="validationDefault01" placeholder="example@example.com" name="email" required>
          </div>
          <div class="col-md-5 mb-5">
            <label for="validationDefault01">Password</label>
            <input type="password" class="form-control" id="validationDefault01" placeholder="XXX" name="pass" required>
          </div>
          <div class="col-md-5 mb-5">
            <label for="validationDefault01">Confirm Password</label>
            <input type="password" class="form-control" id="validationDefault01" placeholder="XXX" name="cpass" required>
          </div>
          <br/>
          <br/>
        </div>
        <button class="btn btn-primary" name="add" style="width: 100px;height: 45px;margin-top: 0px; margin-left: 0px;padding: 10px;font-size: 17px;font-weight: bold;">SignUp</button>
      </form>
		</div>
		<!-- End of Login Form -->
		<br/>
		<center>
  		<div class="footer">
      	© Virunga Express ltd. All Rights Reserved.&copy; 2023 Virunga Express ltd
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

</body>
</html>