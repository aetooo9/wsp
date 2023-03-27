<?php 

session_start();
require 'conn.php';
require 'token.php';
require 'func.php';

if($_SESSION['token']==$_POST['token']){
    
if (isset($_POST['register'])) {

    if(!empty($_POST['user_name']) && !empty($_POST['phone']) && !empty($_POST['password']))
{
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $verifiy = 0;

    $code = rand(1000,9999);


    $sql = "insert into users(user_name, phone, user_password, code, verifiy) values(?, ?, ? , ?, ?)";
    $r = $conn->prepare($sql);
    $r->bind_param("sssis", $user_name, $phone, $password, $code, $verifiy);
    $ex = $r->execute();
    if($ex){
        echo sms($phone,$code);
        echo "<script>location.href='code.php?phone=$phone';</script>";
        $msg = "<div class='alert alert-success'>تم السجيل بنجاح</div>";
    }else {
        $msg = "<div class='alert alert-danger'>يوجد خطا في النظام حاول في وقت لاحق</div>";
    }
}else{
    $msg = "<div class='alert alert-danger'>يرجى ملى جميع الحقول</div>";
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
                    <h5 class="card-title">انشاء حساب جديد</h5>  
                    <?php echo $msg; ?>  
                        <form method="post" >
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <div class="form-floating mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="اسم المستخدم" name="user_name" required>
                                <label for="name">الاسم رباعي</label>
                            </div>
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" placeholder=" ادخل الرقم االهاتف بدون (0)" name="phone" required>
                                <label for="email">ادخل الرقم االهاتف بدون (0)</label>
                            </div>
                            <div class="form-floating mb-3 mt-3">
                                <input type="password" class="form-control" placeholder="كلمة المرور" name="password" required>
                                <label for="password">كلمة المرور</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" name="password_confirm" required>
                                <label for="pswd">تاكيد كلمة المرور</label>
                            </div>
                            <div class="mb-3 text-center">
                                <input type="submit" class="btn btn-color" name="register" value="تسجيل">
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