<!DOCTYPE html>
<?php
require 'connection.php';
?>
<html lang="en">

<head>
	<style>
		.table {
			width: 100%;
			margin-bottom: 20px;
		}

		.table-striped tbody>tr:nth-child(odd)>td,
		.table-striped tbody>tr:nth-child(odd)>th {
			background-color: #f9f9f9;
		}

		@media print {
			#print {
				display: none;
			}
		}

		@media print {
			#PrintButton {
				display: none;
			}
		}

		@page {
			size: auto;
			/* auto is the initial value */
			margin: 0;
			/* this affects the margin in the printer settings */
		}
	</style>
</head>

<body>
	<center>
		<h1><i>
				<font face="elephant"><u>Booking Report
			</i></u></font>
	</center>
	<br /> <br /> <br /> <br /> <br />
	<b style="color:blue;">Date Prepared:</b>
	<?php
	$date = date("Y-m-d", strtotime("+6 HOURS"));
	echo $date;
	?>
	<br /><br />
	<table class="table table-bordered">
		<thead>
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
	<center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
</body>
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	document.loaded = function() {

	}
	window.addEventListener('DOMContentLoaded', (event) => {
		PrintPage()
		setTimeout(function() {
			window.close()
		}, 750)
	});
</script>

</html>