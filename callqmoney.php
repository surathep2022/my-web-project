<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

   
     <!-- Set the character encoding to Windows-874 for Thai, and UTF-8 for modern browsers -->
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=window-874" /> -->
    <meta charset="UTF-8"> <!-- This takes precedence in modern browsers -->
    
    <!-- Set the page to refresh every 60 seconds -->
    <!-- <meta http-equiv="refresh" content="60"/> -->

    <!-- Set the title of the page -->
    <title>CallQMoney</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <!-- เรียกใช้ SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Mitr&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">   
  </head>

  <link rel="stylesheet" href="callqmoney.css">

 

<body>
  
  <? date_default_timezone_set("Asia/Bangkok");?>
  <? //include("Functionlist.php"); ?>

  <?php
    session_start();
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'success') {
        echo "
        <script>
            // แสดง SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ!',
                text: 'ข้อมูลถูกบันทึกลงในระบบแล้ว',
                showConfirmButton: false,
                timer: 2000 // การแจ้งเตือนจะหายไปหลังจาก 2 วินาที
            }).then(() => {
                // เปลี่ยน URL กลับไปที่ URL เดิมโดยไม่แสดงพารามิเตอร์
                window.history.replaceState(null, null, 'callqmoney.php');
            });
        </script>";
        
        unset($_SESSION['status']); // ลบ session หลังจากแสดงแจ้งเตือน
    }
    ?>

<div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="callqmoney.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
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

                <form class="row g-3" style="margin-top: 20px; font-family: 'Kanit', sans-serif;" action="addq.php" method="POST">

                    <div class="col-auto">
                        <label for="text" class="col-form-label" style="font-size: 1.5rem;">VN :</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="vn" id="vn" class="form-control" style="width: 300px; height: 50px; font-size: 1.5rem;" aria-describedby="VN" inputmode="numeric" pattern="\d*" required>
                    </div>               
                

                    <div class="col-auto">
                        <label for="text" class="col-form-label" style="font-size: 1.5rem;">ช่องชำระเงิน :</label>
                    </div>

                    <div class="col-auto">
                            <select class="form-select" name="payment_slot" id="payment_slot" style="width: 100px; height: 50px; font-size: 1.5rem;">                            
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>                            
                            <option>4</option>                            
                        </select>
                    </div>                  

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" style="width: 150px; height: 50px; font-size: 1.5rem;">เลือก</button>
                    </div>

                    <div class="col-auto">
                     <!-- ปุ่ม "ยกเลิก" จะเรียกใช้ JavaScript เพื่อลบข้อมูลทั้งหมดใน paymentq -->
                        <button type="reset" class="btn btn-danger mb-3 delete-btn" style="width: 150px; height: 50px; font-size: 1.5rem;" >ยกเลิก</button>
                    </div>

                </form>        
          
        </header>

