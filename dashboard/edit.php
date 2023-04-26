<html>
    <?php
    require '../connection/connection.php';
    session_start();
        if(!isset($_SESSION['logged_id']))
        {
            echo "<script>window.location='../index.php'</script>;";
        }
        ?>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="edit.css">
        <title>Edit</title>
<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<?php

#If bus will be edited
if(isset($_GET['bus_id']))
{
$bid = $_GET['bus_id'];
$get_busData = "select * from bus where bus_id='$bid'";
$run_busData = mysqli_query($connection,$get_busData);
$row = mysqli_fetch_array($run_busData);
$lplate = $row['bus_plate_number'];
$busmake = $row['bus_make'];
$busmodel = $row['bus_model'];
$busstatus = $row['status'];
$driverId = $row['driver_id'];
echo"
    <form action='' method='POST'>
    <div class='container contact'>
        <div class='row'>
            <div class='col-md-3'>
                <div class='contact-info'>
                    <img src='../images/busbus.png' width='64' height='64' alt='image'/>
                    <h2>Bus Edit Form</h2>
                    <h4>Here you can edit the data of any Virunga Bus of your choosing.</h4>
                </div>
            </div>
            <div class='col-md-9'>
                <div class='contact-form'>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='lplate'>License Plate:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='lplate' value='$lplate' placeholder='Enter License Plate' name='lplate'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='busmake'>Bus Brand:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='busmake' value='$busmake' placeholder='Enter Bus Brand' name='busmake'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='busmodel'>Bus Model:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='busmodel' value='$busmodel' placeholder='Enter Bus Model' name='busmodel'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='driver'>Driver:</label>
                    <div class='col-sm-10'>
                    <select name='driver'>";

                    $connect = new mysqli("localhost","root","","busmanagement",3306);
                    $queryFn = $connect -> query("SELECT `fname` FROM `driver`");
                    $queryLn = $connect -> query("SELECT `lname` FROM `driver`");
                    $queryId = $connect -> query("SELECT `driver_id` FROM `driver`");

                    $arrayFn = Array();
                    $arrayLn = Array();
                    $arrayId = Array();
                    while($result = $queryFn -> fetch_assoc()){
                        $arrayFn[] = $result['fname'];
                    }
                    while($result = $queryLn -> fetch_assoc()){
                        $arrayLn[] = $result['lname'];
                    }
                    while($result = $queryId -> fetch_assoc()){
                        $arrayId[] = $result['driver_id'];
                    }
                    $size = sizeof($arrayFn);
                    $sizeTemp = $size - 1;

                    for ($sizeTemp; $sizeTemp >=0; $sizeTemp--){
                        echo "<option value='$arrayId[$sizeTemp]'"; if($driverId == $arrayId[$sizeTemp]){echo "selected";} echo">$arrayFn[$sizeTemp] $arrayLn[$sizeTemp] (ID $arrayId[$sizeTemp])</option>";
                    }


                    echo"</select>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='busstatus'>Status:</label>
                    <div class='col-sm-10'>
                        <select name='busstatus'>
                            <option value='Operational'"; if($busstatus == 'Operational'){echo "selected";} echo">Operational</option>
                            <option value='Inactive'"; if($busstatus == 'Inactive'){echo "selected";} echo">Inactive</option>
                        </select>
                    </div>
                    </div>
                    <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-default' name='submitBus'>Submit</button>
                    </div>
                    <br>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-danger' name='cancelBus'>Cancel</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>";

if(isset($_POST['submitBus']))
{
    $lplate = $_POST['lplate'];
    $busmake = $_POST['busmake'];
    $busmodel = $_POST['busmodel'];
    $driver = $_POST['driver'];
    $status = $_POST['busstatus'];

    $update="UPDATE bus SET bus_plate_number ='$lplate', bus_make ='$busmake', bus_model ='$busmodel', driver_id ='$driver', status ='$status' WHERE bus_id = '$bid'";
    $result=mysqli_query($connection,$update) or die(mysqli_error($connection));
    if($result)
    {
        echo "<script>alert('The bus info has been successfully updated.');
                        window.location='bus.php';</script>";
    }
    else{echo"<script>alert('Update failure, please check your entries and try again.')</script>";}

}
if(isset($_POST['cancelBus']))
{
    echo "<script>window.location='bus.php';</script>";
}
}

    #End of bus edit -->


    #If journey will be edited -->
    if(isset($_GET['journey_id']))
    {
$jid = $_GET['journey_id'];
$get_journeyData = "select * from journey where journey_id='$jid'";
$run_journeyData = mysqli_query($connection,$get_journeyData);
$row = mysqli_fetch_array($run_journeyData);
$origin = $row['journey_origin'];
$destination = $row['journey_destination'];
$bus_id = $row['bus_id'];
$price = $row['price'];
$tickets = $row['tickets'];
$date = $row['journey_date'];
$time = $row['journey_start_time'];
echo"
    <form action='' method='POST'>
    <div class='container contact'>
        <div class='row'>
            <div class='col-md-3'>
                <div class='contact-info'>
                    <img src='../images/roadroad.png' width='64' height='64' alt='image'/>
                    <h2>Journey Edit Form</h2>
                    <h4>Here you can edit the data of any Virunga Journey of your choosing.</h4>
                </div>
            </div>
            <div class='col-md-9'>
                <div class='contact-form'>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='origin'>Origin:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='origin' value='$origin' placeholder='Origin City' name='origin'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='destination'>Destination:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='destination' value='$destination' placeholder='Destination' name='destination'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='driver'>Bus:</label>
                    <div class='col-sm-10'>
                    <select name='bus'>";

                    $connect = new mysqli("localhost","root","","busmanagement",3306);
                    $queryPl = $connect -> query("SELECT `bus_plate_number` FROM `bus` WHERE status='Operational'");
                    $queryBr = $connect -> query("SELECT `bus_make` FROM `bus` WHERE status='Operational'");
                    $queryMo = $connect -> query("SELECT `bus_model` FROM `bus` WHERE status='Operational'");
                    $queryId = $connect -> query("SELECT `bus_id` FROM `bus` WHERE status='Operational'");

                    $arrayPl = Array();
                    $arrayBr = Array();
                    $arrayMo = Array();
                    $arrayId = Array();
                    while($result = $queryPl -> fetch_assoc()){
                        $arrayPl[] = $result['bus_plate_number'];
                    }
                    while($result = $queryBr -> fetch_assoc()){
                        $arrayBr[] = $result['bus_make'];
                    }
                    while($result = $queryMo -> fetch_assoc()){
                        $arrayMo[] = $result['bus_model'];
                    }
                    while($result = $queryId -> fetch_assoc()){
                        $arrayId[] = $result['bus_id'];
                    }
                    $size = sizeof($arrayId);
                    $sizeTemp = $size - 1;

                    for ($sizeTemp; $sizeTemp >=0; $sizeTemp--){
                        echo "<option value='$arrayId[$sizeTemp]'>$arrayBr[$sizeTemp] $arrayMo[$sizeTemp], ($arrayPl[$sizeTemp])</option>";
                    }


                    echo"</select>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='price'>Price per Ticket:</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='price' value='$price' placeholder='Price of a Ticket' name='price'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='tickets'>Number of Tickets:</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='tickets' value='$tickets' placeholder='Number of Tickets' name='tickets'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='date'>Departure Date:</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='date' value='$date' placeholder='Departure Date' name='date'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='time'>Departure Time:</label>
                    <div class='col-sm-10'>
                        <input type='time' class='form-control' id='time' value='$time' placeholder='Departure Time' name='time'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-default' name='submitJourney'>Submit</button>
                    </div>
                    <br>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-danger' name='cancelJourney'>Cancel</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>";

if(isset($_POST['submitJourney']))
{


    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $bus_id = $_POST['bus'];
    $price = $_POST['price'];
    $tickets = $_POST['tickets'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $update="UPDATE journey SET journey_origin ='$origin', journey_destination ='$destination', bus_id ='$bus_id', price ='$price', tickets = '$tickets', journey_date = '$date', journey_start_time='$time' WHERE journey_id = '$jid'";
    $result=mysqli_query($connection,$update) or die(mysqli_error($connection));
    if($result)
    {
        echo "<script>alert('The journey info has been successfully updated.');
                        window.location='journey.php';</script>";
    }
    else{echo"<script>alert('Update failure, please check your entries and try again.')</script>";}

}
if(isset($_POST['cancelJourney']))
{
    echo "<script>window.location='journey.php';</script>";
}
}
    #End of journey edit -->

    #If driver will be edited -->
    if(isset($_GET['driver_id']))
    {
$did = $_GET['driver_id'];
$get_driverData = "select * from driver where driver_id='$did'";
$run_driverData = mysqli_query($connection,$get_driverData);
$row = mysqli_fetch_array($run_driverData);
$fname = $row['fname'];
$lname = $row['lname'];
$dob = $row['dob'];
$gender = $row['gender'];
$tel = $row['tel'];
$email = $row['email'];
$salary = $row['salary'];
echo"
    <form action='' method='POST'>
    <div class='container contact'>
        <div class='row'>
            <div class='col-md-3'>
                <div class='contact-info'>
                    <img src='../images/drive.png' width='64' height='64' alt='image'/>
                    <h2>Driver Edit Form</h2>
                    <h4>Here you can edit the data of any Virunga Driver of your choosing.</h4>
                </div>
            </div>
            <div class='col-md-9'>
                <div class='contact-form'>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='fname'>First Name:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='fname' value='$fname' placeholder='Enter First Name' name='fname'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='lname'>Last Name:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='lname' value='$lname' placeholder='Last Name' name='lname'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='dob'>Date of Birth:</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='dob' value='$dob' placeholder='Date of Birth' name='dob'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='driver'>Bus:</label>
                    <div class='col-sm-10'>
                    <select name='gender'>
                        <option value='Male' ";if($gender == 'Male'){echo"selected";} echo">Male</option>
                        <option value='Female' ";if($gender == 'Female'){echo"selected";} echo">Female</option>
                    </select>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='tel'>Telephone:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='tel' value='$tel' placeholder='Telephone' name='tel'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='email'>Email:</label>
                    <div class='col-sm-10'>
                        <input type='email' class='form-control' id='email' value='$email' placeholder='Email' name='email'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='salary'>Salary:</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='salary' value='$salary' placeholder='Salary' name='salary'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-default' name='submitDriver'>Submit</button>
                    </div>
                    <br>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-danger' name='cancelDriver'>Cancel</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>";

if(isset($_POST['submitDriver']))
{

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];

    $update="UPDATE driver SET fname ='$fname', lname ='$lname', dob ='$dob', gender='$gender', tel ='$tel', salary ='$salary' WHERE driver_id = '$did'";
    $result=mysqli_query($connection,$update) or die(mysqli_error($connection));
    if($result)
    {
        echo "<script>alert('The driver info has been successfully updated.');
                        window.location='adddriver.php';</script>";
    }
    else{echo"<script>alert('Update failure, please check your entries and try again.')</script>";}

}
if(isset($_POST['cancelDriver']))
{
    echo "<script>window.location='adddriver.php';</script>";
}
}
    #End of driver edit -->

    #If customer will be edited -->
    if(isset($_GET['customer_id']))
    {
$cid = $_GET['customer_id'];
$get_customerData = "select * from customer where customer_id='$cid'";
$run_customerData = mysqli_query($connection,$get_customerData);
$row = mysqli_fetch_array($run_customerData);
$fname = $row['first_name'];
$lname = $row['last_name'];
$dob = $row['dob'];
$country = $row['country'];
$gender = $row['gender'];
$phone = $row['phone'];
$email = $row['email'];
echo"
    <form action='' method='POST'>
    <div class='container contact'>
        <div class='row'>
            <div class='col-md-3'>
                <div class='contact-info'>
                    <img src='../images/drive.png' width='64' height='64' alt='image'/>
                    <h2>Customer Edit Form</h2>
                    <h4>Here you can edit the data of any Virunga customer of your choosing.</h4>
                </div>
            </div>
            <div class='col-md-9'>
                <div class='contact-form'>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='fname'>First Name:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='fname' value='$fname' placeholder='Enter First Name' name='fname'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='lname'>Last Name:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='lname' value='$lname' placeholder='Last Name' name='lname'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='dob'>Date of Birth:</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='dob' value='$dob' placeholder='Date of Birth' name='dob'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='country'>Country:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='country' value='$country' placeholder='Country' name='country'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='gender'>Bus:</label>
                    <div class='col-sm-10'>
                    <select name='gender'>
                        <option value='Male' ";if($gender == 'Male'){echo"selected";} echo">Male</option>
                        <option value='Female' ";if($gender == 'Female'){echo"selected";} echo">Female</option>
                    </select>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='phone'>Telephone:</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='phone' value='$phone' placeholder='Telephone' name='phone'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <label class='control-label col-sm-2' for='email'>Email:</label>
                    <div class='col-sm-10'>
                        <input type='email' class='form-control' id='email' value='$email' placeholder='Email' name='email'>
                    </div>
                    </div>
                    <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-default' name='submitCustomer'>Submit</button>
                    </div>
                    <br>
                    <div class='col-sm-offset-2 col-sm-10'>
                        <button type='submit' class='btn btn-danger' name='cancelCustomer'>Cancel</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>";

if(isset($_POST['submitCustomer']))
{

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $update="UPDATE customer SET first_name ='$fname', last_name ='$lname', dob ='$dob', country ='$country', gender ='$gender', phone = '$phone', email='$email' WHERE customer_id = '$cid'";
    $result=mysqli_query($connection,$update) or die(mysqli_error($connection));
    if($result)
    {
        echo "<script>alert('The Customer info has been successfully updated.');
                        window.location='customer.php';</script>";
    }
    else{echo"<script>alert('Update failure, please check your entries and try again.')</script>";}

}
if(isset($_POST['cancelBus']))
{
    echo "<script>window.location='bus.php';</script>";
}
}
    #End of customer edit -->
    ?>
</body>
</html>
