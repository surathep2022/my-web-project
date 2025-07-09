<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=window-874" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;URL=ServerSoundMed.php">

    <title>ServerSoundMed</title>
</head>
<body>

<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include 'condb.php'; // เชื่อมต่อกับฐานข้อมูล

try {
    // สร้าง SQL query สำหรับดึงข้อมูลจากตาราง soundvn
    $sql = "SELECT id, vn, payment_slot FROM soundvn ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // เริ่มการสร้างตาราง
    echo "<table width='100%' border='1'>";
    echo "<tr>";
    echo "<td>id</td>";
    echo "<td>vn</td>";
    echo "<td>slot</td>"; // เพิ่มคอลัมน์สำหรับปุ่ม Play Sound
    echo "</tr>";
   
    // ดึงข้อมูลรายการล่าสุดจากตาราง
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = htmlspecialchars($row['id']);
        $vn = htmlspecialchars($row['vn']);
        $payment_slot = htmlspecialchars($row['payment_slot']);
        
        echo "<tr>
                <td>{$id}</td>
                <td>{$vn}</td>
                <td>{$payment_slot}</td>                
            </tr>";

        // สร้างการเปลี่ยนเส้นทางไปยัง SoundMed.php โดยใช้ JavaScript
        echo "<script type='text/javascript'>
                window.location.href = 'SoundMed.php?id={$id}&vn={$vn}&slot={$payment_slot}';
              </script>";
    }

    echo "</table>";
} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาดให้แสดงข้อความ
    echo "เกิดข้อผิดพลาด: " . htmlspecialchars($e->getMessage());
}
?>

    
</body>
</html>




