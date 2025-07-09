<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// เริ่มต้น session หากยังไม่เริ่ม
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Bangkok');

$servername = "10.6.200.100";
$username = "sa";
$password = "password@123";
$dbName = 'DNHOSPITAL';

try {
    // เชื่อมต่อฐานข้อมูล
    $connHos = new PDO("sqlsrv:Server=$servername;Database=$dbName", $username, $password);
    $connHos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // ตั้งค่า message สำเร็จใน session
    $_SESSION['success'] = "PDO Connected Database: DNHOSPITAL successfully";
} catch (PDOException $e) {
    // ตั้งค่า message error ใน session
    $_SESSION['errorS'] = "PDO Connection failed: " . $e->getMessage();
}

// แสดงผลลัพธ์ผ่าน JavaScript
if (isset($_SESSION['success'])) {
    ?>
    <script>
        console.log("<?php echo $_SESSION['success']; ?>");
        <?php unset($_SESSION['success']); ?>
    </script>
    <?php
} elseif (isset($_SESSION['errorS'])) {
    ?>
    <script>
        console.log("<?php echo $_SESSION['errorS']; ?>");
        <?php unset($_SESSION['errorS']); ?>
    </script>
    <?php
} else {
    die("Unexpected error occurred.");
}
?>
