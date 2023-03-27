<?php


$allowed_pages = array('home','index'.'service');

$page = $_GET['page'];


if(in_array($page,$allowed_pages)){
    include($page.'.php');
}
else{
    include('index.php');
}


?>