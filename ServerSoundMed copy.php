<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
include 'condb.php'; // เชื่อมต่อกับฐานข้อมูล

try {
    // สร้าง SQL query สำหรับดึงข้อมูลจากตาราง soundvn
    $sql = "SELECT id,vn, payment_slot FROM soundvn ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // เริ่มการสร้างตาราง
    echo "<table width='100%' border='1'>";
   
    echo "<tr>";
    echo "<td>id</td>";
    echo "<td>vn</td>";
    echo "<td>slot</td>"; // เพิ่มคอลัมน์สำหรับปุ่ม Play Sound
    echo "</tr>";
    echo "<tr>";
   

    // วนลูปดึงข้อมูลมาแสดงในตาราง
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = htmlspecialchars($row['id']);
        $vn = htmlspecialchars($row['vn']);
        $payment_slot = htmlspecialchars($row['payment_slot']);
        echo '<tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['vn'].'</td>
                <td>'.$row['payment_slot'].'</td>                
            </tr>';
        
    }

    echo "</tbody>";
    echo "</table>";
} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาดให้แสดงข้อความ
    echo "เกิดข้อผิดพลาด: " . htmlspecialchars($e->getMessage());
}



<!-- JavaScript Function -->
<script>
  function playPromptSound(vn, payment_slot) {
    // Convert VN to string if it's not already
    vn = vn.toString();

    // Define the base path for the audio files
    var basePath = 'audio/';

    // Define the audio file paths for digits 0-9
    var numberFiles = [
        'prompt4_0.mp3', 'prompt4_1.mp3', 'prompt4_2.mp3', 'prompt4_3.mp3',
        'prompt4_4.mp3', 'prompt4_5.mp3', 'prompt4_6.mp3', 'prompt4_7.mp3',
        'prompt4_8.mp3', 'prompt4_9.mp3'
    ];

    // Create an array to hold the complete list of audio files to be played
    var filesToPlay = [];

    // First file: start.mp3 (static file)
    filesToPlay.push(basePath + 'start.mp3');

    // Check each digit in VN and add corresponding audio file to the list
    for (var i = 0; i < vn.length; i++) {
        var digit = parseInt(vn[i], 10);
        if (digit >= 0 && digit <= 9) {
            filesToPlay.push(basePath + numberFiles[digit]);
        }
    }

    // Add center.mp3 (static file)
    filesToPlay.push(basePath + 'center.mp3');

    // Add payment slot sound file (e.g., "prompt4_1.mp3" for slot 1)
    filesToPlay.push(basePath + 'prompt4_' + payment_slot + '.mp3');

    // Last file: end.mp3 (static file)
    filesToPlay.push(basePath + 'end.mp3');

    // Function to play audio files sequentially
    function playAudio(index) {
        if (index >= filesToPlay.length) {
            console.log('All audio files have been played.');
            return;
        }
        
        var audio = new Audio(filesToPlay[index]);
        audio.play();
        
        audio.onended = function() {
            playAudio(index + 1);
        };
    }

    // Start playing from the first audio file
    playAudio(0);
}

</script>
