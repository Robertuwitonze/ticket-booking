
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<a href="../index.php"><button style="padding: 10px; background-color: #009933; border-radius: 10px; color:black;"><i><< Back to Website</i></button>
		</a>
		<hr style="border-top:1px dotted #ccc;" />
		<center><h1>Ticket Report</h1></center>
		<br /><br />
		<a href="print.php" target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
		<br />
		<br />
		<table class="table table-bordered">
			<thead class="alert-success">
				<tr>
					<th>Journey id</th>
					<th>Price</th>
					
					<th>Journey Origin</th>
					<th>Journey Destination</th>
					<th>Journey Date</th>
					
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
					require 'connection.php';
					
					 $query = mysqli_query($connection, "SELECT journey.journey_id, route.journey_origin, journey.tickets, journey.journey_date, journey.journey_start_time, journey.price, bus.bus_id, bus.bus_plate_number, route.journey_destination,  bus.bus_plate_number, route.journey_origin FROM ((journey INNER JOIN bus ON journey.bus_id = bus.bus_id) INNER JOIN route ON journey.route_id= route.route_id)");

					while($fetch = $query->fetch_array()){
						
				?>
				
				<tr>
					<td><?php echo $fetch['journey_id']?></td>
					
					<td><?php echo $fetch['price']?></td>
					<td><?php echo $fetch['journey_origin']?></td>
					<td><?php echo $fetch['journey_destination']?></td>
					<td><?php echo $fetch['journey_date']?></td>
					
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
								<input type="text" name="pname" class="form-control"/>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="price" class="form-control"/>
							</div>
							<div class="form-group">
								<label>Qty</label>
								<input type="number" name="qty" class="form-control"/>
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