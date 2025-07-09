<?php

        // ตั้งค่าการเชื่อมต่อฐานข้อมูล (PDO)
        $hostname = "localhost";
        $user = "root";
        $password = "Admin@2018";
        $dbname = "qfinancial";

        try {
        // เชื่อมต่อฐานข้อมูล (PDO)
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $user, $password);
        // กำหนดโหมดการแจ้งข้อผิดพลาดเป็นข้อยกเว้น
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
        }

?>