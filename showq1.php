<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include 'condb.php'; // ใช้ไฟล์ที่มีการเชื่อมต่อฐานข้อมูล

header("Content-Type: text/html; charset=utf-8"); // กำหนดประเภทของเนื้อหาให้เป็น HTML

try {
    // ดึงข้อมูลที่มี payment_slot = 1 จากตาราง paymentq เรียงตาม created_at ล่าสุด
    $sql = "SELECT * FROM paymentq WHERE payment_slot = 1 ORDER BY created_at DESC LIMIT 1"; // ดึงข้อมูลที่มี payment_slot = 1 และเรียงตาม created_at ล่าสุด
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // แสดงข้อมูล VN ทั้งหมด
    echo "<div style='display: flex; flex-wrap: wrap;'>"; // ใช้ flexbox เพื่อให้แสดงต่อกันเป็นแนวนอน
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div style='margin-right: 20px;'>";
        echo "<p> " . htmlspecialchars($row['vn']) . "</p>"; // แสดง VN ของแต่ละแถว
        echo "</div>";
    }
    echo "</div>";
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
?>
