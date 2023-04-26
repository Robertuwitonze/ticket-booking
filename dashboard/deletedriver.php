<?php
session_start();
if(!isset($_SESSION['logged_id']))
{
  header("Location:../login.php");
}
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
    
        
        
        $delete = "DELETE FROM driver WHERE driver_id = '$deleteID'" ;
        $result = mysqli_query($connect,$delete);
        if($result)
        {
        echo "<script>window.location.replace('adddriver.php');</script>;";
        
    
        }
        else
        die(mysqli_error());
        
  ?>