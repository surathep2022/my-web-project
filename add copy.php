<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>EGFR</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="css/bootstrap.min.css">

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

        <div class="container-fluid">
           
             <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
              <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="KHRAM_V.png" alt="Logo" style="width: 460px; height:130px;"/> 
               
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

                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                    
                    <div class="col-8">
                      <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3 text-bg-info border-info">
                          <h4 class="my-0 fw-normal">จัดการโฆษณา</h4>
                        </div>   
                        
                        <br>
                        <br>

                        <div class="card-body">
                          
                        </div>

                      </div>
                    </div>

                   <div class="col-4">
                      <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3 text-bg-success border-success">
                          <h4 class="my-0 fw-normal">เพิ่มรูปโฆษณา</h4>
                        </div>   
                        
                        <br>
                        <br>

                        <div class="card-body">

                            <form class="row g-3"method="post" action="">                              
                             
                             

                              <div class="mb-3 row">
                              
                                <input class="form-control form-control-lg" id="formFileLg" type="file">
                              </div>


                        

                              <div class="mb-3 row">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-lg me-2">บันทึก</button> <!-- เพิ่ม me-2 เพื่อระยะห่าง -->
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
    
    </body>

    <script src="js/bootstrap.min.js"></script>

    
</html>