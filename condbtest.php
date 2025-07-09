<?php
    $host = 'localhost';
    $db = 'qfinancialtest';
    $user = 'root';
    $pass = 'Admin@2018';

    try {
        // เชื่อมต่อฐานข้อมูลด้วย PDO
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>