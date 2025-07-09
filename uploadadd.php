<?php

include("consql.php");

// ตรวจสอบการส่งไฟล์จากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['ad_images'])) {
    // ตั้งค่าโฟลเดอร์ที่ต้องการเก็บไฟล์อัพโหลด
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์ถ้าไม่มี
    }

    // ประเภทไฟล์ที่อนุญาต
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    // ขนาดไฟล์สูงสุด (5MB)
    $max_file_size = 5 * 1024 * 1024; // 5MB

    // วนลูปตรวจสอบไฟล์ที่อัพโหลด
    foreach ($_FILES['ad_images']['tmp_name'] as $key => $tmp_name) {
        // กำหนดชื่อไฟล์และที่อยู่ไฟล์
        $file_name = basename($_FILES['ad_images']['name'][$key]);
        $target_file = $target_dir . time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name); // แก้ไขชื่อไฟล์

        // ตรวจสอบขนาดไฟล์
        if ($_FILES['ad_images']['size'][$key] > $max_file_size) {
            header("Location: addMedia.php?status=upload_error&message=File size too large.");
            exit();
        }

        // ตรวจสอบประเภทไฟล์
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($image_file_type, $allowed_types)) {
            header("Location: addMedia.php?status=upload_error&message=Invalid file type. Only JPG, JPEG, PNG, GIF are allowed.");
            exit();
        }

        // ตรวจสอบการอัปโหลดไฟล์
        if (move_uploaded_file($tmp_name, $target_file)) {
            // บันทึกที่อยู่ไฟล์ในฐานข้อมูล
            $sql = "INSERT INTO ads (image_path) VALUES (:image_path)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':image_path', $target_file, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                header("Location: addMedia.php?status=error&message=Failed to save to database.");
                exit();
            }
        } else {
            header("Location: addMedia.php?status=upload_error&message=Failed to upload file.");
            exit();
        }
    }

    // ส่งข้อมูลไปยัง add.php พร้อมข้อความแจ้งเตือนสำเร็จ
    header("Location: addMedia.php?status=success");
    exit();
}

// ปิดการเชื่อมต่อฐานข้อมูล (ไม่จำเป็นใน PDO แต่ทำเพื่อให้เหมือนเดิม)
$conn = null;
?>
