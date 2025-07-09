<?php
    include("../Connect/ConnectSSB.php");
    include("../FunctionHos/Functionlist.php");

    date_default_timezone_set("Asia/Bangkok");

    $hostname = "localhost";
    $user = "root";
    $password = "Admin@2018";
    $dbname = "qfinancial";
    $db_handle = mysql_connect($hostname,$user,$password)or die("Cannot connect to Database");
    $db_found = mysql_select_db($dbname)or die("Cannot connect to Database");

// Check if form data was submitted
if (isset($_GET['vn']) && isset($_GET['pres']) && isset($_GET['slot'])) {
        // Get values from the form submission
        $vn = $_GET['vn'];
        $pres = $_GET['pres'];
        $slot = $_GET['slot'];


        // เพิ่มคิวเรียกซ่ำไปที่ช่อง 1
        
        $sql ="INSERT INTO slotmed1 (noslot, vn, PRESCRIP, slot, stat) VALUES (NULL, '$vn', '$pres', '$slot', '1');";
        echo $sql .'<br />';
        mysql_query("SET NAMES UTF8");
        $result = mysql_query($sql);

        // Display the values received
        // echo "<h1>ข้อมูลที่ได้รับ:</h1>";
        // echo "<p>VN: <strong>$vn</strong></p>";
        // echo "<p>ใบยาที่: <strong>$pres</strong></p>";
        // echo "<p>ช่องการเงิน: <strong>$slot</strong></p>";
    } 
?>


<script langguage='javascript'> window.location = 'menuRecMedAddB.php';</script>