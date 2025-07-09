<?php
include 'condbtest.php';

try {
    // เชื่อมต่อฐานข้อมูลด้วย PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // สร้าง SQL query เพื่อดึงข้อมูลโฆษณาจากฐานข้อมูล
    $sql = "SELECT image_path FROM ads"; // ชื่อ table และ column ที่เก็บที่อยู่ของรูปภาพ
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($stmt->rowCount() > 0) {
        // วนลูปสร้าง HTML สำหรับ Carousel
        $carouselItems = '';
        $firstItem = true; // ใช้เพื่อกำหนด item แรกเป็น active

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $activeClass = $firstItem ? 'active' : '';
            $carouselItems .= '<div class="carousel-item ' . $activeClass . '">';
            $carouselItems .= '<img src="' . htmlspecialchars($row['image_path']) . '" class="d-block w-60" alt="...">';
            $carouselItems .= '</div>';
            $firstItem = false; // ตั้งค่า item ถัดไปไม่เป็น active
        }
    } else {
        $carouselItems = '<div class="carousel-item active"><img src="default.jpg" class="d-block w-100" alt="No images available"></div>'; // Placeholder ถ้าไม่มีรูป
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
