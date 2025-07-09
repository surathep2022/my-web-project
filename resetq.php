<?php
    include "consql.php";  // เชื่อมต่อฐานข้อมูล

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
        try {
            // สร้างคำสั่ง SQL เพื่อลบข้อมูลทั้งหมดในตาราง paymentq
            $sql = "DELETE FROM paymentq";
            
            // เตรียมและดำเนินการคำสั่ง SQL
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // หลังจากลบข้อมูลสำเร็จ ให้ redirect กลับไปที่หน้าหลัก
            header("Location: callqmoney.php");  // เปลี่ยนเป็นชื่อไฟล์หน้าหลักของคุณ
            exit();
        } catch (PDOException $e) {
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        }
    }
?>
