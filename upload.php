<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$hostname = "localhost";
$user = "root";
$password = "Admin@2018";
$dbname = "qfinancial";

// เชื่อมต่อฐานข้อมูล (ใช้ mysqli)
$conn = mysqli_connect($hostname, $user, $password, $dbname) or die("Cannot connect to Database");

// ตรวจสอบการส่งไฟล์จากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['ad_image'])) {
    // ตั้งค่าโฟลเดอร์ที่ต้องการเก็บไฟล์อัพโหลด
    $target_dir = "uploads/"; // โฟลเดอร์สำหรับเก็บไฟล์
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์ถ้าไม่มี
    }
    $target_file = $target_dir . basename($_FILES["ad_image"]["name"]); // กำหนดชื่อไฟล์และที่อยู่ไฟล์

    // ตรวจสอบการอัพโหลดไฟล์
    if (move_uploaded_file($_FILES["ad_image"]["tmp_name"], $target_file)) {
        // บันทึกที่อยู่ไฟล์ในฐานข้อมูล
        $file_path = mysqli_real_escape_string($conn, $target_file);
        $sql = "INSERT INTO ads (image_path) VALUES ('$file_path')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // ส่งข้อมูลไปยัง add.php พร้อมข้อความแจ้งเตือนสำเร็จ
            header("Location: add.php?status=success");
            exit();
        } else {
            // ส่งข้อมูลไปยัง add.php พร้อมข้อความแจ้งเตือนข้อผิดพลาด
            header("Location: add.php?status=error&message=" . urlencode(mysqli_error($conn)));
            exit();
        }
    } else {
        // ส่งข้อมูลไปยัง add.php พร้อมข้อความแจ้งเตือนข้อผิดพลาดการอัปโหลด
        header("Location: add.php?status=upload_error");
        exit();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
