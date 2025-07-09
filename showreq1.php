<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=window-874" />
<meta http-equiv="refresh" content="30;URL=showreq1.php">

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<title>Index</title>

<style type="text/css">   
    .si1 {
        font-size: 100px;
        text-align: center;
    }

    body {
        background-color: #6f42c1; /* สีม่วง */
        font-family: 'Roboto', sans-serif; /* ใช้ฟอนต์ Roboto */
    }

    h1, h2, h3, h4, h5, h6, p {
        font-family: 'Roboto', sans-serif;
        color: white; /* เปลี่ยนสีฟอนต์เป็นสีขาว */
    }

    span {
        color: white; /* เปลี่ยนสีฟอนต์เป็นสีขาว */
    }

    /* การตั้งค่าสำหรับการเลื่อน */
    .scrolling-container {
        height: 100vh; /* ความสูงเต็มหน้าจอ */
        overflow: hidden; /* ซ่อน scroll bar */
        position: relative;
    }

    .scroll-content {
        position: absolute;
        top: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<script>
    // ฟังก์ชันเพื่อเลื่อนเนื้อหา
    function startScrolling() {
        const content = document.querySelector('.scroll-content');
        let position = window.innerHeight;

        setInterval(function() {
            position -= 2; // เลื่อนขึ้น 2px ทุก ๆ 30ms
            content.style.top = position + 'px';

            // ถ้าเนื้อหาหมดหน้าจอให้กลับไปเริ่มต้นที่ด้านล่าง
            if (position < -content.offsetHeight) {
                position = window.innerHeight;
            }
        }, 20); // ความเร็วในการเลื่อน
    }

    // เริ่มการเลื่อนเมื่อโหลดหน้าจอเสร็จ
    window.onload = function() {
        startScrolling();
    };
</script>

</head>

<body>
<!-- Container สำหรับเนื้อหาที่ต้องการเลื่อน -->
<div class="scrolling-container">
    <div class="scroll-content">
        <?php
        // เริ่มการเชื่อมต่อฐานข้อมูล
        include 'condb.php';

        header("Content-Type: text/html; charset=utf-8");

        try {
            // ดึง VN 3 รายการล่าสุดจากตาราง req_table
            $sql = "SELECT vn FROM req_table ORDER BY created_at DESC LIMIT 3";  
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // แสดง VN ที่ดึงมาเรียงต่อกัน
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div style="text-align: center;">';
                echo '<span class="si1"><strong>' . htmlspecialchars($row['vn']) . '</strong></span>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        }
        ?>
    </div>
</div>

</body>
</html>
