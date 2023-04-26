<?php
session_start();
require_once '../connection/connection.php';
if (isset($_SESSION['logged_id']) and $_SESSION['logged'] == 1) {
  $name = $_SESSION['logged_id'];
  $check = "SELECT * FROM `user` where email='$name'";
  $sql = mysqli_query($connection, $check);
  while ($data = mysqli_fetch_array($sql)) {
    $fnameA = $data['fname'];
    $lnameA = $data['lname'];
    $emailA = $data['email'];
  }
} else {
  echo "<script type='text/JavaScript'>window.location='../login.php';</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <link rel="stylesheet" href="css/report.css">
  <title>Virunga Express ltd</title>

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap-4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .table tbody tr:hover {
      background: white;
      color: black;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Virunga Express ltd</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="journey.php">
                <span data-feather="plus"></span>
                Add Journey
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="route.php">
                <span data-feather="plus"></span>
                Add Route
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="bus.php">
                <span data-feather="plus"></span>
                Add Bus
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adddriver.php">
                <span data-feather="plus users"></span>
                Add Driver <span class="sr-only"></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="validate-ticket.php">
                <span data-feather="plus users"></span>
                Validate Ticket
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="customer.php">
                <span data-feather="plus users"></span>
                Add Customer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link acti" href="print/">
                <span data-feather="plus"></span>

              </a>
              <div class="dropdown">
                <span>

                  Report
                </span>
                <div class="dropdown-content">
                  <a href="print/">
                    <button class="change_password" id="change_password" style="border:none; background:none;" name="change_password" value="submit" onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'">Ticket Report</button>

                  </a>
                  <a href="bookings/">
                    <button id="recovery_question" style="border:none; background:none;" name="recoverQ" value="submit" onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'">Booking Report</button>

                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 bg-dark" data-aos="zoom-in" style="color: white;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Add Customer</h1>
        </div>
        <!-- Add Room -->
        <?php
        function password_generate($chars)
        {
          $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
          return substr(str_shuffle($data), 0, $chars);
        }
        if (isset($_POST['add'])) {
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $dob = $_POST['dob'];
          $country = $_POST['country'];
          $gender = $_POST['gender'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $conpassword = $_POST['conpassword'];

          if (empty($first_name) || empty($last_name) || empty($dob) || empty($country) || empty($gender) || empty($phone) || empty($email) || empty($password) || empty($conpassword)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Error!</strong> Some of your fields are empty.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>';
          }
          $result = mysqli_query($connection, "SELECT email, phone FROM customer WHERE email = '$email' OR phone = '$phone'");
          if (mysqli_num_rows($result) > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>Error!</strong> User with the entered E-mail already exists, please change it.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>';
          }
          if ($password == $conpassword) {
            $pword = password_generate(8);
            $sql = "INSERT INTO `customer` set first_name='$first_name', last_name='$last_name', dob='$dob', country='$country', gender='$gender', phone='$phone', email='$email', password='$password'";
            $query = mysqli_query($connection, $sql);
            if ($query) {
              $to = $_POST['email']; // note the comma

              // Subject
              $subject = 'Virunga Bus Transports has added you';

              // Message
              $message = '
								<html>
								<head>
								  <title>Virunga Bus Transports</title>
								</head>
								<body>
								  <h2>Dear ' . $first_name . ' ' . $last_name . ' !</h2>
								  Virunga Bus Transports has been added you to their system<br/>
								  <b>User Name or E-Mail: ' . $email . ' <br/>
								  Password: ' . $password . ' <br/></b>
								 <h4>Your Role in System is : Customer</h4>

								  <h3>Thank You, Best Wishes !!</h3>

								</body>
								</html>
								';
            } else {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									  <strong>Error!</strong> Failed to Register a User.
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									</div>';
            }
          }
        }
        ?>
        <form action="" method="POST">
          <div class="form-row">
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">First Name</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="Joselyne" name="first_name">
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Last Name</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="UWABAHIRE" name="last_name">
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Date of Birth</label>
              <input type="date" class="form-control" id="validationDefault01" name="dob" required>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Country</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="Rwanda" name="country">
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Gender</label>
              <select name="gender" class="form-control" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Phone</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="07XXXXXX" name="phone" required>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Email</label>
              <input type="text" class="form-control" id="validationDefault01" placeholder="email@gmail.com" name="email" required>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Password</label>
              <input type="password" class="form-control" id="validationDefault01" placeholder="Password" name="password" required>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Confirm Password</label>
              <input type="password" class="form-control" id="validationDefault01" placeholder="Confirm Password" name="conpassword" required>
            </div>
            <button class="btn btn-primary" name="add" style="width: 100px;height: 45px;margin-top: 0px; margin-left: 0px;padding: 10px;font-size: 17px;font-weight: bold;">Add</button>
          </div>
        </form>

        <!-- $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $dob = $_POST['dob'];
      $country = $_POST['country'];
      $gender = $_POST['gender'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $password = $_POST['password']; -->

        <!-- End User Account -->
        <!-- View Rooms -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">View Customers</h1>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-striped table-sm" style="color: white;font-size: 17px;margin-top: 30px;">
            <thead>
              <tr>
                <th>No#</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Telephone</th>
                <th>E-mail</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              $query = mysqli_query($connection, "SELECT * FROM customer");
              while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . ($count += 1) . "</td>";
                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['country'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                $id = $row['customer_id'];
                echo "<td><a class='btn btn-warning' href='details.php?customer_id=$id'>details</a>";
                echo "<td><a class='btn btn-info' href='edit.php?customer_id=$id'>Edit</a>";
                echo "<td><a class='btn btn-danger' href='deletecustomer.php?id=$id'>Delete</a>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <center>
            <div class="footer">
              copy right &copy; 2023 Virunga Express ltd
            </div>
          </center>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="../bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script type="text/javascript" src="../js/backToTop.js"></script>
  <script type="text/javascript" src="../js/modal.js"></script>
  <script>
    AOS.init();
  </script>

  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="dashboard.js"></script>
</body>

</html>