<?php
session_start();
require '../../connection/connection.php';
if(!isset($_SESSION['logged_id']))
{
  header("Location:../../login.php");
}
$jid = $_SESSION['journ'];
$deleteID = $_GET['id'];
$host="localhost";
        $user="root";
        $password="";
        $database="busmanagement";
        $connect=mysqli_connect($host,$user,$password,$database);
        if($connect)
            {
            }

        else
        die(mysqli_error());



        $get_ticket = "select * from booking where book_id='$deleteID'";
        $run_ticket = mysqli_query($connection,$get_ticket);
        $row = mysqli_fetch_array($run_ticket);
        $ticket = $row['ticket_amount'];
        $jid = $row['journey_id'];

        $get_ticketOG = "select * from journey where journey_id='$jid'";
        $run_ticketOG = mysqli_query($connection,$get_ticketOG);
        $row = mysqli_fetch_array($run_ticketOG);
        $ticketOG = $row['tickets'];
        $newticketOG = $ticket + $ticketOG;
        $delete = "DELETE FROM booking WHERE book_id = '$deleteID'";
        $update = "UPDATE journey SET tickets = '$newticketOG' WHERE journey_id = '$jid'";
        $result = mysqli_query($connect,$delete);
        $resultTicket = mysqli_query($connect,$update);

        if(($result))
        {
        echo "<script>window.location='../details.php?journey_id=$jid';</script>";
        }
        else
        die(mysqli_error());

  ?>
