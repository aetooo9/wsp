<?php
session_start();
if($_SESSION['status']<>1){
	echo "<script>location.href='./';</script>";
}



require "conn.php";



// get user data
$user_id = $_SESSION['user_id'];

$sql = "select * from users where user_id=$user_id";
    $r = $conn->prepare($sql);
    $r->execute();
    $rr = $r->get_result();
    $UserRow = $rr->fetch_assoc();
// --


if(isset($_POST['update'])){

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $user_password = $_POST['user_password'];


    $path = "images/";
    $path = $path.basename($_FILES['pic']['name']);


    $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        else{
    move_uploaded_file($_FILES['pic']['tmp_name'],$path);
    $sql = "update users set user_name='$user_name', email='$email', user_password='$user_password',pic='$path' where user_id=$user_id";
    $r = $conn->prepare($sql);
    $e = $r->execute();

    if($e){
        $msg = "تم تعديل البيانات بنجاح";
    }else{
        $msg = "حدث خطا يرجى المحاولة لاحقا";
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
               <li class="nav-item">
                    <a class="nav-link" href="orders.php">طلباتي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">ملفي الشخصي (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
                </li>
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
                <h1>ملفي الشخصي (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</h1>
                <p>لا تتردد في طلب الخدمة</p>
        </div>
        <h3 class="display-6">بيانات المستخدم</h3>
<center>
    <?php echo $msg; ?>
        <form method="post" enctype="multipart/form-data" >
            <table  width="50%">
         <tr>
            <td>اسم المستخدم</td>
            <td><input type="text" name="user_name" value="<?php echo $UserRow['user_name']; ?>" /></td>
            <td rowspan="3" ><img src="<?php echo $UserRow['pic']; ?>" width="100" height="100"></td>
         </tr>
         <tr>
            <td>البريد الالكتروني</td>
            <td><input type="email" name="email" value="<?php echo $UserRow['email']; ?>"/></td>
         </tr>
         <tr>
            <td>كلمة المرور</td>
            <td><input type="password" name="user_password" value="<?php echo $UserRow['user_password']; ?>"/></td>
         </tr>
         <tr>
            <td>صورة الملف الشخصي</td>
            <td><input type="file" name="pic" /></td>
         </tr>
         <tr align="center">
            <td colspan="2"><input type="submit" class="btn btn-color" name="update" value="تحديث" /></td>
         </tr>
</table>
</form>
<center>
        
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