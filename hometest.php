<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <title>HOME</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Mitr&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>


    <link rel="stylesheet" href="home.css">

    <style>

    .carousel-inner img {
        width: 100%;  /* ปรับให้ภาพพอดีกับความกว้างของ carousel */
        height: auto; /* ปรับความสูงตามสัดส่วนของภาพ */
        max-height: 565px; /* กำหนดความสูงสูงสุดของภาพ */
    }
    </style>

    <body>

           <? 
           // include("../Connect/ConnectSSB.php");
           // include("../FunctionHos/Functionlist.php");
            ?>
            
            <? date_default_timezone_set("Asia/Bangkok");?>

            <?
              $vn = $_POST['vn'];
             // echo $date = date("d/m/Y");
              $ydate = date("Y");
              $mdate = date("m");
              $ddate = date("d");

          
   ?>

   <?php include 'carousel.php';?>


   <div class="container-fluid">
        <div class="row">
            <div class="col-4">

                <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php echo $carouselItems; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">.</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">.</span>
                    </a>
                </div>   

                <table class="table table-striped">                    
                        <tbody> 
                            <tr>   
                                <td style="width: 50%; text-align: center; font-size: 64px;" id="la">รอจัดยา :</td>
                                <td id="low">
                                    <iframe name="fram" src="showmed.php" frameborder="20"
                                            scrolling="no" height="100" width="230" marginwidth="0" marginheight="0" >
                                    </iframe>
                                </td>                          
                            </tr>
                        </tbody>
                </table>

            </div>

            <div class="col-8">
                <table class="table table-striped">
                    <thead>
                        <tr>                        
                            <th colspan="2" scope="col" style="font-size: 34px; text-align: center; width: 33%;">ช่องชำระเงิน</th>
                            
                            <th colspan="2" scope="col" style="font-size: 34px; text-align: center; width: 33%;">ชำระเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" style="width: 20%; text-align: center; font-size: 32px;" id="la">การเงิน 1 <hr>Cashier 1</td>
                        
                            <td colspan="2" style="width: 20%; text-align: center;" id="low"></td>
                        </tr>
                        <tr>
                        
                            <td colspan="2" style="width: 33%; text-align: center; font-size: 32px;" id="la">การเงิน 2 <hr>Cashier 2</td>
                        
                            <td colspan="2" style="width: 33%; text-align: center;" id="low"></td>
                        </tr>
                        <tr>
                            
                            <td colspan="2" style="width: 33%; text-align: center; font-size: 32px;" id="la">การเงิน 3 <hr>Cashier 3</td>
                            
                            <td colspan="2" style="width: 33%; text-align: center;" id="low"></td>
                        </tr>
                        <tr>
                            
                            <td colspan="2" style="width: 33%; text-align: center; font-size: 32px;" id="la">การเงิน 4 <hr>Cashier 4</td>
                            
                            <td colspan="2" style="width: 33%; text-align: center;" id="low"></td>
                        </tr>

                        <tr>
                            
                        
                        <td style="width: 15%; text-align: center; font-size: 64px;" id="la">รอเรียก :</td>
                        <td id="low">
                            <iframe name="fram" src="showcall.php" frameborder="20"
                                    scrolling="no" height="100" width="230" marginwidth="0" marginheight="0" >
                            </iframe>
                        </td>

                        

                        <td style="width: 20%; text-align: center; font-size: 64px;" id="la">รอเรียกซ้ำ :</td>
                        <td id="low">
                            
                        </td>
                        
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>


    </body>

    <script>
        // Function to update the time every second
        function updateTime() {
            const now = new Date();
            
            // Format time as HH:MM:SS
            const time = now.toLocaleTimeString('th-TH', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Format date as "วันอังคารที่ 3 กันยายน 2567"
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric'
            };
            const date = now.toLocaleDateString('th-TH', options);

            // Display time and date
            document.getElementById('time').textContent = `เวลา ${time}`;
            document.getElementById('date').textContent = `${date}`;
        }

        // Start the clock
        function startClock() {
            updateTime(); // Initial call to display the time immediately
            setInterval(updateTime, 1000); // Update time every second
        }

        // Run the clock once the page loads
        window.onload = startClock;
    </script>
     <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- ใส่ใน <head> หรือส่วนที่เหมาะสมในไฟล์ HTML ของคุณ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
