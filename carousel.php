<?php
            // ตั้งค่าการเชื่อมต่อฐานข้อมูล
            $hostname = "localhost";
            $user = "root";
            $password = "Admin@2018";
            $dbname = "qfinancial";

            // เชื่อมต่อฐานข้อมูล (ใช้ mysqli)
            $conn = mysqli_connect($hostname, $user, $password, $dbname) or die("Cannot connect to Database");

            // สร้าง SQL query เพื่อดึงข้อมูลโฆษณาจากฐานข้อมูล
            $sql = "SELECT image_path FROM ads"; // ชื่อ table และ column ที่เก็บที่อยู่ของรูปภาพ
            $result = mysqli_query($conn, $sql);

            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if (mysqli_num_rows($result) > 0) {
                // วนลูปสร้าง HTML สำหรับ Carousel
                $carouselItems = '';
                $firstItem = true; // ใช้เพื่อกำหนด item แรกเป็น active

                while ($row = mysqli_fetch_assoc($result)) {
                    $activeClass = $firstItem ? 'active' : '';
                    $carouselItems .= '<div class="carousel-item ' . $activeClass . '">';
                    $carouselItems .= '<img src="' . htmlspecialchars($row['image_path']) . '" class="d-block w-60" alt="...">';
                    $carouselItems .= '</div>';
                    $firstItem = false; // ตั้งค่า item ถัดไปไม่เป็น active
                }
            } else {
                $carouselItems = '<div class="carousel-item active"><img src="default.jpg" class="d-block w-100" alt="No images available"></div>'; // Placeholder ถ้าไม่มีรูป
            }

            // ปิดการเชื่อมต่อฐานข้อมูล
            mysqli_close($conn);
?>