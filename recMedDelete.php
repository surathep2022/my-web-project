<?php
    include("../Connect/ConnectSSB.php");
    include("../FunctionHos/Functionlist.php");

    date_default_timezone_set("Asia/Bangkok");


    $vn = $_GET['vn'];
	$pres = $_GET['pres'];
	$slot = $_GET['slot'];
	$noslot = $_GET['noslot'];

	$hostname = "localhost";
	$user = "root";
	$password = "Admin@2018";
	$dbname = "qfinancial";

	$db_handle = mysql_connect($hostname,$user,$password)or die("Cannot connect to Database");
	$db_found = mysql_select_db($dbname)or die("Cannot connect to Database");


   
        // Get values from the form submission
               

        // Display the values received
         echo "<h1>ข้อมูลที่ได้รับ:</h1>";
         echo "<p>VN: <strong>$vn</strong></p>";
         echo "<p>ใบยาที่: <strong>$pres</strong></p>";
         echo "<p>ช่องการเงิน: <strong>$slot</strong></p>";
         echo "<p>ช่องการเงิน: <strong>$noslot</strong></p>";


     $sql ="DELETE FROM slotmed1  WHERE noslot = '$noslot' ";
     echo $sql .'<br />';
     mysql_query("SET NAMES UTF8");
     $result = mysql_query($sql);
       

?>

<script langguage='javascript'> window.location = 'menuRecMedAdd.php?slot=<?=$slot?>';</script>