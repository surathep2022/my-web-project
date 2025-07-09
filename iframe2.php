<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=window-874" />
<meta http-equiv="refresh" content="5;URL=iframe2.php">

<meta http-equiv="refresh" content="30;URL=home.php">

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Index</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">   


    .si1 {
        font-size: 120px;
        text-align: center;
    }

    body {
        font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto */
        
        height: 100vh; /* ทำให้สูงเต็มหน้าจอ */
        display: flex; /* ใช้ flexbox สำหรับการจัดตำแหน่ง */
        justify-content: center; /* จัดตรงกลางแนวนอน */
        align-items: center; /* จัดตรงกลางแนวตั้ง */
        margin: 0; /* ไม่มีขอบหรือ padding */
    }

    h1, h2, h3, h4, h5, h6, p {
        font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto ใน heading และ paragraph */
    }


</style>

<script>
    setInterval(function(){
        document.querySelector("iframe").src = "iframe2.php"; // รีโหลด iframe
    }, 30000); // ทุก ๆ 30 วินาที
</script>


</head>

<body class="azq" onload="Tm=setInterval('scrollwindow()',10);">

<? date_default_timezone_set("Asia/Bangkok");?>


<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include 'condb.php'; // ใช้ไฟล์ที่มีการเชื่อมต่อฐานข้อมูล

header("Content-Type: text/html; charset=utf-8"); // กำหนดประเภทของเนื้อหาให้เป็น HTML

try {
    // ดึงข้อมูลที่มี payment_slot = 1 จากตาราง paymentq เรียงตาม created_at ล่าสุด
    $sql = "SELECT * FROM paymentq WHERE payment_slot = 2 ORDER BY created_at DESC LIMIT 1"; // ดึงข้อมูลที่มี payment_slot = 1 และเรียงตาม created_at ล่าสุด
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // แสดงข้อมูล VN ทั้งหมด
    echo "<div style='display: flex; flex-wrap: wrap;'>"; // ใช้ flexbox เพื่อให้แสดงต่อกันเป็นแนวนอน
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div style="margin-right: 20px; text-align: center;">'; // Centering the content
        echo '<span class="si1"><strong>' . htmlspecialchars($row['vn']) . '</strong></span>'; // Display VN with bold styling
        echo '</div>';


    }
    echo "</div>";
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
?>






</body>




</html>
