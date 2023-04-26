<?php
session_start();
require 'connection/connection.php';
require 'config.php';
if (!isset($_SESSION['cust_logged_id'])) {
    echo "<script>window.location='login.php'</script>";
} else {
    $cid = $_SESSION['cust_logged_id'];
    $get_customerID = "select * from customer where email='$cid'";
    $run_customerID = mysqli_query($connection, $get_customerID);
    $row = mysqli_fetch_array($run_customerID);
    $custid = $row['customer_id'];
}

?>
<?php
include 'connection/connection.php';
// if (isset($_POST['submit'])) {
$phone = "25" . $_POST['phone_number'];
$amount = $_POST['amount'];
$random = random_int(100, 999);

$curl = curl_init();


if (empty($_POST['request_id'])) {
    echo '<script>alert("No booking found");window.location="viewbooked.php";</script>';
}

if (empty($_POST['phone_number'])) {
    echo '<script>alert("Phone number required");window.location="viewbooked.php";</script>';
}
$request = $_POST['request_id'];
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://opay-api.oltranz.com/opay/paymentrequest',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '
{
  "telephoneNumber" : "' . $phone . '",
  "amount" : "' . $amount . '",
  "organizationId" : "9635525e-00c5-47ce-b4ae-463ebb0a3df7",
  "description" : "Payment for Printing services",
  "callbackUrl" : "",
  "transactionId" : "03c1e56b-' . $random . 'b-4cf5-a949-7521072ts0gsf"
}',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$response = json_decode($response);

curl_close($curl);
if ($httpcode == 200 && is_object($response)) {

    if ($response->status == "PENDING") {
        $body = $response->body;

        $sql = "INSERT INTO payee(transactionId,usedPhone,amount) values('$body->transactionId','$phone','$amount')";
        $save = mysqli_query($connection, $sql);
        if ($save) {
            $updatesql = "UPDATE booking set status='pending' where customer_id = $custid";
            $saveupdates = mysqli_query($connection, $updatesql);
            echo '<script>alert("Please continue by allowing the payment on the phone. If the prompt fails to come out dial *182*7*1#");</script>';
            echo '<script>alert("plz don`t delete your payment message, you will have to present it for the ticket to be validate!!");</script>';
            echo '<script>window.location="ticket.php";</script>';
        }

        exit();
    } else {
        echo '<script>alert("user number with enought money !!");</script>';
        echo '<script>window.location="index.php";</script>';
    }
}
