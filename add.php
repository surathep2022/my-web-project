<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- โหลด SweetAlert ที่นี่ -->
</head>


    <body> 
            <? 
              include("../Connect/ConnectSSB.php");
              include("../FunctionHos/Functionlist.php");
            ?>

            <? date_default_timezone_set("Asia/Bangkok");?>

            <?
              $vn = $_POST['vn'];
             // echo $date = date("d/m/Y");
              $ydate = date("Y");
              $mdate = date("m");
              $ddate = date("d");
          
            ?>


        <?php
        // ตรวจสอบค่าที่ส่งมาผ่าน GET เพื่อตัดสินใจแสดง SweetAlert
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<script>
                    Swal.fire({
                        title: "บันทึกรูปสำเร็จ!",
                        text: "",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location = "add.php";
                    });
                </script>';
            } elseif ($_GET['status'] == 'error') {
                echo '<script>
                    Swal.fire({
                        title: "ข้อผิดพลาด!",
                        text: "Error saving file path to database: ' . htmlspecialchars($_GET['message']) . '",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location = "add.php";
                    });
                </script>';
            } elseif ($_GET['status'] == 'upload_error') {
                echo '<script>
                    Swal.fire({
                        title: "ข้อผิดพลาด!",
                        text: "คุณยังไม่ได้เลือกไฟล์รูปภาพที่ต้องการ",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location = "add.php";
                    });
                </script>';
            }
        }
        ?>

            

<div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="add.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="KHRAM_V.png" alt="Logo" style="width: 460px; height: 130px;">
            </a>
            <ul class="nav nav-pills" style="margin-top: 50px;">
                <li class="nav-item"><a href="home.php" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
        </header>          

        <div class="container-fluid">
            <div class="container text-center">
                <div class="row">
                    <!-- จัดการโฆษณา -->
                    <div class="col-sm-8">
                      <div class="card mb-4 rounded-3 shadow-sm">
                          <div class="card-header py-3 text-bg-info border-info">
                              <h4 class="my-0 fw-normal">จัดการโฆษณา</h4>
                          </div>   
                          <br><br>
                          <div class="card-body">
                              <!-- ดึงข้อมูลโฆษณาจากฐานข้อมูลมาแสดง -->
                          <?php
                             
                              include("consql.php");
                              // ตรวจสอบการเชื่อมต่อฐานข้อมูล
                              if (!$conn) {
                                  die("Connection failed: " . mysqli_connect_error());
                              }

                              // ตรวจสอบว่ามีการลบข้อมูลหรือไม่
                              if (isset($_POST['delete_id'])) {
                                  $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
                                  $delete_sql = "DELETE FROM ads WHERE id = $delete_id";
                                  if (mysqli_query($conn, $delete_sql)) {
                                      echo '<script>
                                          Swal.fire({
                                              title: "สำเร็จ!",
                                              text: "ลบโฆษณาเรียบร้อยแล้ว",
                                              icon: "success",
                                              timer: 2000,
                                              showConfirmButton: false
                                          }).then(function() {
                                              window.location = "add.php";
                                          });
                                      </script>';
                                  } else {
                                      echo '<script>
                                          Swal.fire({
                                              title: "ข้อผิดพลาด!",
                                              text: "เกิดข้อผิดพลาดในการลบโฆษณา",
                                              icon: "error",
                                              timer: 2000,
                                              showConfirmButton: false
                                          });
                                      </script>';
                                  }
                              }

                              // สร้าง SQL query เพื่อดึงข้อมูลโฆษณาจากฐานข้อมูล
                              $sql = "SELECT * FROM ads"; // ชื่อ table ที่คุณเก็บโฆษณา
                              $result = mysqli_query($conn, $sql);

                              // ตรวจสอบว่ามีข้อมูลหรือไม่
                              if (mysqli_num_rows($result) > 0) {
                                  echo '<table class="table table-bordered">';
                                  echo '<thead>';
                                  echo '<tr>';
                                  echo '<th>ลำดับ</th>';
                                  echo '<th>รูปภาพ</th>';
                                  echo '<th style="width: 200px;">การจัดการ</th>';
                                  echo '</tr>';
                                  echo '</thead>';
                                  echo '<tbody>';

                                  // วนลูปแสดงผลโฆษณาแต่ละรายการ
                                  $count = 1;
                                  while ($row = mysqli_fetch_assoc($result)) {
                                      echo '<tr>';
                                      echo '<td>' . $count++ . '</td>';
                                      
                                echo '<td><img src="' . $row['image_path'] . '" alt="Ad Image" style="width:20%; height:auto;"></td>';
                                      echo '<td>';
                                      echo '<button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">ลบ</button>';
                                      echo '</td>';
                                      echo '</tr>';
                                  }

                                  echo '</tbody>';
                                  echo '</table>';
                              } else {
                                  echo 'ไม่มีโฆษณาในระบบ';
                              }

                              // ปิดการเชื่อมต่อฐานข้อมูล
                              mysqli_close($conn);
                        ?>


                          </div>
                      </div>
                  </div>


                    <!-- เพิ่มรูปโฆษณา -->
                    <div class="col-sm-4">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3 text-bg-success border-success">
                                <h4 class="my-0 fw-normal">เพิ่มรูปโฆษณา</h4>
                            </div>   
                            <br><br>
                            <div class="card-body">

                                <form class="row g-3" method="post" action="upload.php" enctype="multipart/form-data">
                                    <div class="mb-3 row">
                                        <label for="formFileLg" class="form-label">เลือกอัตราส่วน 1:1 ขนาดภาพสูงสุด 1080*1080 px</label>
                                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="ad_image" accept="image/*">
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success btn-lg me-2">บันทึก</button>
                                            <button type="reset" class="btn btn-danger btn-lg">ยกเลิก</button>
                                        </div>
                                    </div>
                                </form>

                                
                            </div>
                        </div>
                    </div>

                    
                </div>                
            </div>     
        </div>		
    </div>	
    
    </body>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // เมื่อคลิกปุ่มลบ
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const adId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'ต้องการลบโฆษณานี้หรือไม่?',
                    text: "การลบโฆษณาจะไม่สามารถกู้คืนได้",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ลบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ส่งข้อมูลการลบไปยัง server
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '';

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'delete_id';
                        input.value = adId;

                        form.appendChild(input);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>

    <script src="js/bootstrap.min.js"></script>
  
    
</html>