<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include 'condb.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบว่ามีค่า 'vn' ที่ส่งมาหรือไม่
    if (isset($_POST['vn'])) {

        $vn = $_POST['vn']; // รับค่า VN จากฟอร์ม

        // เตรียม SQL สำหรับการเพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO req_table (vn, status) VALUES (:vn, 'pending')"; // 'pending' เป็นตัวอย่างสถานะ

        try {
            // เตรียม statement
            $stmt = $conn->prepare($sql);
            
            // ผูกค่าที่ได้รับจากฟอร์มเข้ากับ statement
            $stmt->bindParam(':vn', $vn);
            
            // ดำเนินการบันทึกข้อมูลลงฐานข้อมูล
            $stmt->execute();
            
            // เมื่อบันทึกสำเร็จให้ทำการ Redirect ไปที่หน้า callqmoney.php
            session_start();
            $_SESSION['status'] = 'success';
            header('Location: callqmoney.php');
            exit;
            
        } catch (PDOException $e) {
            echo "การบันทึกข้อมูลล้มเหลว: " . $e->getMessage();
        }
    } else {
        echo "ข้อมูลไม่ครบถ้วน";
    }
}
?>
