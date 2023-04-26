<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>

<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">

		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<a href="../index.php"><button style="padding: 10px; background-color: #009933; border-radius: 10px; color:black;"><i>
					<< Back to Website</i></button>
		</a>
		<hr style="border-top:1px dotted #ccc;" />
		<center>
			<h1>Ticket Report</h1>
		</center>
		<br /><br />
		<a href="print.php" target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
		<br />
		<br />
		<table class="table table-bordered">
			<thead class="alert-success">
				<tr>
					<th>Customer Names</th>
					<th>Journey</th>
					<th>Bus</th>
					<th>Journey Date</th>

				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
				require 'connection.php';

				$query = mysqli_query($connection, "SELECT c.first_name as fname, c.last_name as lname,j.journey_origin as origin,j.journey_destination as destin,j.journey_date as dates, b.bus_plate_number as plate FROM booking, customer c, journey j, bus b where booking.customer_id=c.customer_id and booking.journey_id=j.journey_id and b.bus_id=j.bus_id and booking.status='pending'");

				while ($fetch = $query->fetch_array()) {

				?>

					<tr>
						<td><?php echo $fetch['fname'] ?> <?php echo $fetch['lname'] ?></td>
						<td><?php echo $fetch['origin'] ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $fetch['destin'] ?></td>

						<td><?php echo $fetch['plate'] ?></td>
						<td><?php echo $fetch['dates'] ?></td>

					</tr>

				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="save_query.php" method="POST">
				<div class="modal-content">
					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="pname" class="form-control" />
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="price" class="form-control" />
							</div>
							<div class="form-group">
								<label>Qty</label>
								<input type="number" name="qty" class="form-control" />
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</html>