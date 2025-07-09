<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=window-874" />
	<meta http-equiv="refresh" content="15;URL=frame1.php">

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	

<title>frame1</title>

<style type="text/css">
			.container {
				width: 1180px;
				height: 900px;
				margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
			}

			/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
			.header {
				
				background-color: #9400D3;
			}


			.content {
				padding-top: 1280;
				padding-right: px;
				padding-bottom: 800;
				height: 650px;
				
			}

			/* ~~ The footer ~~ */
			.footer {
				padding: 10px 0;
				background-color: #CCC49F;

			}

			/* ~~ miscellaneous float/clear classes ~~ */
			.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
				float: right;
				margin-left: 8px;
			}
			.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
				float: left;
				margin-right: 8px;
			}
			.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
				clear:both;
				height:0;
				font-size: 1px;
				line-height: 0px;
			}
			.si1 {
				font-size: 120px;/* เปลี่ยนขนาดเลขที่แสดงผล */
				text-align: center;
			}
			#sa {
				font-size: xx-large;
			}

		    body {
				font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto */
			}
			h1, h2, h3, h4, h5, h6, p {
				font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto ใน heading และ paragraph */
			} 

			/* CSS to make the div scrollable */
			#scrollContent {
			height: 500px; /* Set the height of the scrollable area */
			overflow: hidden; /* Hide the scrollbar */
			border: 1px solid #ccc; /* Optional border */
			background-color: black; /* Set background to black for contrast */
			}

			span {
			color: white; /* Change text color to white */
			}

			body {
			background-color: #6f42c1; /* Set the entire background to black */
			}
</style>
<!-- 
		<script language="JavaScript1.2">
				var speed=1
				var currentpos=0,alt=1,curpos1=0,curpos2=-1
				function scrollwindow(){
				if (document.all)
					temp=document.body.scrollTop
					else
					temp=window.pageYOffset

					if (alt==0)
					alt=1
					else
					alt=0
						if (alt==0)
						curpos1=temp
						else
						curpos2=temp
						if (curpos1!=curpos2){
							if (document.all)
							currentpos=document.body.scrollTop+speed
							else
							currentpos=window.pageYOffset+speed
					//		window.scroll(0,currentpos)
							window.scroll(0,currentpos)
							}
							else{
								
								//	clearInterval(Tm);
						}
					}
		</script> -->

</head>

<body class="azq" onload="Tm=setInterval('scrollwindow()',10);">
	<? 
		//include("ConnectSSB.php");
		include("Functionlist.php");

		
	?>

<? date_default_timezone_set("Asia/Bangkok");?>

<?
  $vn = $_POST['vn'];
 // echo $date = date("d/m/Y");
  $ydate = date("Y");
  $mdate = date("m");
  $ddate = date("d");
  $i=1;
  include("condb.php");

	// echo $ydate; 
	// echo "<br>";
	// echo $mdate;
	// echo "<br>";
	// echo $ddate;
	// ตั้งค่าการเชื่อมต่อฐานข้อมูล
	
$servername = "10.6.200.100";
$username = "sa";
$password = "password@123";
$dbName = "DNHOSPITAL";

try {
    // เชื่อมต่อฐานข้อมูล SQL Server ด้วย PDO
    $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
    $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // สร้าง SQL query
    $sql = "
        SELECT 
            HNOPD_PRESCRIP.VN,
            HNOPD_MASTER.HN,
            SUBSTRING (dbo.HNPAT_NAME.FirstName, 2, 100) + ' ' + SUBSTRING (dbo.HNPAT_NAME.LastName, 2, 100) AS Name,
            HNOPD_PRESCRIP.PrescriptionNo,
            HNOPD_PRESCRIP.Clinic,
            (SELECT ISNULL(SUBSTRING(LocalName, 2, 1000), SUBSTRING(EnglishName, 2, 1000))
                FROM DNSYSCONFIG
                WHERE CtrlCode = '42203'
                AND code = HNOPD_PRESCRIP.Clinic) AS ByClinic,
            CASE 
                WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '22' THEN 'Drug_Acknowledge'  
                WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '23' THEN 'Drug_Ready' 
                WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '17' THEN 'NurseCounter_Release' 
            END AS LastDiagOpdMasterLogType,
            HNOPD_PRESCRIP.DrugAcknowledge,
            HNOPD_PRESCRIP.DefaultRightCode,
            HNOPD_PRESCRIP.CloseVisitCode,
            HNOPD_PRESCRIP.DrugReady,
            HNOPD_PRESCRIP.ApprovedDateTime,
            HNOPD_PRESCRIP.ApprovedByUserCode,
            HNOPD_MASTER.OutDateTime
        FROM [dbo].[HNOPD_PRESCRIP]
        LEFT OUTER JOIN HNOPD_MASTER 
            ON HNOPD_PRESCRIP.VisitDate = HNOPD_MASTER.VisitDate 
            AND HNOPD_PRESCRIP.VN = HNOPD_MASTER.VN
        LEFT OUTER JOIN HNPAT_NAME 
            ON HNOPD_MASTER.HN = HNPAT_NAME.HN
        WHERE 
            CONVERT(date, HNOPD_PRESCRIP.VisitDate, 23) = CONVERT(date, GETDATE(), 23)
            AND HNOPD_PRESCRIP.DefaultRightCode NOT IN (
                '2100', '2106', '2205', '2208', '2210', '2212', '2214', '4100', 
                '2105', '2108', '2206', '2209', '2211', '2213', '2215', '21002')
            AND HNOPD_PRESCRIP.Clinic NOT IN (
                '14009', '15001', '15002', '15005', '15006', '15007', '15010', 
                '15011', '15012', '15013', '15014', '15015', '15016', '15017', 
                '15018', '15019', '15020', '15021', '15023', '15024', '15025', 
                '15026', '15027', '15028', '15029', '15030', '15031', '15032', 
                '15033', '15035', '15008', '15009', '99994', '12001', '12004', 
                '12003', '07024', '07014', 'WIKPS01', '15003')
            AND HNOPD_PRESCRIP.CloseVisitCode = 'D/C'
            AND HNOPD_MASTER.OutDateTime IS NULL
        ORDER BY HNOPD_PRESCRIP.NurseAckDateTime ASC
    ";

    // เตรียม statement และ execute query
    $stmt = $connHos->prepare($sql);
    $stmt->execute();

    // เริ่มแสดงตาราง
    echo "<table border='1' cellpadding='10' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>";
    echo "<tr><th>VN</th><th>HN</th><th>Name</th><th>Prescription No</th><th>Clinic</th><th>ByClinic</th><th>LastDiagOpdMasterLogType</th></tr>";

    // วนลูปดึงข้อมูลแต่ละแถวและแสดงผลในตาราง
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['VN']) . "</td>";
        echo "<td>" . htmlspecialchars($row['HN']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['PrescriptionNo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Clinic']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ByClinic']) . "</td>";
        echo "<td>" . htmlspecialchars($row['LastDiagOpdMasterLogType']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}		


   ?>


</body>


</html>
