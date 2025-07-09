<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=window-874" />
<meta http-equiv="refresh" content="10;URL=showmed.php">



<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<title>Index</title>

<style type="text/css">   
    .si1 {
        font-size: 120px;
        text-align: center;
    }

    body {
       
        font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto */
    }

    h1, h2, h3, h4, h5, h6, p {
        font-family: 'Roboto', sans-serif;
        color: black; /* เปลี่ยนสีฟอนต์เป็นสีขาว */
    }

    span {
        color: black; /* เปลี่ยนสีฟอนต์เป็นสีขาว */
    }

    /* การตั้งค่าสำหรับการเลื่อน */
    .scrolling-container {
        height: 100vh; /* ความสูงเต็มหน้าจอ */
        overflow: hidden; /* ซ่อน scroll bar */
        position: relative;
    }

    .scroll-content {
        position: absolute;
        top: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<script>
    // ฟังก์ชันเพื่อเลื่อนเนื้อหา
    function startScrolling() {
        const content = document.querySelector('.scroll-content');
        let position = window.innerHeight;

        setInterval(function() {
            position -= 2; // เลื่อนขึ้น 2px ทุก ๆ 30ms
            content.style.top = position + 'px';

            // ถ้าเนื้อหาหมดหน้าจอให้กลับไปเริ่มต้นที่ด้านล่าง
            if (position < -content.offsetHeight) {
                position = window.innerHeight;
            }
        }, 20); // ความเร็วในการเลื่อน
    }

    // เริ่มการเลื่อนเมื่อโหลดหน้าจอเสร็จ
    window.onload = function() {
        startScrolling();
    };
</script>

</head>


<body>  
<div class="scrolling-container">
    <div class="scroll-content">

        <?php

            // ตั้งค่าการเชื่อมต่อฐานข้อมูล
            include "ConnectSSB.php";

            try {
                // กำหนดจำนวนรายการต่อหน้า (ตัวอย่างใช้ 10 รายการ)
                $limit = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // หน้าเริ่มต้น
                $offset = ($page - 1) * $limit; // คำนวณตำแหน่งเริ่มต้นในการดึงข้อมูล

                // เชื่อมต่อฐานข้อมูล SQL Server ด้วย PDO
                $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
                $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // สร้าง SQL query
                $sql = "SELECT distinct HNOPD_MASTER.HN,HNOPD_PRESCRIP.VN,HNOPD_PRESCRIP.PrescriptionNo, HNOPD_PRESCRIP.Clinic,(SELECT ISNULL(SUBSTRING ( LocalName, 2, 1000 ), SUBSTRING ( EnglishName, 2, 1000 ))
                FROM
                    DNSYSCONFIG 
                WHERE
                    CtrlCode = '42203' 
                    AND code = HNOPD_PRESCRIP.Clinic) AS Clinic ,HNOPD_PRESCRIP.DefaultRightCode,
                (SELECT ISNULL(SUBSTRING ( LocalName, 2, 1000 ), SUBSTRING ( EnglishName, 2, 1000 ))
                FROM
                    DNSYSCONFIG 
                WHERE
                    CtrlCode = '42086' 
                    AND code = HNOPD_PRESCRIP.DefaultRightCode) as DefaultRightName ,HNOPD_PRESCRIP.DrugAcknowledge,HNOPD_PRESCRIP.DrugReady,HNOPD_PRESCRIP.DrugCheckOut,HNOPD_PRESCRIP.DrugFirstCheck,HNOPD_PRESCRIP.ApprovedByUserCode,HNOPD_MASTER.OutDateTime,HNOPD_PRESCRIP.CloseVisitCode,
                (SELECT ISNULL(SUBSTRING ( LocalName, 2, 1000 ), SUBSTRING ( EnglishName, 2, 1000 ))
                FROM
                    DNSYSCONFIG 
                WHERE
                    CtrlCode = '42261' 
                    AND code = HNOPD_PRESCRIP.CloseVisitCode) as CloseVisitCode
                
                ,HNOPD_PRESCRIP.LastDiagOpdMasterLogType,HNOPD_RECEIVE_HEADER.ReceiptNo,
                CASE WHEN HNOPD_PRESCRIP.DrugAcknowledge=1 and HNOPD_PRESCRIP.DrugReady=0   THEN 'รอจัดยา' 
                WHEN HNOPD_PRESCRIP.DrugAcknowledge=1 and HNOPD_PRESCRIP.DrugReady=1   THEN 'จัดยาเรียบร้อย'
                else 'ไม่มียา'
                
                end as MEDICINE


                from HNOPD_MASTER WITH (NOLOCK)

                left outer join HNOPD_PRESCRIP on HNOPD_MASTER.VisitDate=HNOPD_PRESCRIP.VisitDate and HNOPD_MASTER.VN=HNOPD_PRESCRIP.VN
                left outer join HNOPD_RECEIVE_HEADER on HNOPD_MASTER.VisitDate=HNOPD_RECEIVE_HEADER.VisitDate AND HNOPD_MASTER.VN=HNOPD_RECEIVE_HEADER.VN
                left outer join HNOPD_PRESCRIP_MEDICINE on HNOPD_PRESCRIP.VisitDate=HNOPD_PRESCRIP_MEDICINE.VisitDate and HNOPD_PRESCRIP.VN=HNOPD_PRESCRIP_MEDICINE.VN and HNOPD_PRESCRIP.PrescriptionNo=HNOPD_PRESCRIP_MEDICINE.PrescriptionNo



                where HNOPD_MASTER.Cxl=0
                and Format(HNOPD_MASTER.VisitDate,'dd-MM-yyyy')=format(getdate(),'dd-MM-yyyy') and 

                (SELECT ISNULL(SUBSTRING ( LocalName, 2, 1000 ), SUBSTRING ( EnglishName, 2, 1000 ))
                FROM
                    DNSYSCONFIG 
                WHERE
                    CtrlCode = '42203' 
                    AND code = HNOPD_PRESCRIP.Clinic) like'%WI%'
                and HNOPD_MASTER.OutDateTime is null

                and not HNOPD_PRESCRIP.CloseVisitCode is null
                and  HNOPD_PRESCRIP.CloseVisitCode !='ADM'
                AND HNOPD_RECEIVE_HEADER.ReceiptNo IS NULL
                and HNOPD_PRESCRIP_MEDICINE.CxlDateTime is null";

                // เตรียม statement และ execute
                $stmt = $connHos->prepare($sql);
                $stmt->execute();

                // ดึงข้อมูลจากฐานข้อมูล
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // ตรวจสอบเงื่อนไข DrugAcknowledge และ DrugReady
                    if ($row['DrugAcknowledge'] == 1 && $row['DrugReady'] == 0) {
                        echo '<div style="text-align: center;">';
                        echo '<span class="si1"><strong>' . htmlspecialchars($row['VN']) . '</strong></span>'; // แสดง VN
                        echo '</div>';
                    }
                }
                

            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        ?>

    </div>
</div>
                
        
           
        

   
</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</html>
