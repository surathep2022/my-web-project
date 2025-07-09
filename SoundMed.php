<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://www.collaboratescience.com/protoplasm/library/main.js"></script>
</head>

<body>
Loading...

<br>

<?php
    $id = $_GET['id'] ?? null;
    $vn = $_GET['vn'] ?? null;
    $slot = $_GET['slot'] ?? null;

    $vnLength = strlen($vn);

    echo "id: $id<br>"; 
    echo "VN: $vn<br>"; 
    echo "Slot: $slot<br>";   
    echo "Length of VN: $vnLength<br>";
?>

<br>

<audio class="my_audio" controls autoplay></audio>

<script>
    // รับค่าจาก PHP
    let vn = "<?= $vn ?>";
    let slot = "<?= $slot ?>";

    // ตรวจสอบว่ามี vn และ slot หรือไม่
    if (vn && slot) {
        // สร้างเพลย์ลิสต์สำหรับเล่นไฟล์เสียงตามลำดับที่กำหนด
        let playlist = {
            'song_1': 'audio/start.mp3',  // เริ่มต้นด้วย start.mp3
        };

        // เพิ่มไฟล์เสียงตามตัวเลขใน VN
        for (let i = 0; i < vn.length; i++) {
            playlist['song_' + (i + 2)] = 'audio/prompt4_' + vn[i] + '.mp3';  // เพิ่มเสียงตามเลข vn
        }

        // เพิ่มไฟล์เสียง center.mp3 หลังจาก vn
        playlist['song_' + (vn.length + 2)] = 'audio/center.mp3';

        // เพิ่มเสียงของ slot ตามตำแหน่ง slot[i]
        playlist['song_' + (vn.length + 3)] = 'audio/prompt4_' + slot + '.mp3';

        // เพิ่มไฟล์เสียง end.mp3 ปิดท้าย
        playlist['song_' + (vn.length + 4)] = 'audio/end.mp3';

        // โหลดไฟล์เสียงเริ่มต้น
        let keys = Object.keys(playlist);
        $('.my_audio').append("<source id='sound_src' src=" + playlist[keys[0]] + " type='audio/mpeg'>");

        let count = 0; // ตัวนับไฟล์เสียง

        $('.my_audio').on('ended', function() {
            count++; // เลื่อนลำดับไฟล์ถัดไป
            if (count < keys.length) {
                $("#sound_src").attr("src", playlist[keys[count]])[0];
                $(".my_audio").trigger('load'); // โหลดไฟล์ใหม่
                $(".my_audio").trigger('play'); // เล่นไฟล์เสียง
            } else {
                // เมื่อเล่นไฟล์สุดท้ายเสร็จแล้ว ให้ทำการ redirect ไปยัง ServerSoundMed.php
                window.location.href = "ServerSoundMed.php";
            }
        });

        // เล่นไฟล์แรกทันทีเมื่อเพจโหลดเสร็จ
        $(".my_audio").trigger('play');
    }
</script>

<?php
// ลบรายการออกจากตาราง soundmed โดยอิงจาก id
include 'condb.php';

try {
    $sql = "DELETE FROM soundvn WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

</body>
</html>