<div class="container-fluid">           

    <div class="row">
        <div class="col-3">                    
                
            <table class="table table-striped" style='font-family: Kanit, sans-serif; font-size: 2rem; border-collapse: collapse;'>
                    <thead class='table-dark'>
                        <tr>
                            <th>ช่องชำระเงิน</th>
                            <th>คิวชำระเงิน</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <td>การเงิน 1 </td>
                                <td><?php include 'showq1.php'; ?></td>                          
                            </tr>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <td>การเงิน 2 </td>
                                <td><?php include 'showq2.php'; ?></td>                          
                            </tr>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <td>การเงิน 3 </td>
                                <td><?php include 'showq3.php'; ?></td>                          
                            </tr>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <td>การเงิน 4 </td>
                                <td><?php include 'showq4.php'; ?></td>                          
                            </tr>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <td>คิวรอเรียกซ้ำ :</td>
                                <td>   <?php include 'showreq.php'; ?> </td>                          
                            </tr>
                        </tbody>   

            </table>

            <table class="table table-striped" style='font-family: Kanit, sans-serif; font-size: 2rem; border-collapse: collapse;'>
             <!-- <h3 style='font-family: Kanit, sans-serif;'>คิวรอเรียกซ้ำ</h3> -->
                <thead class='table-dark'>
                    <tr>
                        <th> VN</th>
                        <th>จัดการคิว</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    // เริ่มการเชื่อมต่อฐานข้อมูล
                    include 'condb.php'; // ใช้ไฟล์เชื่อมต่อฐานข้อมูล

                    try {
                        // ดึง VN จาก req_table
                        $sql = "SELECT vn FROM req_table ORDER BY created_at DESC LIMIT 3";  // ดึงข้อมูล VN ล่าสุด 3 รายการ
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        // แสดงข้อมูลในตาราง
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>'; // สร้างแถวใหม่
                            echo '<td>' . htmlspecialchars($row['vn']) . '</td>'; // แสดง VN
                            echo '<td>';
                            
                            // สร้างฟอร์มสำหรับการจัดการคิว
                            echo "<form method='POST' action='addqre.php' style='display:flex; align-items:center;' onsubmit='return validateForm()'>";

                            // ช่อง Select อยู่ทางซ้ายของปุ่ม กดเรียก
                            echo "<select class='form-select' name='payment_slot' id='payment_slot' aria-label='Default select example' style='margin-right: 20px; width: auto;' required>"; // กำหนดขนาดของ select พร้อม required
                            echo "<option selected disabled>เลือกช่อง</option>"; // ตัวเลือกเริ่มต้น (disabled เพื่อไม่ให้เลือกได้)
                            echo "<option value='1'>การเงิน 1</option>";
                            echo "<option value='2'>การเงิน 2</option>";
                            echo "<option value='3'>การเงิน 3</option>";
                            echo "<option value='4'>การเงิน 4</option>";                   
                            echo "</select>";

                            // ปุ่ม กดเรียก
                            echo "<input type='hidden' name='vn' value='" . htmlspecialchars($row['vn']) . "'>"; // เก็บค่า VN ในฟอร์ม
                            echo "<button type='submit' class='btn btn-success' style='margin-right: 5px; width: auto;'>กดเรียก</button>";    
                            echo "</form>";

                            echo '</td>'; // ปิดคอลัมน์
                            echo '</tr>'; // ปิดแถว
                        }
                    } catch (PDOException $e) {
                        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>             
            
        </div>   


        <div class="col-9">

                    <?php

                    // ตั้งค่าการเชื่อมต่อฐานข้อมูล           
                        include "ConnectSSB.php";

                            try {

                                // เชื่อมต่อฐานข้อมูล SQL Server ด้วย PDO
                                $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
                                $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // สร้าง SQL query
                                $sql = "SELECT distinct HNOPD_MASTER.HN,SUBSTRING ( dbo.HNPAT_NAME.FirstName, 2, 100 ) + ' ' + SUBSTRING ( dbo.HNPAT_NAME.LastName, 2, 100 ) AS Name,HNOPD_PRESCRIP.VN,HNOPD_PRESCRIP.PrescriptionNo, HNOPD_PRESCRIP.Clinic,(SELECT ISNULL(SUBSTRING ( LocalName, 2, 1000 ), SUBSTRING ( EnglishName, 2, 1000 ))
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
                                left outer join HNPAT_NAME on HNOPD_MASTER.HN=HNPAT_NAME.HN
            
            
            
                                where HNOPD_MASTER.Cxl=0
                                and convert(date,HNOPD_MASTER.VisitDate)=convert(date,getdate()) and 
            
                                (SELECT ISNULL(SUBSTRING ( LocalName, 2, 1000 ), SUBSTRING ( EnglishName, 2, 1000 ))
                                FROM
                                    DNSYSCONFIG 
                                WHERE
                                    CtrlCode = '42203' 
                                    AND code = HNOPD_PRESCRIP.Clinic) like'%WI%'
                                and HNOPD_MASTER.OutDateTime is null
            
                                and not HNOPD_PRESCRIP.CloseVisitCode is null
                                and  HNOPD_PRESCRIP.CloseVisitCode not in('ADM','C01','C02','C03','C04','C05','C06','C07','C08','C09','C10','C11','C12','C13','C14','C15')
                                AND HNOPD_RECEIVE_HEADER.ReceiptNo IS NULL
                                and HNOPD_PRESCRIP_MEDICINE.CxlDateTime is null
                                and HNPAT_NAME.SuffixSmall=0"; // เปลี่ยนจาก LIMIT เป็น OFFSET และ FETCH NEXT
            
                            
                                // เตรียมและประมวลผลคำสั่ง SQL
                                $stmt = $connHos->prepare($sql);                   
                                $stmt->execute();
                                //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);        
                                


                                // เพิ่มช่องค้นหาข้อมูลตรงนี้
                                // echo "<form method='GET' action=''>";
                                // echo "<input type='text' name='search' placeholder='ค้นหา VN หรือ Name' value='" . htmlspecialchars($searchTerm) . "' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>";
                                // echo "<button type='submit' class='btn btn-primary' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>ค้นหา</button>";
                                // echo "</form>";

                                
                                // เริ่มแสดงตาราง Bootstrap
                                echo "<table class='table table-striped' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>";
                                echo "<thead class='table-dark'>
                                            <tr>                              
                                                <th style='width: 350px;'>VN : Name</th>
                                                <th style='width: 100px;'>Medicine</th>   
                                                                            
                                                <th style='width: 100px;'>ใบยาที่</th>
                                            
                                                <th style='width: 400px;'>ByClinic</th>
                                            
                                                <th colspan='2'>จัดการคิว</th> 

                                            </tr>
                                    </thead>";
                                echo "<tbody>";

                                
                                // วนลูปดึงข้อมูลแต่ละแถวและแสดงผลในตาราง
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                
                                    echo "<td>" . htmlspecialchars($row['VN']) . ' : ' .htmlspecialchars($row['Name']) .  "</td>"; 
                                                                   

                                    echo "<td>" . htmlspecialchars($row['MEDICINE']) . "</td>";  

                                    echo "<td>" . htmlspecialchars($row['PrescriptionNo']) . "</td>";                                
                                    echo "<td>" . htmlspecialchars($row['Clinic']) . "</td>";


                                   echo "<td>";
                                // ฟอร์มสำหรับช่อง Select และปุ่ม กดเรียก
                                 echo "<form method='POST' action='addq.php' style='display:flex; align-items:center;' onsubmit='return validateForm()'>";
                                
                                // ช่อง Select อยู่ทางซ้ายของปุ่ม กดเรียก                 
                                echo "<select class='form-select' name='payment_slot' id='payment_slot'  aria-label='Default select example' style='margin-right: 10px; width: auto;' required>"; // กำหนดขนาดของ select พร้อม required
                                echo "<option selected disabled>เลือกช่อง</option>"; // ตัวเลือกเริ่มต้น (disabled เพื่อไม่ให้เลือกได้)
                                echo "<option value='1'>การเงิน 1</option>";
                                echo "<option value='2'>การเงิน 2</option>";
                                echo "<option value='3'>การเงิน 3</option>";
                                echo "<option value='4'>การเงิน 4</option>";                   
                                echo "</select>";

                                // ปุ่ม กดเรียก
                                echo "<input type='hidden' name='vn' value='" . htmlspecialchars($row['VN']) . "'>";
                                echo "<button type='submit' class='btn btn-success' style='margin-right: 5px; width: auto;'>กดเรียก</button>";    
                                echo "</form>";  
                            echo "</td>";
                                

                                echo "<td>";
                                // ฟอร์มสำหรับช่อง Select และปุ่ม กดเรียก
                                    echo "<form method='POST' action='req.php' style='display:flex; align-items:center;'>"; // ใช้ flexbox เพื่อจัดแนว
                                        echo "<input type='hidden' name='vn' value='" . htmlspecialchars($row['VN']) . "'>";
                                        echo "<button type='submit' class='btn btn-warning'>รอเรียกซ้ำ</button>";                          
                                    echo "</form>";  
                                echo "</td>";


                                echo "</tr>";

                                }    
                                    
                                echo "</tbody>";
                                echo "</table>";
                            
                                // สร้างปุ่มเลื่อนหน้า (pagination)
                                echo '<nav aria-label="Page navigation">';
                                echo '<ul class="pagination">';
                                if ($page > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                                }
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                                echo '</ul>';
                                echo '</nav>';

                            } catch (PDOException $e) {
                                echo "Connection failed: " . $e->getMessage();
                            }
                    ?>                               

        </div>         

    </div>

