<div class="col-4"> 
                

                <img src="KHRAM_V.png" alt="Logo" style="width: 200px; height:50px; margin-top: 5px;"/>
                

                               
                <div class="datetime-container" style="float: right ;  margin-right: 1px;">
                     <div id="time" class="time" style = "margin-top: 1px;"></div>
                     <div id="date" class="date"></div>
                </div>      

                <br>

                <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php echo $carouselItems; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">.</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">.</span>
                    </a>
                </div>


                

            </div>

            <thead>
                        <tr>     
                            <th colspan="2">                               
                            </th>                                     
                            <th colspan="2" scope="col" style="font-size: 54px;">ช่องชำระเงิน</th>
                            <th colspan="2" scope="col" style="font-size: 54px;">ชำระเงิน</th>                            
                        </tr>
                    </thead>



                    body {
        background-color: #e0b0ff; /* สีม่วง */
        font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto */
    }


    <?php

                    // ตั้งค่าการเชื่อมต่อฐานข้อมูล           
                        include "ConnectSSB.php";

                            try {

                                            // กำหนดจำนวนรายการต่อหน้า
                                $limit = 10; // แสดงข้อมูล 10 รายการต่อหน้า
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // กำหนดหน้าเริ่มต้น
                                $offset = ($page - 1) * $limit; // คำนวณตำแหน่งเริ่มต้นในการดึงข้อมูล


                                // เชื่อมต่อฐานข้อมูล SQL Server ด้วย PDO
                                $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
                                $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // สร้าง SQL query
                                $sql = "SELECT DISTINCT HNOPD_PRESCRIP.AlreadySettleBalance,HNOPD_PRESCRIP.LinkCashierFacilityRmsNo,HNOPD_RECEIVE_HEADER.ReceiptNo,
                                HNOPD_PRESCRIP.VN,
                                HNOPD_MASTER.HN,
                                SUBSTRING(dbo.HNPAT_NAME.FirstName, 2, 100) + ' ' + SUBSTRING(dbo.HNPAT_NAME.LastName, 2, 100) AS Name,
                                HNOPD_PRESCRIP.PrescriptionNo,
                                HNOPD_PRESCRIP.Clinic,
                                (SELECT ISNULL(SUBSTRING(LocalName, 2, 1000), SUBSTRING(EnglishName, 2, 1000))
                                    FROM DNSYSCONFIG WITH (NOLOCK)
                                    WHERE CtrlCode = '42203' 
                                    AND code = HNOPD_PRESCRIP.Clinic) AS ByClinic,
                                CASE 
                                    WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '22' THEN 'Drug_Acknowledge'
                                    WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '23' THEN 'Drug_Ready'
                                    WHEN HNOPD_PRESCRIP.LastDiagOpdMasterLogType = '17' THEN 'NurseCounter_Release'
                                END AS LastDiagOpdMasterLogType,

                                CASE 
                                WHEN HNOPD_PRESCRIP_MEDICINE.StockCode = 'NODRUG'  THEN 'ไม่มียา'
                                when HNOPD_PRESCRIP_MEDICINE.StockCode != 'NODRUG' and HNOPD_PRESCRIP_MEDICINE.StockCode !=''   THEN 'มียา' end as Medicine,

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
                                LEFT OUTER JOIN HNOPD_RECEIVE_HEADER on HNOPD_MASTER.VisitDate=HNOPD_RECEIVE_HEADER.VisitDate and HNOPD_MASTER.VN=HNOPD_RECEIVE_HEADER.VN
                                LEFT OUTER JOIN HNOPD_PRESCRIP_MEDICINE ON HNOPD_PRESCRIP.VisitDate = HNOPD_PRESCRIP_MEDICINE.VisitDate 
                                                    AND HNOPD_PRESCRIP_MEDICINE.VN = HNOPD_MASTER.VN and HNOPD_PRESCRIP.PrescriptionNo=HNOPD_PRESCRIP_MEDICINE.PrescriptionNo
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
                                                    
                                                    AND HNOPD_PRESCRIP.CloseVisitCode not in('ADM','C01','C02','C03','C04','C05','C06','C07','C08','C09','C10','C11','C12','C13','C14','C15')
                                                    AND HNOPD_MASTER.OutDateTime IS NULL
                                                    AND HNPAT_NAME.ChangeDateTime IS NULL
                                AND HNOPD_RECEIVE_HEADER.ReceiptNo is null
                                AND HNOPD_PRESCRIP_MEDICINE.CxlByUserCode is null

                                ORDER BY HNOPD_PRESCRIP.NurseAckDateTime ASC
                                OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";

                                // เตรียม statement และ bind ค่า
                                $stmt = $connHos->prepare($sql);
                                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                                $stmt->execute();

                                


                                // เพิ่มช่องค้นหาข้อมูลตรงนี้
                                // echo "<form method='GET' action=''>";
                                // echo "<input type='text' name='search' placeholder='ค้นหา VN หรือ Name' value='" . htmlspecialchars($searchTerm) . "' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>";
                                // echo "<button type='submit' class='btn btn-primary' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>ค้นหา</button>";
                                // echo "</form>";

                                
                                // เริ่มแสดงตาราง Bootstrap
                                echo "<table class='table table-striped' style='font-family: Kanit, sans-serif; font-size: 1.2rem;'>";
                                echo "<thead class='table-dark'>
                                            <tr>                              
                                                <th style='width: 300px;'>VN : Name</th>
                                                <th style='width: 100px;'>Medicine</th>   
                                                <th style='width: 100px;'>DR</th>                               
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
                                    
                                    echo "<td>";
                                    if (empty($row['Medicine'])) {
                                        echo "ไม่มียา"; // ถ้า Medicine เป็นค่าว่าง
                                    } else {
                                        echo htmlspecialchars($row['Medicine']); // แสดงค่าของ Medicine ถ้ามีค่า
                                    }
                                    echo "</td>";

                                   
                                    
                                    echo "<td>";
                                    if ($row['Medicine'] == 'ไม่มียา' && $row['DrugReady'] == 0) {
                                        echo "null"; // กรณีไม่มียาและ DrugReady เท่ากับ 0
                                    } else if ($row['DrugReady'] == 0) {
                                        echo "รอจัดยา"; // กรณีรอจัดยา
                                    } else if ($row['DrugReady'] == 1) {
                                        echo "จัดยาเรียบร้อย"; // กรณีจัดยาเรียบร้อยแล้ว
                                    }
                                    echo "</td>";



                                    echo "<td>" . htmlspecialchars($row['PrescriptionNo']) . "</td>";                                
                                    echo "<td>" . htmlspecialchars($row['ByClinic']) . "</td>";


                                   echo "<td>";
                                // ฟอร์มสำหรับช่อง Select และปุ่ม กดเรียก
                                 echo "<form method='POST' action='addqtest.php' style='display:flex; align-items:center;' onsubmit='return validateForm()'>";
                                
                                // ช่อง Select อยู่ทางซ้ายของปุ่ม กดเรียก                 
                                echo "<select class='form-select' name='payment_slot' id='payment_slot'  aria-label='Default select example' style='margin-right: 10px; width: auto;' required>"; // กำหนดขนาดของ select พร้อม required
                                echo "<option selected disabled>เลือกช่อง</option>"; // ตัวเลือกเริ่มต้น (disabled เพื่อไม่ให้เลือกได้)
                                echo "<option value='1'>การเงิน 1</option>";
                                echo "<option value='2'>การเงิน 2</option>";
                                echo "<option value='3'>การเงิน 3</option>";
                                echo "<option value='4'>การเงิน 4</option>";                   
                                echo "</select>";

                                
                                // ส่งค่าจาก $row ที่ต้องการไปยัง addqtest.php ด้วย input hidden
                                echo "<input type='hidden' name='vn' value='" . htmlspecialchars($row['VN']) . "'>";
                                echo "<input type='hidden' name='name' value='" . htmlspecialchars($row['Name']) . "'>";
                                echo "<input type='hidden' name='medicine' value='" . htmlspecialchars($row['Medicine']) . "'>";
                                echo "<input type='hidden' name='drug_ready' value='" . htmlspecialchars($row['DrugReady']) . "'>";
                                echo "<input type='hidden' name='by_clinic' value='" . htmlspecialchars($row['ByClinic']) . "'>";
                                                            
                                
                                // ปุ่ม กดเรียก 
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