<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "ConnectSSB.php";

try {
    // กำหนดจำนวนรายการต่อหน้า
    $limit = 10; // แสดงข้อมูล 10 รายการต่อหน้า
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // กำหนดหน้าเริ่มต้น
    $offset = ($page - 1) * $limit; // คำนวณตำแหน่งเริ่มต้นในการดึงข้อมูล

    // เชื่อมต่อฐานข้อมูล SQL Server ด้วย PDO
    $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
    $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // สร้าง SQL query โดยใช้ limit และ offset ตรงๆ ไม่ bind parameter เพื่อหลีกเลี่ยงการ bind มากเกินไป
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
and HNOPD_PRESCRIP_MEDICINE.CxlDateTime is null";  // ใช้การกำหนดค่าตรงๆ ใน query

    $stmt = $connHos->query($sql); // ใช้ query ตรงๆ ไม่ต้อง bind parameters
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // แสดงผลข้อมูล
    foreach ($results as $row) {
        echo '<div>' . htmlspecialchars($row['VN']) . '</div>';
    }

} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . htmlspecialchars($e->getMessage());
}
?>


</body>
</html>



