<?php
require 'connection/connection.php';
session_start();
if(isset($_SESSION['cust_logged_id']))
{
$bid = $_SESSION['bid'];
$totalprice = $_SESSION['totalprice'];
$origin = $_SESSION['origin'];
$destination = $_SESSION['destination'];
$date = $_SESSION['date'];
$time = $_SESSION['time'];
$amount = $_SESSION['amount'];
require 'config.php';
$token = $_POST['stripeToken'];
$payment=\Stripe\Charge::create([
  "amount"=>$totalprice,
  "currency"=>"rwf",
  "description"=>"$amount ticket(s) for the $origin - $destination journey ($date, $time)",
  "source"=>$token
]);
if ($payment){
  $update="UPDATE booking SET status ='Paid' WHERE book_id = '$bid'";
  $result=mysqli_query($connection,$update) or die(mysqli_error($connection));
  unset($_SESSION['bid']);
  unset($_SESSION['totalprice']);
  unset($_SESSION['origin']);
  unset($_SESSION['destination']);
  unset($_SESSION['date']);
  unset($_SESSION['time']);
  unset($_SESSION['amount']);
  echo "<script>alert('Purchase successful!');
  window.location='viewbooked.php'</script>";
}
}
else {
  {
    echo "<script>window.location='index.php'</script>";
  }
}
?>
