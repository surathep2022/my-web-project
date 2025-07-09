<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include 'condbtest.php'; // ให้ include ไฟล์ที่มีการเชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบว่ามีค่า 'vn' และ 'payment_slot' ที่ส่งมาผ่านฟอร์มหรือไม่
    if (isset($_POST['vn']) && isset($_POST['payment_slot'])) {

        $vn = $_POST['vn']; // ค่าที่ได้รับจาก input hidden
        $payment_slot = $_POST['payment_slot']; // ค่าที่เลือกจาก select

        try {
            // ตรวจสอบว่ามีข้อมูล payment_slot ในตาราง paymentq อยู่แล้วหรือไม่
            $sql_check = "SELECT * FROM paymentq WHERE payment_slot = :payment_slot";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bindParam(':payment_slot', $payment_slot);
            $stmt_check->execute();

            // ตรวจสอบว่าพบข้อมูลที่ตรงกันหรือไม่
            if ($stmt_check->rowCount() > 0) {
                // ถ้าพบข้อมูล ให้ทำการ UPDATE แทนที่จะ INSERT
                $sql_update = "UPDATE paymentq SET vn = :vn WHERE payment_slot = :payment_slot";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bindParam(':vn', $vn);
                $stmt_update->bindParam(':payment_slot', $payment_slot);

                // ดำเนินการอัปเดตข้อมูล
                $stmt_update->execute();

                echo "ข้อมูลถูกอัปเดตเรียบร้อยแล้ว";

            } else {
                // ถ้าไม่พบข้อมูล ให้ทำการ INSERT ข้อมูลใหม่
                $sql_insert = "INSERT INTO paymentq (vn, payment_slot) VALUES (:vn, :payment_slot)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bindParam(':vn', $vn);
                $stmt_insert->bindParam(':payment_slot', $payment_slot);

                // ดำเนินการบันทึกข้อมูลใหม่
                $stmt_insert->execute();

                echo "ข้อมูลถูกบันทึกเรียบร้อยแล้ว";
            }

            // หลังจากทำการบันทึกหรืออัปเดตข้อมูลใน paymentq แล้ว ทำการเพิ่มข้อมูลลงใน soundvn
            $sql_soundvn = "INSERT INTO soundvn (vn, payment_slot) VALUES (:vn, :payment_slot)";
            $stmt_soundvn = $conn->prepare($sql_soundvn);
            $stmt_soundvn->bindParam(':vn', $vn);
            $stmt_soundvn->bindParam(':payment_slot', $payment_slot);

            // ดำเนินการบันทึกข้อมูลลงฐานข้อมูล soundvn
            $stmt_soundvn->execute();

            // เมื่อบันทึกสำเร็จให้ทำการ Redirect ไปที่หน้า callqmoney.php
            session_start();
            $_SESSION['status'] = 'success';
            header('Location: callqmoneytest.php');
            exit;

        } catch (PDOException $e) {
            echo "การบันทึกข้อมูลล้มเหลว: " . htmlspecialchars($e->getMessage());
        }
    } else {
        // แสดงแจ้งเตือนหากไม่ได้กรอกข้อมูลครบถ้วน
        echo "
        <script>
            alert('กรุณาเลือกช่องก่อนกดเรียก');
            window.location.href = 'callqmoneytest.php';
        </script>";
    }
}
?>
