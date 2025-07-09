<!DOCTYPE html>
	<html lang="en">
  	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=window-874" />
        <meta http-equiv="refresh" content="30"/>
        <title>Index</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Mitr&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">    
             

    </head>

	<body>

		<!-- Form and Content -->
		<? 
			include("../Connect/ConnectSSB.php");
			include("../FunctionHos/Functionlist.php");
		?>
		
		<? date_default_timezone_set("Asia/Bangkok");?>

	<div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="KHRAM_V.png" alt="Logo" style="width: 460px; height:130px;"/> 
            <!-- Replace SVG and text with an image -->
          </a>
          
               <!-- <ul class="nav nav-pills" style="margin-top: 10px;">
                    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                </ul>-->

            <form class="row g-3" style="margin-top: 20px; font-family: 'Kanit', sans-serif;" action="recMedA.php" method="get" onsubmit="return validateForm()">

                    <div class="col-auto">
                        <label for="vn" class="col-form-label" style="font-size: 1.5rem;">VN :</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="vn" id="vn" class="form-control" style="width: 300px; height: 50px; font-size: 1.5rem;" aria-describedby="VN" required>
                    </div>                 

                    <div class="col-auto">
                        <label for="pres" class="col-form-label" style="font-size: 1.5rem;">ใบยาที่ :</label>
                    </div>

                    <div class="col-auto">
                        <select class="form-select" name="pres" id="pres" style="width: 100px; height: 50px; font-size: 1.5rem;">                            
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>                            
                            <option>4</option>
                            <option>5</option>                           
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <label for="slot" class="col-form-label" style="font-size: 1.5rem;">ช่องการเงิน :</label>
                    </div>

                    <div class="col-auto">
                        <select class="form-select" name="slot" id="slot" style="width: 100px; height: 50px; font-size: 1.5rem;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>                            
                            <option value="4">4</option>                           
                        </select>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" style="width: 150px; height: 50px; font-size: 1.5rem;">เลือก</button>
                    </div>

                </form>				  
				  
        </header>

        <div class="container-fluid">
             

            <iframe name="fram" src="menuRecMedAdd.php" frameborder="0"
            scrolling="yes" height="1100" width="1800" marginwidth="0" marginheight="0">
            </iframe>

        </div> 
        
        
    </div>	
	
</body>

<script>
          function validateForm() {
            var vn = document.getElementById('vn').value;
                if (vn === "") {
                    alert("กรุณากรอก VN");
                    return false;  // Prevent form submission
                  }
                return true;  // Allow form submission
            }          
</script>



	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</html>
