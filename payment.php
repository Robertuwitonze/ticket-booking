<?php
require_once "connection/connection.php";
$bid=$_GET['id'];
$get_journeyID = "select * from booking where book_id='$bid'"; 
$run_journeyID = mysqli_query($connection,$get_journeyID);
$row = mysqli_fetch_array($run_journeyID);
$jid = $row['journey_id'];
$cid = $row['customer_id'];
$amount = $row['ticket_amount'];

$get_price = "select * from journey where journey_id='$jid'"; 
$run_price = mysqli_query($connection,$get_price);
$row = mysqli_fetch_array($run_price);
$price = $row['price'];
$from = $row['journey_origin'];
$to = $row['journey_destination'];
$date = $row['journey_date'];
$time = $row['journey_start_time'];
$totalprice = $price*$amount;
$dollarprice = $totalprice/980;
$roundDollar = round($dollarprice,2);

?>
<html>
    <body>
        <?php echo"
<div id='smart-button-container'>
    <div style='text-align: center'><label for='description'>From $from to $to (On $date, departure at $time) Ticket Number Booked </label><input type='text' name='descriptionInput' id='description' maxlength='127' disabled value='$amount'></div>
      <p id='descriptionError' style='visibility: hidden; color:red; text-align: center;'>Please enter a description</p>
    <div style='text-align: center'><label for='amount'>Price </label><input name='amountInput' type='number' id='amount' value='$roundDollar' disabled ><span> USD</span></div>
      <p id='priceLabelError' style='visibility: hidden; color:red; text-align: center;'>Please enter a price</p>
    <div id='invoiceidDiv' style='text-align: center; display: none;'><label for='invoiceid'> </label><input name='invoiceid' maxlength='127' type='text' id='invoiceid' value='' ></div>
      <p id='invoiceidError' style='visibility: hidden; color:red; text-align: center;'>Please enter an Invoice ID</p>
    <div style='text-align: center; margin-top: 0.625rem;' id='paypal-button-container'></div>
  </div>
  <script src='https://www.paypal.com/sdk/js?client-id=sb&currency=USD' data-sdk-integration-source='button-factory'></script>
  <script>
  function initPayPalButton() {
    var description = document.querySelector('#smart-button-container #description');
    var amount = document.querySelector('#smart-button-container #amount');
    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
    var priceError = document.querySelector('#smart-button-container #priceLabelError');
    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

    var elArr = [description, amount];

    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
      invoiceidDiv.style.display = 'block';
    }

    var purchase_units = [];
    purchase_units[0] = {};
    purchase_units[0].amount = {};

    function validate(event) {
      return event.value.length > 0;
    }

    paypal.Buttons({
      style: {
        color: 'gold',
        shape: 'pill',
        label: 'paypal',
        layout: 'vertical',
        
      },

      onInit: function (data, actions) {
        actions.disable();

        if(invoiceidDiv.style.display === 'block') {
          elArr.push(invoiceid);
        }

        elArr.forEach(function (item) {
          item.addEventListener('keyup', function (event) {
            var result = elArr.every(validate);
            if (result) {
              actions.enable();
            } else {
              actions.disable();
            }
          });
        });
      },

      onClick: function () {
        if (description.value.length < 1) {
          descriptionError.style.visibility = 'visible';
        } else {
          descriptionError.style.visibility = 'hidden';
        }

        if (amount.value.length < 1) {
          priceError.style.visibility = 'visible';
        } else {
          priceError.style.visibility = 'hidden';
        }

        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === 'block') {
          invoiceidError.style.visibility = 'visible';
        } else {
          invoiceidError.style.visibility = 'hidden';
        }

        purchase_units[0].description = description.value;
        purchase_units[0].amount.value = amount.value;

        if(invoiceid.value !== '') {
          purchase_units[0].invoice_id = invoiceid.value;
        }
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: purchase_units,
        });
      },

      onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  </script>";?>
  </body>