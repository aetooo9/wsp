<?php 

session_start();
require 'conn.php';

if (isset($_POST['login'])) {

    /*$recaptcha = $_POST['g-recaptcha'];
     
    $secret_key = "6LeVHzolAAAAANQM4jpgiTvQ2TcBowLL7_xA3k_X";

    $url = "https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$recaptcha.'";
 

    $response = file_get_contents($url);

    $response = json_decode($response);


    if($response->success == true){*/

    $phone = $_POST['phone'];
    $user_password = md5($_POST['user_password']);

     $sql = "select count(1) as num,user_id,user_name,group_id from users 
            where phone=$phone and user_password='$user_password' and verifiy=1
            ";
          //  $conn->query($sql);
    $r = $conn->prepare($sql);
    $r->execute();
    $rr = $r->get_result();
    $UserRow = $rr->fetch_assoc();

    if ($UserRow['num'] > 0) {
        $_SESSION['user_id'] = $UserRow['user_id'];
        $_SESSION['user_name'] = $UserRow['user_name'];
        $_SESSION['group_id'] = $UserRow['group_id'];
        $_SESSION['status'] = 1;
        echo "<script>location.href='home.php';</script>";
    } else {
        $msg = "<div class='alert alert-danger'>اسم المستخدم او كلمة المررو غير صحيحة</div>";
    }

/*}else{
    $msg = "<div class='alert alert-danger'>يرجى الضغط على reCaptcha</div>";
}*/

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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


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

<div  class="section mt-4">
    <div class="container text-center">
        <img class="logo" src="./img/logo.png">
        <p >المجلس القومي السوداني للمهن الطبية والصحية</p>
        <h5>نظام المعاملات الالكتروني</h5>
        <div class="row justify-content-center">
            <div class="card form-card">
                    <div class="card-body">
                    <h5 class="card-title">شاشة تسجيل الدخول</h5>  
                    <?php echo $msg; ?>                      
                        <form method="post">
                            <div class="form-floating mb-3 mt-3">
                                <input type="number" class="form-control" placeholder="اسم المستخدم" name="phone" >
                                <label for="email">رقم الهاتف</label>
                            </div>
                            <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="كلمة المرور" name="user_password">
                            <label for="pswd">كلمة المرور</label>
                            </div>
                            <div class="mb-3 text-center">
                            <div class="g-recaptcha" data-sitekey="6LeVHzolAAAAAJ0aNYZVUgOk8NMPsgOQVHG-NvBP"></div>
                            </div>
                            <div class="mb-3 text-center">
                            <input type="submit" class="btn btn-color" name="login" value="تسجيل دخول">
                            </div>
                            <div class="mb-3 text-center">
                            <a href="signup.php" class="card-link float-start">انشاء حساب</a>
                            <a href="reset.php" class="card-link float-end">نسيت كلمة المرور </a>
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