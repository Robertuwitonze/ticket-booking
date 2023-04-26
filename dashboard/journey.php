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
  <title>Virunga Bus Transports</title>

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap-4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="css/report.css">
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
              <a class="nav-link active" href="journey.php">
                <span data-feather="plus"></span>
                Add Journey
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link acti" href="route.php">
                <span data-feather="plus"></span>
                Add Route
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bus.php">
                <span data-feather="plus"></span>
                Add Bus
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adddriver.php">
                <span data-feather="plus users"></span>
                Add Driver
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="validate-ticket.php">
                <span data-feather="plus users"></span>
                Validate Ticket
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="customer.php">
                <span data-feather="plus users"></span>
                Add Customer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="print/">
                <span data-feather="plus users"></span>

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






      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 bg-dark animate__zoomIn" data-aos="zoom-in" style="color: white">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Add Journey</h1>
        </div>
        <!-- Add Journeys -->

        <?php

        if (isset($_POST['add'])) {



          $origin = $_POST['journey_origin'];
          $destination = $_POST['journey_destination'];
          $price = $_POST['price'];
          $bus = $_POST['bus'];

          $tickets = $_POST['tickets'];
          $date = $_POST['date'];
          $time = $_POST['time'];
          $dateComp = new DateTime($date);
          $now = new DateTime();
          if ($dateComp > $now) {
            $query = "INSERT INTO journey(journey_origin, journey_destination, price, bus_id, tickets, journey_date, journey_start_time, route_id)
            VALUES('$origin','$destination','$price', $bus, '$tickets','$date','$time', 'route_id')";

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {

              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> Journey Added Successfully.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
            } else {

              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> Check your inputs, Journey was not added Successfully.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
            }
          } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Check your input date, it has already passed. Journey was not added Successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          }
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">

            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Bus</label>
              <select name='bus' class='form-control'>";
                <?php
                $connect = new mysqli("localhost", "root", "", "busmanagement", 3306);
                $queryPl = $connect->query("SELECT `bus_plate_number` FROM `bus` WHERE status='Operational'");
                $queryBr = $connect->query("SELECT `bus_make` FROM `bus` WHERE status='Operational'");
                $queryMo = $connect->query("SELECT `bus_model` FROM `bus` WHERE status='Operational'");
                $queryId = $connect->query("SELECT `bus_id` FROM `bus` WHERE status='Operational'");

                $arrayPl = array();
                $arrayBr = array();
                $arrayMo = array();
                $arrayId = array();
                while ($result = $queryPl->fetch_assoc()) {
                  $arrayPl[] = $result['bus_plate_number'];
                }
                while ($result = $queryBr->fetch_assoc()) {
                  $arrayBr[] = $result['bus_make'];
                }
                while ($result = $queryMo->fetch_assoc()) {
                  $arrayMo[] = $result['bus_model'];
                }
                while ($result = $queryId->fetch_assoc()) {
                  $arrayId[] = $result['bus_id'];
                }
                $size = sizeof($arrayId);
                $sizeTemp = $size - 1;

                for ($sizeTemp; $sizeTemp >= 0; $sizeTemp--) {
                  echo "<option value='$arrayId[$sizeTemp]'>$arrayBr[$sizeTemp] $arrayMo[$sizeTemp], ($arrayPl[$sizeTemp])</option>";
                }

                ?>
              </select>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Route</label>
              <select name='route' class='form-control'>";
                <?php
                $connect = new mysqli("localhost", "root", "", "busmanagement", 3306);
                $queryPl = $connect->query("SELECT `journey_origin` FROM `route`");
                $queryBr = $connect->query("SELECT `journey_destination` FROM `route`");
                $queryMo = $connect->query("SELECT * FROM `route`");
                $queryId = $connect->query("SELECT * FROM `route`");

                $arrayPl = array();
                $arrayBr = array();
                $arrayMo = array();
                $arrayId = array();
                while ($result = $queryPl->fetch_assoc()) {
                  $arrayPl[] = $result['journey_origin'];
                }
                while ($result = $queryBr->fetch_assoc()) {
                  $arrayBr[] = $result['journey_destination'];
                }
                while ($result = $queryMo->fetch_assoc()) {
                  $arrayMo[] = $result['price'];
                }
                while ($result = $queryId->fetch_assoc()) {
                  $arrayId[] = $result['bus_id'];
                }
                $size = sizeof($arrayId);
                $sizeTemp = $size - 1;

                for ($sizeTemp; $sizeTemp >= 0; $sizeTemp--) {
                  echo "<option value=$arrayId[$sizeTemp]>$arrayMo[$sizeTemp] FRW $arrayId[$sizeTemp]$arrayBr[$sizeTemp] To $arrayPl[$sizeTemp]</option>";
                }

                ?>
              </select>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Number of Tickets Available</label>
              <input type="number" class="form-control" id="validationDefault01" placeholder="100" name="tickets" required>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Date</label>
              <input type="date" class="form-control" id="validationDefault01" placeholder="" name="date" required>
            </div>
            <div class="col-md-4 mb-4">
              <label for="validationDefault01">Time</label>
              <input type="time" class="form-control" id="validationDefault01" placeholder="" name="time" required>
            </div>
            <button class="btn btn-primary" name="add" style="width: 100px;height: 45px;margin-top: 25px; margin-left: 20px;padding: 10px;font-size: 17px;font-weight: bold;">Add</button>
          </div>
        </form>
        <!-- End of Add Journey -->

        <!-- View Journeys -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">View Journeys</h1>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-striped table-sm" style="color: white;font-size: 17px;margin-top: 30px;">
            <thead>
              <tr>
                <th>No#</th>
                <th>City of Origin</th>
                <th>Destination</th>
                <th>Bus Id</th>

                <th>Price</th>
                <th>Tickets Available</th>
                <th>Date</th>
                <th>Time</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              $query = mysqli_query($connection, "SELECT journey.journey_id, route.journey_origin, journey.tickets, journey.journey_date, journey.journey_start_time, journey.price, bus.bus_id, bus.bus_plate_number, route.journey_destination,  bus.bus_plate_number, route.journey_origin FROM ((journey INNER JOIN bus ON journey.bus_id = bus.bus_id) INNER JOIN route ON journey.route_id= route.route_id)");

              while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . ($count += 1) . "</td>";
                echo "<td>" . $row['journey_origin'] . "</td>";
                echo "<td>" . $row['journey_destination'] . "</td>";

                echo "<td>" . $row['bus_plate_number'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['tickets'] . "</td>";
                echo "<td>" . $row['journey_date'] . "</td>";
                echo "<td>" . $row['journey_start_time'] . "</td>";
                $id = $row['journey_id'];
                echo "<td><a class='btn btn-warning' href='details.php?journey_id=$id'>Details</a>";
                echo "<td><a class='btn btn-info' href='edit.php?journey_id=$id'>Edit</a>";
                echo "<td><a class='btn btn-danger' href='deletejourney.php?id=$id'>Delete</a>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        <center>
          <div class="footer">
            copyright &copy; 2023 Virunga Express ltd
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