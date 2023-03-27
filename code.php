<?php 

session_start();
require 'conn.php';
require 'token.php';

if($_SESSION['token']==$_POST['token']){
    
    if (isset($_POST['confirm'])) {
    
        $phone = $_GET['phone'];
        $code = $_POST['code'];
    
        $sql = "select count(1) from users where code = ? and phone = ?";
        $r = $conn->prepare($sql);
        $r->bind_param("ii", $code,$phone);
        $r->execute();

         $rr = $r->get_result();
         $code = $rr->fetch_assoc();
 
        if($code > 0){
            $sql = "update users set verifiy=1 where phone = ?";
                $r = $conn->prepare($sql);
                $r->bind_param("i", $phone);
                $r->execute();
            echo "<script>location.href='./';</script>";
        }else {
            $msg = "<div class='alert alert-danger'>رمز التحقق غير صحيح</div>";
        }
    }
    
    }
    


        ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <title>المجلس القومي السوداني للمهن الطبية والصحية</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <meta name="author" content="Etoo Play Information Technology">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CCS files -->
    <link href="./css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="./css/all.min.css" rel="stylesheet">
    <link href="./css/fontawesome.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <!-- JS files -->
    <script src="./js/bootstrap.min.js" ></script>
    <script src="./js/all.min.js" ></script>

    	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1EERD8DM82"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1EERD8DM82');
</script>
</head>
<body>

<div class="section">
    <div class="container">
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  


</div>
</div>
<div  class="section mt-4">
    <div class="container text-center">
        <img src="./img/logo.png" width="100px">
        <p >المجلس القومي السوداني للمهن الطبية والصحية</p>
        <h5>نظام المعاملات الالكتروني</h5>
        <div class="row justify-content-center">
            <div class="card form-card ">
                    <div class="card-body">
                    <h5 class="card-title">يرجى ادخال رمز التحقق</h5>  
                    <?php echo $msg; ?>  
                        <form method="post" >
                            <div class="form-floating mb-3 mt-3">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <input type="number" class="form-control" placeholder="رمز التحقق" name="code" required>
                                <label for="email">رمز التحقق</label>
                            </div>
                            <div class="mb-3 text-center">
                                <input type="submit" class="btn btn-color" name="confirm" value="تاكيد رمز التحقق">
                            </div>
                            <div class="mb-3 text-center">
                            <a href="./" class="card-link">تسجيل الدخول</a>

                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>



<div class="footer">
    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm justify-content-center">
    <ul class="navbar-nav">       
                    <li class="nav-item">
                        <a class="nav-link" href="#">عن المجلس</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">شروط الخدمة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">السياسات والاحكام</a>
                    </li>
                </ul>
    </nav>
    <div class="social-links">
    <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
    </div>
    <p>الحقوق محفوظة للمجلس القومي السوداني للمهن الطبية والصحية &copy; <?php echo date('Y'); ?>م</p>
</div>
</body>
</html>