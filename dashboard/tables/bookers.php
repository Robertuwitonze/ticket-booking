<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require '../../connection/connection.php';
if(isset($_SESSION['re_bus_id'])){$_SESSION['bus_id'] = $_SESSION['re_bus_id'];}
$bus_id = $_SESSION['bus_id'];
$_SESSION['re_bus_id'] =$_SESSION['bus_id'];
$connect = new mysqli("localhost","root","","busmanagement",3306);
$queryPl = $connect -> query("SELECT `bus_plate_number` FROM `bus` WHERE `bus_id`=$bus_id");
$queryBr = $connect -> query("SELECT `bus_make` FROM `bus` WHERE `bus_id`=$bus_id");
$queryMo = $connect -> query("SELECT `bus_model` FROM `bus` WHERE `bus_id`=$bus_id");


$arrayPl = Array();
$arrayBr = Array();
$arrayMo = Array();

while($result = $queryPl -> fetch_assoc()){
		$arrayPl[] = $result['bus_plate_number'];
}
while($result = $queryBr -> fetch_assoc()){
		$arrayBr[] = $result['bus_make'];
}
while($result = $queryMo -> fetch_assoc()){
		$arrayMo[] = $result['bus_model'];
}

$bus_details = "$arrayBr[0] $arrayMo[0], $arrayPl[0]";
	if(!isset($_GET['jid']))
	{
		echo "<script>window.location='../../index.php'";
	}
	else{
		$jid = $_GET['jid'];
	}
?>
<head>
	<title>View Booking Customers</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
					<?php echo"<center><h2><strong>List of those who booked tickets for this journey</strong></h2></center>";
					echo "<br>";
					echo "<center><h4><strong>Bus: $bus_details</strong></h4></center>";
					echo "<br>";?>
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">

						<table>

							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">First Name</th>
									<th class="cell100 column2">Last Name</th>
									<th class="cell100 column3">Phone</th>
									<th class="cell100 column4">E-mail</th>
									<th class="cell100 column5">Tickets Booked</th>
									<th class="cell100 column6">Status</th>
									<th class="cell100 column7">Delete?</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<?php
									$query = mysqli_query($connection, "SELECT customer.first_name, customer.last_name, customer.phone, customer.email, booking.book_id, booking.ticket_amount, booking.status FROM customer RIGHT JOIN booking ON customer.customer_id = booking.customer_id WHERE booking.journey_id = $jid");


								while($run = mysqli_fetch_array($query)){
								echo"<tr class='row100 body'>";
								echo"<td class='cell100 column1'>".$run['first_name']."</td>";
								echo"<td class='cell100 column2'>".$run['last_name']."</td>";
								echo"<td class='cell100 column3'>(+250)".$run['phone']."</td>";
								echo"<td class='cell100 column4'>".$run['email']."</td>";
								echo"<td class='cell100 column5'>".$run['ticket_amount']."</td>";
								echo"<td class='cell100 column6'>".$run['status']."</td>";
								if($run['status']=="Unpaid")
								{
									$_SESSION['journ']=$jid;
									$book=$run['book_id'];
									echo"<td class='cell100 column7'><a class='btn btn-danger' href='delete.php?id=$book'>Delete</a></td>";
								}
								else{
									echo"<td class='cell100 column7'><button class='btn btn-info'>Paid</Button></td>";
								}
								echo"</tr>";}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<center><?php unset($_SESSION['bus_id']);
				echo "<a class='btn btn-danger' href='../details.php?journey_id=$jid'>Go Back</a>";?></center>
			</div>
		</div>
	</div>



<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});


	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
