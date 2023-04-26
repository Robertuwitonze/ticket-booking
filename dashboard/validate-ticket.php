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

<?php
if (@$_GET['del']) {
    $del = "DELETE from payee where id = '$_GET[del]'";
    @$commitDel = mysqli_query($connection, $del);
    if ($commitDel) {
        echo "<script>alert('delete successful !!!');</script>";
    } else {
        echo "<script>alert('something went wrong try again !!');</script>";
    }
}
if (@$_GET['validate']) {
    $upd = "UPDATE payee set status='valid' where id = '$_GET[validate]'";
    @$commitUpd = mysqli_query($connection, $upd);
    if ($commitUpd) {
        echo "<script>alert('valited successful !!!');</script>";
    } else {
        echo "<script>alert('something went wrong try again !!');</script>";
    }
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
                        <li class="nav-item">
                            <a class="nav-link" href="journey.php">
                                <span data-feather="plus"></span>
                                Add Journey
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="route.php">
                                <span data-feather="plus"></span>
                                Add Route
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bus.php">
                                <span data-feather="plus"></span>
                                Add Bus <span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adddriver.php">
                                <span data-feather="plus users"></span>
                                Add Driver
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

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 bg-dark" data-aos="zoom-in" style="color: white">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Validate Ticket</h1>
                </div>



                <table id="example1" class="table table-bordered table-striped" style="color:aliceblue;">
                    <thead>
                        <tr>
                            <th>Transaction Id</th>
                            <th>Used Phone</th>
                            <th>Paid Amount</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * from payee where status =  'pending'";
                        $querys = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($querys)) { ?>
                            <tr>
                                <td><?= $row['transactionId']; ?></td>
                                <td><?= $row['usedPhone']; ?></td>
                                <td><?= $row['amount']; ?></td>
                                <td><a href="?validate=<?= $row['id']; ?>"><button class="btn-primary">Validate</button></a>&nbsp;&nbsp;&nbsp;<a href="?del=<?= $row['id']; ?>"><button class="btn-danger">Delete</button></a></td>

                            </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Transaction Id</th>
                            <th>Used Phone</th>
                            <th>Paid Amount</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                </table>

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
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
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
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [""]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>