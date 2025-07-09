<?php
// เริ่มต้นการเชื่อมต่อฐานข้อมูล
include 'condb.php'; // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ดึง VN 3 รายการล่าสุดจากตาราง req_table
$sql = "SELECT vn FROM req_table ORDER BY created_at DESC LIMIT 3"; 
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// แสดงรายการ VN ที่ดึงมาเรียงต่อกันเป็นแนวนอน
if ($result) {
    $vnList = []; // สร้าง array เพื่อเก็บค่า VN
    foreach ($result as $row) {
        $vnList[] = htmlspecialchars($row['vn']); // เก็บค่า VN ลงใน array
    }
    echo implode(" , ", $vnList); // ใช้ implode() เพื่อแสดง VN โดยคั่นด้วยเครื่องหมายคอมมา
} else {
    echo "ไม่มีคิวล่าสุด"; // หากไม่มีข้อมูล
}
?>
