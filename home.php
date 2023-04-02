<?php
session_start();
if($_SESSION['status']<>1){
	echo "<script>location.href='./';</script>";
}


require 'conn.php';
require "func.php";


$oparetion = user_oparetion(3,$_SESSION['group_id']);


$sql = "select * from per_groups where group_id = ?";
$r = $conn->prepare($sql);
$r->bind_param('i',$_SESSION['group_id']);
$r->execute();
$rr = $r->get_result();
while($per = $rr->fetch_assoc()){
    $PageArray[] = $per['page_id'];
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
<div class="header">
<nav class="navbar navbar-expand-sm sticky-top">
    <div class="container-fluid">
        <img class="navbar-brand logo" src="./img/logo.png" alt="Etoo Play Information Technology">
        <h5>نظام المعاملات الالكتروني</h5>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link active text-color" href="home.php">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">عن المجلس</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">اتصل بنا</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav nav-tabs">
            <?php
            if(in_array(1,$PageArray)){
            ?>
               <li class="nav-item">
                    <a class="nav-link" href="orders.php">طلباتي</a>
                </li>
                <?php
            }
            if(in_array(2,$PageArray)){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">ملفي الشخصي (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
                </li>
                <?php
            }
                ?>
               <li class="nav-item">
                    <a class="nav-link" href="./">تسجيل خروج</a>
                </li>
            </ul>
            </div>
    </div>
</nav>
</div>

<div  class="section mt-4">
    <div class="container ">
        <div class="mt-4 p-3 bg-color text-white rounded">
                <h1>الخدمات</h1>
                <p>لا تتردد في طلب الخدمة</p>
        </div>
        <h3 class="display-6"></h3>
        <div class="row justify-content-center">
            <div class="card">
                <img class="card-img-top" src="./img/Services/preliminary-registration.png">
                    <div class="card-body">
                        <h5 class="card-title">التسجيل التمهيدي</h5>
                        <p class="card-text">نص تعريفي بالخدمة</p>
                        <?php
                      
                       if ($oparetion['save'] == 1){
                        ?>
                        <a href="" class="card-link btn btn-color">اضافة</a>
                    <?php   
                    }
                    if ($oparetion['upd'] == 1){
                    ?>
                        <a href="" class="card-link btn btn-color">تعديل</a>
                        <?php
                    }
                    if ($oparetion['del']  == 1){
                        ?>
                        <a href="" class="card-link btn btn-color">حذف</a>
                        <?php
                    }
                        ?>
                    </div>
                    
            </div>
            <div class="card">
            <img class="card-img-top" src="./img/Services/permanent-registration.png">
                    <div class="card-body">
                        <h5 class="card-title">رخصة مزاولة المهنة</h5>
                        <p class="card-text">نص تعريفي بالخدمة</p>
                        <a href="service.php?sno=2" class="card-link btn btn-color">طلب الخدمة</a>
                    </div>
            </div>
            <div class="card">
            <img class="card-img-top" src="./img/Services/License-renewal.png">
                    <div class="card-body">
                        <h5 class="card-title">تجديد رخصة مزاولة المهنة</h5>
                        <p class="card-text">نص تعريفي بالخدمة</p>
                        <a href="service.php?sno=3" class="card-link btn btn-color">طلب الخدمة</a>
                    </div>
            </div>
            <div class="card">
            <img class="card-img-top" src="./img/Services/good-behavior.png">
                    <div class="card-body">
                        <h5 class="card-title">شهادة حسن السير والسلوك</h5>
                        <p class="card-text">نص تعريفي بالخدمة</p>
                        <a href="service.php?sno=4" class="card-link btn btn-color">طلب الخدمة</a>
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