</div>


</body>
   
<script>
    document.getElementById('vn').addEventListener('input', function (e) {
        // Remove any non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // เมื่อคลิกปุ่ม "ยกเลิก"
        document.querySelector('#delete-all-btn').addEventListener('click', function() {

            Swal.fire({
                title: 'ต้องการลบ VN ทั้งหมดหรือไม่?',
                text: "การลบเลข VN ทั้งหมดไม่สามารถกู้คืนได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ถ้าผู้ใช้ยืนยันการลบ สร้าง form เพื่อส่งคำขอไปยัง server
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'resetq.php';  // เปลี่ยนเป็น URL ที่จะใช้ในการลบข้อมูล

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'delete_all';
                    input.value = '1';

                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ฟังก์ชันสำหรับการส่งคำขอลบ VN ไปยัง resetq.php โดยอัตโนมัติ
        function deleteAllVN() {
            // สร้าง form เพื่อส่งคำขอไปยัง server
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'resetq.php';  // เปลี่ยนเป็น URL ที่จะใช้ในการลบข้อมูล

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_all';
            input.value = '1';

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();  // ส่งฟอร์มไปยังเซิร์ฟเวอร์
        }

        // ทำให้ทำงานอัตโนมัติทุก 60 วินาที (60000 milliseconds)
        setInterval(deleteAllVN, 60000);
    });
</script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</html>
