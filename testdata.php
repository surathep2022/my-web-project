<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

   
     <!-- Set the character encoding to Windows-874 for Thai, and UTF-8 for modern browsers -->
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=window-874" /> -->
    <meta charset="UTF-8"> <!-- This takes precedence in modern browsers -->
    
    <!-- Set the page to refresh every 60 seconds -->
    <meta http-equiv="refresh" content="60"/>

    <!-- Set the title of the page -->
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Mitr&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">    -->
  </head>

<body>
  
  <? date_default_timezone_set("Asia/Bangkok");?>
  <? //include("Functionlist.php"); ?>
 

<div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="KHRAM_V.png" alt="Logo" style="width: 460px; height:130px;"/> 
            <!-- Replace SVG and text with an image -->
          </a>
          
               <!-- <ul class="nav nav-pills" style="margin-top: 10px;">
                    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                </ul>-->

                <form class="row g-3" style="margin-top: 20px; font-family: 'Kanit', sans-serif;" action="" method="get">

                    <div class="col-auto">
                        <label for="text" class="col-form-label" style="font-size: 1.5rem;">VN :</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="vn" id="vn" class="form-control" style="width: 300px; height: 50px; font-size: 1.5rem;" aria-describedby="VN">
                    </div>                 

                    <div class="col-auto">
                        <label for="text" class="col-form-label" style="font-size: 1.5rem;">ใบยาที่ :</label>
                    </div>

                    <div class="col-auto">
                        <select class="form-select" name="pres" id="pres" style="width: 100px; height: 50px; font-size: 1.5rem;">                            
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>                            
                            <option>4</option>
                            <option>5</option>                           
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <label for="text" class="col-form-label" style="font-size: 1.5rem;">ช่องยา :</label>
                    </div>

                    <div class="col-auto">
                        <select class="form-select" style="width: 100px; height: 50px; font-size: 1.5rem;">
                            <option <? if ($slot == '1'){?> selected="selected"<? }?> >1</option>
                            <option <? if ($slot == '2'){?> selected="selected"<? }?> >2</option>
                            <option <? if ($slot == '3'){?> selected="selected"<? }?> >3</option>                            
                            <option <? if ($slot == '4'){?> selected="selected"<? }?> >4</option>
                            <option <? if ($slot == '5'){?> selected="selected"<? }?> value="Refill">Refill</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" style="width: 150px; height: 50px; font-size: 1.5rem;">เลือก</button>
                    </div>

                </form>         
          
        </header>


            <?php
            // ตั้งค่าการเชื่อมต่อฐานข้อมูล
           
            include("ConnectSSB.php");
           
            

            try {
                // เชื่อมต่อฐานข้อมูล SQL Server ด้วย PDO
                $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
                $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // สร้าง SQL query
                $sql = "SELECT DISTINCT 
                        HNOPD_PRESCRIP.VN,
                        HNOPD_MASTER.HN,
                        SUBSTRING(dbo.HNPAT_NAME.FirstName, 2, 100) + ' ' + SUBSTRING(dbo.HNPAT_NAME.LastName, 2, 100) AS Name,
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
                        HNOPD_MASTER.OutDateTime,
                        HNOPD_PRESCRIP.NurseAckDateTime -- เพิ่มคอลัมน์นี้เพื่อใช้กับ ORDER BY
                    FROM [dbo].[HNOPD_PRESCRIP]
                    LEFT OUTER JOIN HNOPD_MASTER 
                        ON HNOPD_PRESCRIP.VisitDate = HNOPD_MASTER.VisitDate 
                        AND HNOPD_PRESCRIP.VN = HNOPD_MASTER.VN
                    LEFT OUTER JOIN HNPAT_NAME 
                        ON HNOPD_MASTER.HN = HNPAT_NAME.HN
                    WHERE 
                        CONVERT(DATE, HNOPD_PRESCRIP.VisitDate, 23) = CONVERT(DATE, GETDATE(), 23)
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
                        AND HNPAT_NAME.ChangeDateTime IS NULL
                        ORDER BY HNOPD_PRESCRIP.NurseAckDateTime ASC
                ";

                // เตรียม statement และ execute query
                $stmt = $connHos->prepare($sql);
                $stmt->execute();

                
                // เริ่มแสดงตาราง Bootstrap
                echo "<table class='table table-striped' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>";
                echo "<thead>
                            <tr>
                                <th>VN</th>
                                <th>HN</th>
                                <th>Name</th>
                                <th>Prescription No</th>
                                <th>Clinic</th>
                                <th>ByClinic</th>
                                <th>LastDiagOpdMasterLogType</th>
                                <th>DrugAcknowledge</th>
                            </tr>
                       </thead>";
                echo "<tbody>";

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
                    echo "<td>" . htmlspecialchars($row['DrugAcknowledge']) . "</td>";
                    echo "</tr>";
                }

    echo "</tbody>";
    echo "</table>";
                echo "</table>";

            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>






 </div>  



</body>
   
<script>
      function playPromptSound(vn) {

        // Convert VN to string if it's not already
        vn = vn.toString();

        // Define the base path for the audio files
        var basePath = 'audio/';

        // Define the audio file paths for digits 0-9
        var numberFiles = [
            'prompt4_0.mp3', 'prompt4_1.mp3', 'prompt4_2.mp3', 'prompt4_3.mp3',
            'prompt4_4.mp3', 'prompt4_5.mp3', 'prompt4_6.mp3', 'prompt4_7.mp3',
            'prompt4_8.mp3', 'prompt4_9.mp3'
        ];

        // Create an array to hold the complete list of audio files to be played
        var filesToPlay = [];

        // First file: prompt4_number.mp3 (static file)
        filesToPlay.push(basePath + 'prompt4_number.mp3');

        // Check each digit in VN and add corresponding audio file to the list
        for (var i = 0; i < vn.length; i++) {
            var digit = parseInt(vn[i], 10);
            if (digit >= 0 && digit <= 9) {
                filesToPlay.push(basePath + numberFiles[digit]);
            }
        }

        // Add the other static audio files after the digits
        filesToPlay.push(basePath + 'prompt4_mdc.mp3');
        filesToPlay.push(basePath + 'prompt4_1.mp3');
        filesToPlay.push(basePath + 'prompt4_sir.mp3');

        // Function to play audio files sequentially
        function playAudio(index) {
            if (index >= filesToPlay.length) {
                console.log('All audio files have been played.');
                return;
            }
            
            var audio = new Audio(filesToPlay[index]);
            audio.play();
            
            audio.onended = function() {
                playAudio(index + 1);
            };
        }

        // Start playing from the first audio file
        playAudio(0);
        }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</html>
